$(document).ready(function ($) { 

   var datarow = null;
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

   toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "newestOnTop": true,
      "showMethod": "show",
      "hideMethod": "hide",
   }

   //-----------------------------
   // jqxWindow settings
   //-----------------------------
   $('#contactWindow').jqxWindow({
      theme: 'darkblue',
      autoOpen: false,
      isModal: true,
      width: 650,
      height: 380,
      resizable: false,
      title: 'Contact',
      cancelButton: $('#cancelBtn'),
      initContent: function () {
         $('#submitBtn').jqxButton();
         $('#cancelBtn').jqxButton();
      }
   }).css('top', '35%');


   //-----------------------------
   // jqxGrid settings
   //-----------------------------
   var source = {
      type: 'get',
      url: '/contact/getContacts',
      datatype: 'json',
      datafields: [
         { name: 'contactID', type: 'int' },
         { name: 'firstName', type: 'string' },
         { name: 'lastName', type: 'string' },
         { name: 'phone', type: 'string' },
         { name: 'email', type: 'string' },
         { name: 'dob', type: 'date' },
      ],
   };
   dataAdapter = new $.jqx.dataAdapter(source, { contentType: 'application/json' });

   $("#grid").jqxGrid({
      theme: 'darkblue',
      width: '80%',
      height: 361,
      altrows: true,
      sortable: true,
      filterable: true,
      showtoolbar: false,
      source: dataAdapter,
      columnsresize: true,
      showfilterrow: true,
      showstatusbar: true,
      columns: [
         { text: 'id', dataField: 'contactID', hidden: true },
         { text: 'First name', dataField: 'firstName', width: '25%' },
         { text: 'Last name', dataField: 'lastName', width: '25%', filterable: true },
         { text: 'Phone', dataField: 'phone', width: '15%', filterable: false },
         { text: 'Email', dataField: 'email', width: '25%', filterable: false },
         { text: 'Date of birth', dataField: 'dob', width: '10%', filterable: false },
      ],
      // Adding maintenance buttons and their event handlers to the grid.
      renderstatusbar: function (statusbar) {
         var container = $("<div class='grid_buttons'></div>");
         statusbar.append(container);
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="newBtn" value="New" />');
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="editBtn" value="Edit" />');
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="deleteBtn" value="Delete" />');
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="closeGridBtn" value="Close" />');

         $('#newBtn').on('click', function () {
            $('#contactWindow').jqxWindow('open');
            $('#contactID').val('');
            $('#firstName').val('');
            $('#lastName').val('');
            $('#phone').val('');
            $('#email').val('');
            $('#dob').val('');
            $('#contactWindowContent').css('visibility', 'visible');
            $('#firstName').select();
         });

         $('#editBtn').on('click', function () {
            if (datarow != null) {
               // Show the window.
               $('#contactWindow').jqxWindow('open');
               // Populate the form.
               $('#contactID').val(datarow.contactID);
               $('#firstName').val(datarow.firstName);
               $('#lastName').val(datarow.lastName);
               $('#phone').val(datarow.phone);
               $('#email').val(datarow.email);
               $('#dob').val(datarow.dob);
               // Show the form.
               $('#contactWindowContent').css('visibility', 'visible');
               $('#firstname').focus();
            }
            else {
               toastr["warning"]('Please select a row to edit.', 'Contacts');
            }
         });

         $('#deleteBtn').on('click', function () {
            if (datarow != null) {
               var answer = confirm('Delete contact ' + datarow.firstName + '?');
               if (answer) {
                  // Call the controller method to delete a contact.
                  jQuery.ajax({
                     type: 'post',
                     url: '/contact/delete',
                     contentType: "application/json; charset=utf-8",
                     data: '{"contactID": "' + datarow.contactID + '"}',
                     complete: function (XHR, status) {
                        datarow = null;
                        $('#grid').jqxGrid('updatebounddata');
                     }
                  });
               }
            }
            else {
               toastr["warning"]('Please select a row to delete.', 'Contacts');
            }
         });

         $('#closeGridBtn').on('click', function () {
            $('#grid').jqxGrid('destroy');
            window.location = '/';
         });
      }  // renderstatusbar
   });

   /* Load datarow with the selected row */
   $("#grid").bind('rowselect', function (event) {
      var row = event.args.rowindex;
      datarow = $("#grid").jqxGrid('getrowdata', row);
   });

});

//-----------------------------
// Client side form validation
//-----------------------------

//$('#contactForm').validate();

$('#contactWindow').on('open', function (event) { 
   $('#firstName').jqxInput('focus'); 
});
