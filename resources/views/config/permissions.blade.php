@extends('adminlte::page')

@push('js')
<script type="text/javascript" src="{{ asset('/js/jqWidgets/jqx-all.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/utils.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/permissions.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.base.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqx.adminlte.css') }}">
<style>
   .hidden { display: none !important; }

   .linkBtn {
      background-image: url('{{ Storage::url("crudBtn.png") }}');
      background-position-y: -32px;
      background-repeat: no-repeat;
      cursor: pointer;
      display: inline-block;
      height: 32px;
      width: 32px;
   }

   .linkBtn:hover {
      transform: perspective(1px) translateZ(0);
      transition-duration: 0.3s;
      transition-property: box-shadow;
      box-shadow: inset 0 0 0 2px #17a2b8, 0 0 1px #0000;
   }

   .btnOn { background-position-y: 0px; }

   .createBtn { background-position-x: 2px; }

   .readBtn { background-position-x: -37px; }

   .updateBtn { background-position-x: -78px; }

   .deleteBtn { background-position-x: -117px; }

   table {
      border: 1px solid darkgray!important;
      display: table;
      width: 100%;
   }

   table thead,
   table tbody {
      float: left;
      width: 100%;
   }

   table thead { 
      padding-right: 18px; 
      background-color: #17a2b8; 
   }

   table tbody {
      overflow: auto;
      height: 350px;
   }

   table tr {
      width: 100%;
      display: table;
      text-align: left;
   }

   .table td, 
   .table th {
      vertical-align: middle;
      border-top: 1px solid #dee2e6;
   }

   .table th { background-color: #17a2b8; }
   .table td { padding: 0px 0px 0px 5px; }

   .col4 { width: 28%; }
   .col3 { width: 22%; }
   .col2 { width: 11%; }
   .col1 { width: 10%; }
</style>
@endpush

@section('content')
<div class="container">
   <br />
   <div class="row">
      <div class="col text-center">
         <h4>Role permissions assignment</h4>
      </div>
   </div>

   <br />
   <form id="inputForm" method="POST" action="">
      @csrf
      <div id="blocks" class="justify-content-center">
         <div class="row">
            <label class="col-form-label col-2 text-right">Select a role</label>
            <div class="col-3">
               <select id="roleList" class="form-control">
                  <option value="0" selected="selected">Select</option>
                  @foreach ($roles as $role)
                  <option value="{{ $role->roleID }}">{{ $role->roleName }}</option>
                  @endforeach
               </select>
            </div>
         </div>

         <br />
         <div class="row">
            <label class="col">Permission detail</label>
         </div>

         <div class="row table-responsive">
            <table class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                     <th class="col4">Module</th>
                     <th class="col3">Page</th>
                     <th class="col2">Form</th>
                     <th class="col1">Actions</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>

         <br />
         <div id="buttons" class="form-group row justify-content-center">
            <input type="button" id="saveBtn" class="btn" value="Save" />
            <span class="col-1"></span>
            <input type="button" id="closeBtn" class="btn" value="Close" />
         </div>
      </div>
   </form>

</div>
@endsection