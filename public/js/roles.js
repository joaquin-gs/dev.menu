$(document).ready(function ($) {
   // Notifications options
   toastr.options = {
      "closeButton": true,
      "progressBar": true
   }

   // Initialize checkbox dropdown
   $('.role').chosen();


   // Initialize buttons
   $('#saveRoles').jqxButton({ theme: 'energyblue', width: 90 });
   $('#cancelBtn').jqxButton({ theme: 'energyblue', width: 90 });

   $('#saveRoles').on('click', function () {
      // Build a JSON string with table key fields
      var userName = '';
      var userId = '';
      var rolesId = '';
      var roles = '[';
      $('#tRoles tbody tr').each(function (index) {
         userId = $(this).find('td.userId').text();
         userName = $(this).find('td.userCell').text();
         rolesId = $('#' + userName + '').val();
         if (rolesId.length > 0) {
            for (i = 0; i < rolesId.length; i++) {
               roles += '{ "userID":' + userId + ', "roleID":' + rolesId[i] + ' },';
            }
         }
      });
      roles = roles.substr(0, roles.length - 1) + ']';
      roles = JSON.parse(roles);
      
      jQuery.ajax({
         type: 'post',
         url: '/config/saveRoles',
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            roles: roles,
         },
         success: function (response) {
            toastr["success"]('The roles have been assigned.', 'Roles maintenance', { onHidden: function () { window.location = '/'; } });
         },
         error: function (xhr, status, error) {
            toastr["error"](xhr.status + " / " + xhr.responseJSON.message, 'Problem detected');
         }
      });
   });


   $('#cancelBtn').on('click', function () {
      window.location = '/';
   });

});
