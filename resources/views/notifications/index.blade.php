@extends('adminlte::page')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.base.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.material.css') }}">
<style>
   .toast { opacity: 1 !important; }

   #statusbargrid, #toolbargrid { 
      background-color: #d0d0d0;
   }
</style>
@endpush

@push('js')
<script type="text/javascript" src="{{asset('/js/jqWidgets/jqx-all.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/notifications/notifications.js')}}"></script>
@endpush

@section('content')
<div class="content-wrapper">
   <br/>
   <div class="row justify-content-center">
      <div id="grid"></div>
   </div>
</div>
@endsection
