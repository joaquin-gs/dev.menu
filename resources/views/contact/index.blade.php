@extends('adminlte::page')

@push('js')
<script type="text/javascript" src="{{asset('/js/jqx-all.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/contact.js')}}"></script>
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqx.base.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqx.darkblue.css') }}">
<style>
   .toast { opacity: 1 !important; }
   .grid-btn { margin: 3px 0px 0px 5px; }
   #contactWindowContent,
   #deleteRowNotSelected,
   #editRowNotSelected { visibility: hidden; }
   input:valid { 
      background-color: #fff;
      border: 1px solid #ced4da; 
   }
   input:required { border: 1px solid black; }
   input:invalid { background-color: #ffdddd; }

   .jqx-window-header { font-weight: bold; }
   .jqx-window { border: 3px solid #3f95c5; }
   .jqx-rc-t {
	   border-top-left-radius: 0px;
	   border-top-right-radius: 0px;
   }
</style>
@endpush

@section('content')
<div>
   <br/>
   <div class="content">
      <div class="container">
         <div class="row justify-content-center">
            <div id="grid"></div>

            <div id="contactWindow">
               <div id="contactWindowHeader"></div>
               <div id="contactWindowContent">
                  <form id="contactForm" method="POST" action="/contact/store" class="container">
                     {{ csrf_field() }}
                     <input type="hidden" name="contactID" id="contactID" value=""/>

                     <div class="form-group row">
                        <div class="col-2 col-form-label"><label>First name</label></div>
                        <div class="col-6"><input type="text" class="form-control" name="firstName" id="firstName" maxlength="45" required/></div>
                     </div>

                     <div class="form-group row">
                        <div class="col-2 col-form-label"><label>Last name</label></div>
                        <div class="col-6"><input type="text" class="form-control" name="lastName" id="lastName" maxlength="45" required/></div>
                     </div>

                     <div class="form-group row">
                        <div class="col-2 col-form-label"><label>Phone</label></div>
                        <div class="col-6"><input type="text" class="form-control" name="phone" id="phone" maxlength="15"/></div>
                     </div>

                     <div class="form-group row">
                        <div class="col-2 col-form-label"><label>Email</label></div>
                        <div class="col-6"><input type="email" class="form-control" name="email" id="email" maxlength="80"/></div>
                     </div>

                     <div class="form-group row">
                        <div class="col-2 col-form-label"><label>Date of birth</label></div>
                        <div class="col-6"><input type="date" class="form-control" name="dob" id="dob" maxlength="10"/></div>
                     </div>

                     <div class="row justify-content-center">
                        <input type="submit" value="Submit" id="submitBtn" class="btn btn-sm btn-primary col-3" />
                        <span class="spacer col-1">&nbsp;</span>
                        <input type="button" value="Cancel" id="cancelBtn" class="btn btn-sm btn-primary col-3" />
                     </div>
                  </form>
               </div>
            </div>

         </div>
      </div>
      <br/>
   </div>
</div>
@if($errors->any())
<div class="form-group row justify-content-center">
   <div class="alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
</div>
@endif
@endsection
