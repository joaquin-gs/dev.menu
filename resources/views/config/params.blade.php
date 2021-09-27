@extends('adminlte::page')

@push('js')
<!--script type="text/javascript" src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script-->
<script type="text/javascript" src="{{ asset('/js/jqx-all.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/utils.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/params.js') }}"></script>
<!--script type="text/javascript" src="{{ asset('/js/toastr.min.js') }}"></script-->
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqx.base.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqx.energyblue.css') }}">
<!--link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}"-->
@endpush

@section('content')
<div class="container">
   <br />
   <div class="row">
      <div class="col text-center">
         <h4>System parameters</h4>
      </div>
   </div>
   <br />
   <form id="inputForm" method="POST" action="">
      @csrf
      <div class="row">
         <label class="col-3 col-form-label text-right">Hospitalization billing cap:</label>
         <div class="col-2">
            <input class="form-control numeric" type="text" name="capAmount" id="capAmount" value="{{ $capAmount }}" maxlength="10" />
         </div>
         <label class="col-2 col-form-label">USD</label>
      </div>

      <br />
      <div id="buttons" class="form-group row justify-content-center hidden">
         <input type="button" class="btn" id="saveConfig" value="Save" />
         <span class="col-1"></span>
         <input type="button" class="btn" id="cancelBtn" value="Cancel" />
      </div>
   </form>
</div>
@endsection