$(document).ready(function ($) {
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

   toastr.options = {
      "closeButton": true,
      "progressBar": true
   }

   var roleID = '';

   // Load roles and their permissions
   $('#roleList').on('change', function () {
      roleID = $('#roleList option:selected').val();
      $(".table > tbody").empty();
      $("#saveBtn").jqxButton({ disabled: false });

      jQuery.ajax({
         type: 'GET',
         url: '/config/loadRolePermissions',
         dataType: 'json',
         data: {
            'roleID': roleID
         },
         success: function (response) {
            var row = '';
            var str = '';
            $.each(response, function (key, value) {
               row = '<tr>';
               row += '<td class="col4" data-value="' + value.moduleID + '">' + value.moduleName + '</td>';
               row += '<td class="col3" data-value="' + value.pageID + '">' + value.pageName + '</td>';
               row += '<td class="col2" data-value="' + value.formID + '">' + value.formName + '</td>';
               
               str = (value.access >= 8) ? '<a class="linkBtn createBtn btnOn" title="Create"></a>' : '<a class="linkBtn createBtn" title="Create"></a>';
               str += ([4, 5, 6, 7, 12, 13, 14, 15].includes(value.access)) ? '<a class="linkBtn readBtn btnOn" title="Read"></a>' : '<a class="linkBtn readBtn" title="Read"></a>';
               str += ([2, 3, 6, 7, 10, 11, 14, 15].includes(value.access)) ? '<a class="linkBtn updateBtn btnOn" title="Update"></a>' : '<a class="linkBtn updateBtn" title="Update"></a>';
               str += (value.access % 2 != 0) ? '<a class="linkBtn deleteBtn btnOn" title="Delete"></a>' : '<a class="linkBtn deleteBtn" title="Delete"></a>';
               
               row += '<td class="col1" data-value="' + value.access + '">' + str + '</td>';
               row += '</tr>';
               $('.table').append(row);
            });
         }
      });
   });


   // Grant permissions to roles
   $('.table').on('click', '.linkBtn', function (event) {
      var access = 0;
      if ($(this).hasClass('btnOn')) {
         $(this).removeClass('btnOn');
      }
      else {
         $(this).addClass('btnOn');
      }
      
      var cell = $(this).parent();
      if (cell.find('.createBtn').hasClass('btnOn')) { access += 8; } 
      if (cell.find('.readBtn').hasClass('btnOn')) { access += 4; } 
      if (cell.find('.updateBtn').hasClass('btnOn')) { access += 2; } 
      if (cell.find('.deleteBtn').hasClass('btnOn')) { access += 1; } 
      cell.attr('data-value', access);
   });


   // Initialize form action buttons
   $('#saveBtn, #closeBtn').jqxButton({
      theme: 'energyblue',
      width: 90
   });


   $('#saveBtn').on('click', function () {
      $("#saveBtn").jqxButton({ disabled: true });
      var cols = '';
      var str = '';

      $('tbody tr').each(function (index, row) {
         cols = '(' + roleID + ',';
         $(row).children('td').each(function (i, col) {
            cols = cols + $(col).attr('data-value') + ',';
         });
         cols = cols.substring(0, cols.length - 1) + '),';
         str = str + cols;
      });
      // Get rid of last comma.
      str = str.substring(0, str.length - 1);
      
      // Send collected data to controller.
      jQuery.ajax({
         type: 'post',
         url: '/config/saveRolePermissions',
         data: {
            'roleID': roleID,
            'access': str
         },
         success: function (response) {
            if (response == 1) {
               toastr["success"]('Role permissions have been successfully saved.', 'Role permissions');
            }
            else {
               toastr["warning"]('There was a problem and permissions were not saved.', 'Role permissions');
            }
         }
      });
      
   });


   $('#closeBtn').on('click', function () {
      window.location = '/';
   });
});
