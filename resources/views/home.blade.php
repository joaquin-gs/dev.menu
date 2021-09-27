@extends('adminlte::page')

@push('js')
<script>
   $(document).ready(function() {
      $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
      });

      $('#sendContent').on('click', function() {
         $.post('/misc/sendContent', { content: 'Lorem ipsum dolor sit amet'});
      });
   });
</script>
@endpush

@push('css')
<style>
   .hidden { display: none !important; }

   .dropdown-item:focus,
   .dropdown-item:hover {
      background-color: #17a2b8;
   }

   .info-box { min-height: 120px; }

   .info-box .info-box-text,
   .info-box .progress-description {
      font-weight: 700;
   }

   .info-box .info-box-number { font-weight: normal; }
</style>
@endpush

@section('content')
<div class="row">
   <div class="col-md-12 text-center">&nbsp;</div>
</div>
<div class="row">
   <button id="sendContent">Send content</button>
</div>
<div id="result"></div>

@endsection

@section('footer')
   <div>This is my footer</div>
@stop