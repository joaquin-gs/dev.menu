$(document).ready(function ($) { 

   $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
   });

   toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "newestOnTop": true,
      "showMethod": "show",
      "hideMethod": "hide",
   }


   //-----------------------------
   // jqxGrid settings
   //-----------------------------
   var source = {
      type: 'get',
      url: '/notifications/getUnread',
      data: { username: window.currentUser },
      datatype: 'json',
      datafields: [
         { name: 'id', type: 'string' },
         { name: 'type', type: 'string' },
         { name: 'data', type: 'string' },
         { name: 'created_at', type: 'date' },
         { name: 'fromUser', type: 'string' },
         { name: 'fromUnit', type: 'string' },
         { name: 'message', type: 'string' },
      ],
   };

   dataAdapter = new $.jqx.dataAdapter(source,
      {
         beforeLoadComplete: function(records) {
            var data = new Array();
            for (var i = 0; i < records.length; i++) {
               var row = records[i];
               row.fromUser = row.data[0].fromUser;
               row.fromUnit = row.data[0].fromUnit;
               row.message = row.data[0].message;
               pos = row.type.lastIndexOf('\\');
               row.type = row.type.substr(pos+1);
               data.push(row);
            }
            return data;
         }
     }
   );

   $("#grid").jqxGrid({
      source: dataAdapter,
      theme: 'material',
      width: '90%',
      height: 361,
      altrows: true,
      showtoolbar: true,
      showstatusbar: true,
      columns: [
         {
            text: '', datafield: 'MarkAsRead', columntype: 'button', width: 100, pinned: true,
            cellsrenderer: function () {
               return 'Mark as read';
            },
            buttonclick: function (rowNumber) {
               var notificationID = $('#grid').jqxGrid('getcellvalue', rowNumber, "id");
               console.log(notificationID);
               // AJAX call to mark the selected notification as read.
               jQuery.ajax({
                  type: 'post',
                  url: '/notifications/markNotification',
                  data: {id: notificationID},
                  success: function(response) {
                     // Force grid reload.
                     $('#grid').jqxGrid('source', null);
                     $('#grid').jqxGrid('source', dataAdapter);
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                     toastr["error"](textStatus, 'Notifications');
                  }
               });
            }
         },
         { text: '', dataField: 'id', hidden: true },
         { text: 'Unit', dataField: 'fromUnit', width: '15%', cellsalign: 'center', align: 'center' },
         { text: 'Requestor', dataField: 'fromUser', width: '15%' },
         { text: 'Detail', dataField: 'message', width: '50%' },
         { text: 'Created on', dataField: 'created_at', cellsformat: 'dd-MM-yyyy hh:mm:ss', width: '14%' }
      ],
      rendertoolbar: function(toolbar) {
         // Create the toolbar content
         var container = $("<div style='margin: 5px;'><h5>Your notifications</h5></div>");
         toolbar.append(container);
      },
      renderstatusbar: function(statusbar) {
         // Create the statusbar content
         var container = $("<div style='overflow: hidden; position: relative; margin: 4px;'></div>");
         container.append('<input type="button" id="markAll" value="Mark all as read" />');
         statusbar.append(container);
         $("#markAll").jqxButton({width: 120, height: 30, theme: 'material'});

         $('#markAll').on('click', function() {
            jQuery.ajax({
               type: 'post',
               url: '/notifications/markAllAsRead',
               success: function(response) {
                  // Force grid reload.
                  $('#grid').jqxGrid('source', null);
                  $('#grid').jqxGrid('source', dataAdapter);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  toastr["error"](textStatus, 'Notifications');
               }
            });
         });
      }
   });

});
