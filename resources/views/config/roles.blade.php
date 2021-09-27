@extends('adminlte::page')

@push('js')
<script type="text/javascript" src="{{ asset('/js/jqWidgets/jqx-all.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/utils.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/roles.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.base.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.energyblue.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/chosen.min.css') }}">
<style>
   .hidden {
      display: none !important;
   }

   .userCell {
      padding-top: 18px !important;
   }
</style>
@endpush

@section('content')
<div class="container">
   <br />
   <div class="row">
      <div class="col text-center">
         <h4>{{ $enLanguage ? 'User role assignment' : 'ការចាត់តាំងតួនាទីអ្នកប្រើ' }}</h4>
      </div>
   </div>
   <br />
   <form id="inputForm" method="POST" action="">
      @csrf
      <div class="row justify-content-center">
         <div class="col">
            <table id="tRoles" class="table table-bordered">
               <thead>
                  <tr>
                     <td class="col-3"><strong>{{ $enLanguage ? 'User' : 'អ្នក​ប្រើ' }}</strong></td>
                     <td class="col-3"><strong>{{ $enLanguage ? 'Role' : 'តួនាទី' }}</strong></td>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $user)
                  <tr>
                     <td class="userId hidden">{{ $user->id }}</td>
                     <td class="userCell">{{ $user->name }}</td>
                     <td>
                        <select id="{{ $user->name }}" class="role chosen-select form-control custom-select" multiple>
                        @php
                           $arr_roles = App\Http\Controllers\configController::getUserRoles($user->id);
                           for ($i=0; $i < count($arr_roles); $i++) {
                              if ($arr_roles[$i]->granted == 1) {
                                 echo "<option value='" . $arr_roles[$i]->roleID . "' selected>";
                              }
                              else {
                                 echo "<option value='" . $arr_roles[$i]->roleID . "'>";
                              }
                              echo $arr_roles[$i]->roleName;
                              echo "</option>";
                           }
                        @endphp
                        </select>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>

      <br />
      <div id="buttons" class="form-group row justify-content-center">
         <input type="button" id="saveRoles" value="{{ $enLanguage ? 'Save' : 'រក្សាទុក' }}" />
         <span class="col-1"></span>
         <input type="button" id="cancelBtn" value="{{ $enLanguage ? 'Close' : 'បិទ' }}" />
      </div>
   </form>
</div>
@endsection