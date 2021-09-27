$(document).ready(function ($) {
   
   toastr.options = {
      "closeButton": true,
      "progressBar": true
   }

   $('#saveConfig').jqxButton({ theme: 'energyblue', width: 90 });
   $('#cancelBtn').jqxButton({ theme: 'energyblue', width: 90 });

   $('#saveConfig').on('click', function () {
      jQuery.ajax({
         type: 'post',
         url: '/config/saveParams',
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            capAmount: $('#capAmount').val()
         },
         success: function (response) {
            //alert('Parameters saved!');
            toastr["success"]('System settings have been successfully saved.', 'Settings maintenance');
         },
         error: function (xhr, status, error) {
            console.log(xhr.status + " / " + xhr.responseJSON.message);
            toastr["error"](xhr.status + " / " + xhr.responseJSON.message, 'Problem detected');
         }
      });
   });


   $('#cancelBtn').on('click', function () {
      window.location = '/';
   });

});
