<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'language'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Returns the role name of the current user.
    public static function roleName()
    {
        $user = Auth::user();
        $role = DB::select('SELECT r.roleName FROM role r JOIN users u ON (u.roleID = r.roleID) WHERE u.name = "' . $user->name . '"');
        return $role[0]->roleName;
    }


    public function adminlte_desc() {
        $roleName = $this::roleName();
        return $roleName == '' ? 'System User' : $roleName;
    }


    public function adminlte_profile_url() {
        return '/profile';
    }


    public function adminlte_image() {
        return Storage::url($this->name . ".jpg");
    }
}
