@extends('adminlte::page')

@push('js')
<script type="text/javascript" src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jqx-all.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/profile.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqx.base.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqx.energyblue.css') }}">
<style>
   body {
      font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
   }

   #myPicture {
      padding-top: 8px;
   }
</style>
@endpush

@section('content')
<div class="container">
   <br />
   <div class="row">
      <div class="col">
         <h4>{{ $enLanguage ? 'Your profile' : 'ប្រវត្តិរូបរបស់អ្នក' }}</h4>
         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="/profile/store">
            @csrf

            <div class="form-group row">
               <label id="1" class="col-2 col-form-label text-right">{{ $enLanguage ? 'Name' : 'ឈ្មោះ' }}</label>
               <div class="col-3">
                  <input type="email" class="form-control" value="{{ $name }}" readonly>
               </div>
            </div>

            <div class="form-group row">
               <label id="2" class="col-2 col-form-label text-right">{{ $enLanguage ? 'Email' : 'អ៊ីមែល' }}</label>
               <div class="col-4">
                  <input type="email" class="form-control" value="{{ $email }}" readonly>
               </div>
            </div>

            <div class="form-group row">
               <label id="3" class="col-2 col-form-label text-right">{{ $enLanguage ? 'Role' : 'តួនាទី' }}</label>
               <div class="col-4">
                  <input type="text" class="form-control" value="{{ $role }}" readonly>
               </div>
            </div>

            <div class="row">
               <label id="4" class="col-2 col-form-label text-right">{{ $enLanguage ? 'Profile image' : 'រូបភាពប្រវត្តិរូប' }}</label>
               <div class="col-4">
                  <input type="file" id="myPicture" name="myPicture">
               </div>
               <div class="col-2">
                  <img id="preview" src="" width="50" height="50" />
               </div>
            </div>

            <br />
            <div class="form-group row text-center">
               <button type="submit" id="saveBtn" class="col-1 btn btn-default">{{ $enLanguage ? 'Save' : 'រក្សាទុក' }}</button>
               <div class="col-1"></div>
               <button type="button" id="cancelBtn" class="col-1 btn btn-default">{{ $enLanguage ? 'Close' : 'បិទ' }}</button>
            </div>
         </form>
      </div>
   </div>
   <br />
</div>
@endsection