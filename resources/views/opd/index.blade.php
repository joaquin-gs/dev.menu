@extends('adminlte::page')

@push('js')
<script>
   $(document).ready(function() {
      $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
      });

      $('#createNotification').on('click', function() {
         $.post('/sendMessage', { name: window.currentUser, message: 'Neque porro dolorem ipsum...' });
      });
   })
</script>
@endpush

@push('css')
@endpush

@section('content')
<div>OPD home page</div>

<button type="button" id="createNotification">Create notification</button>

<div id="result">Result: </div>

@endsection
