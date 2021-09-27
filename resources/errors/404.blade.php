@extends('adminlte::page')

@push('css')
<style>
  html { 
     min-height: 100%; 
     height: 100%;
  }
  .container { height: 100%; }
</style>
@endpush

@section('content')
<div id="container" class="container">
   <div class="flex-center full-height">

      <div id="login-container" class="container-fluid" style="background-color: lightgray;">
        <div class="row h-100">
            <div class="col-md-12 my-auto">
                <h2 class="text-center">The page you requested was not found.</h2>
                <h4>Possible reasons:</h4>
                <ul>
                   <li>- The URL (web address) is not correct.</li>
                   <li>- The page has not been built yet.</li>
                   <li>- The link to that page is broken.</li>
                </ul>
                <br />
                <a class="btn btn-outline-primary btn-sm" href="{{ asset('/') }}">Back to home</a>
            </div>
        </div>
      </div>

   </div>
</div>
@endsection
