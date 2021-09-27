<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:model {tableName} {--m|migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new model class.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Variables 
        $tableName = $this->argument('tableName');
        $createMigration = $this->option('migration');
        $autoInc = false;
        $intKey = false;

        if (empty($tableName) || is_null($tableName)) {
            $this->error('Table name not especified.');
            return 0;
        }

        // Retrieve table structure from schema.
        $query = "SELECT column_name, 
                         is_nullable, 
                         data_type, 
                         character_maximum_length,
                         column_key,
                         extra
                  FROM INFORMATION_SCHEMA.COLUMNS
                  WHERE TABLE_SCHEMA = ?
                    AND table_name = ?";
        $tableStructure = DB::select($query, [env('DB_DATABASE'), $tableName]);

        // Find the primary key
        $key = array_search('PRI', array_column($tableStructure, 'column_key'));
        $primaryKey = $tableStructure[$key]->column_name;
        $intKey = $tableStructure[$key]->data_type === 'int';
        $autoInc = $tableStructure[$key]->extra === 'auto_increment';

        // Begin writting PHP model class file
        $content = "<?php" . PHP_EOL . PHP_EOL . 'namespace App\Models;' . PHP_EOL . PHP_EOL;
        $content .= "use Illuminate\Database\Eloquent\Model;" . PHP_EOL . PHP_EOL;
        $content .= "class " . $tableName . " extends Model" . PHP_EOL;
        $content .= "{" . PHP_EOL;
        $content .= '   protected $table = "' . $tableName . '";' . PHP_EOL;    
        $content .= '   protected $primaryKey = "' . $primaryKey . '";' . PHP_EOL;
        if (!$intKey) {
           $content .= '   protected $keyType = "string";' . PHP_EOL . PHP_EOL;
        }
        else {
           $content .= '   public $incrementing = ' . ($autoInc ? 'true' : 'false') . ';' . PHP_EOL . PHP_EOL;
        }

        // Create fillable columns array and validation rules
        $rules = '';
        $content .= '   protected $fillable = [' . PHP_EOL;
        foreach ($tableStructure as $key => $value) {
           if ($value->column_name == $primaryKey) {
              if (!$autoInc) {
                 $content .= str_repeat(' ', 6) . '"' . $value->column_name . '",' . PHP_EOL;
                 if ($intKey) {
                    $rules .= str_repeat(' ', 6) . '"' . $value->column_name . '" => ' . '"required|numeric",' . PHP_EOL;
                 }
                 else {
                    $rules .= str_repeat(' ', 6) . '"' . $value->column_name . '" => ' . '"required|alpha_num|max:$charLen",' . PHP_EOL;
                 }
              }
           }
           else {  // all the other columns
              $content .= str_repeat(' ', 6) . '"' . $value->column_name . '",' . PHP_EOL;

              // Build validation rules...
              $charLen = $value->character_maximum_length;
              $required = $value->is_nullable === 'NO';
              $max = !empty($charLen) ? "max:".$charLen : "";
              $colType = '';

              if ($value->data_type == 'date') {
                 $colType .= 'date';
              }
              if ($value->data_type == 'varchar') {
                 $colType .= 'alpha_num';
              }
              if ($value->data_type == 'int'){
                 $colType .= 'numeric';
              }
              $str = '"' . $colType . ($required ? '|required' : '') . ($max !== "" ? '|'.$max : '') .'"' ;
              $rules .= str_repeat(' ', 6) . '"' . $value->column_name . '" => ' . $str . ','. PHP_EOL;
           }
        }
        $content .= '   ];' . PHP_EOL . PHP_EOL;

        // Model validation rules, based on columns constraints (required/max length).
        $content .= '   protected $rules = array(' . PHP_EOL;
        $content .= $rules;
        $content .= '   );'. PHP_EOL;
        $content .= '}';

        $currDir = getcwd();
        if (!file_exists($currDir . '/app/Models')) {
           mkdir($currDir . '/app/Models', 0777, true);
        }

        $file = $currDir . '/app/Models/' . $tableName . '.php';
        $result = file_put_contents($file, $content);
        if ($result === false) {
            echo "Could not create class file.";
            return 0;
        }
        $this->info('The command was successful!');
    }
}