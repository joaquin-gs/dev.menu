$(document).ready(function ($) { 

   $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
   });

   // Toastr configuration
   toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "newestOnTop": true,
      "showMethod": "show",
      "hideMethod": "hide",
   }

   // Contains the data row to edit.
   var datarow = null;

   // Initial page size.
   var pageSize = 15;

   $('#nationality').val('KH');           // Cambodian is the default nationality.


   // Loads the list of districts of the selected province.
   $('#provinceID').on('change', function () {
      var selectedProvinceId = $('option:selected', this).val();
      getDistricts(selectedProvinceId);
   });

   // Loads the list of communes of the selected district.
   $('#districtID').on('change', function(e, dCode = -1) {
      var selectedDistrictId = (dCode !== null && dCode !== -1) ? dCode : $('option:selected', this).val();
      getCommunes(selectedDistrictId);
   });

   // Loads the list of villages of the selected commune.
   $('#communeID').on('change', function(e, cCode = -1) {
      var selectedCommuneId = (cCode !== null && cCode !== -1) ? cCode : $('option:selected', this).val();
      getVillages(selectedCommuneId);
   });
   
   // Switch buttons configuration
   $('#sex').jqxSwitchButton({onLabel: 'Male', offLabel: 'Female', height: 27, width: 110, checked: false});

   $('.switchBtn').jqxSwitchButton({onLabel: 'Yes', offLabel: 'No', height: 27, width: 81, checked: false});
   $('.switchBtn').on('checked', function() {
      $('.jqx-switchbutton-thumb', this).css('background-color', 'green');
   });
   $('.switchBtn').on('unchecked', function(event) {
      $('.jqx-switchbutton-thumb', this).css('background-color', 'red');
   });

   $("#gate_time, #quick_nurse_time").jqxDateTimeInput({formatString: "T", showTimeButton: true, showCalendarButton: false, width: '160px', height: '25px' });
  

   //-----------------------------
   // jqxTab settings
   //-----------------------------
   $('#tabs').jqxTabs({ height: '100%', width: '100%' });


   //-----------------------------
   // jqxGrid settings
   //-----------------------------

   var source = {
      url: '/patient/getPatients',
      datafields: [
         { name: 'patientID', type: 'string'},
         { name: 'familyNameEn', type: 'string'},
         { name: 'firstNameEn', type: 'string'},
         { name: 'familyNameKh', type: 'string'},
         { name: 'firstNameKh', type: 'string'},
         { name: 'gender', type: 'string'},
         { name: 'dob', type: 'date'},
         { name: 'nationality', type: 'int'},
         { name: 'caretakerNameKh', type: 'string'},
         { name: 'relationship', type: 'string'},
         { name: 'distance', type: 'string'},
         { name: 'provinceID', type: 'int'},
         { name: 'provinceNameEn', type: 'string'},
         { name: 'districtID', type: 'int'},
         { name: 'districtNameEn', type: 'string'},
         { name: 'communeID', type: 'int'},
         { name: 'communeNameEn', type: 'string'},
         { name: 'villageID', type: 'int'},
         { name: 'villageNameEn', type: 'string'},
         { name: 'address', type: 'string'},
         { name: 'phone1', type: 'string'},
         { name: 'phone2', type: 'string'},
         { name: 'bloodGroup', type: 'string'},
         { name: 'estimatedDoB', type: 'int'},
         { name: 'overAge', type: 'int'},
         { name: 'deceased', type: 'int'},
         { name: 'isForeigner', type: 'string'},
         { name: 'billingCode', type: 'string'},
         { name: 'hasPoorId', type: 'string'},
         { name: 'poorIdExpiry', type: 'string'},
         { name: 'hasHEF', type: 'string'},
         { name: 'HEFexpiry', type: 'date'},
         { name: 'LMTR', type: 'string'},
         { name: 'isEmployee', type: 'string'},
         { name: 'thirdPartyPayer', type: 'string'},
         { name: 'insuranceName', type: 'string'},
         { name: 'employeeCardId', type: 'string'},
         { name: 'employeeCardExpiry', type: 'date'},
      ],
      datatype: 'json',
      cache: false,
      root: 'patients',
      beforeprocessing: function(data) {
         // Without the totalrecords property set, the pager does not work.
         source.totalrecords = data.totRows[0].numRows;
      },
      filter: function () {
         // Reloads the grid with data requested to the server.
         $("#grid").jqxGrid('updatebounddata');
      }
   };
   dataAdapter = new $.jqx.dataAdapter(source);

   $("#grid").jqxGrid({
      source: dataAdapter,
      theme: 'darkblue',
      width: '98%',
      height: 562,
      altrows: true,
      rowsheight: 24,
      //sortable: true,
      filterable: true,
      showfilterrow: true,
      pageable: true,
      pagesizeoptions: ['15', '25', '50'],
      pagesize: pageSize,
      virtualmode: true,
      rendergridrows: function() {
         return dataAdapter.records;
      },
      showstatusbar: true,
      showtoolbar: true,
      columns: [
         { text: 'id', dataField: 'patientID', width: 100, pinned: true, filtercondition: 'starts_with', },
         { text: 'Last name', dataField: 'familyNameEn', width: 120, pinned: true, filtercondition: 'starts_with', },
         { text: 'First name', dataField: 'firstNameEn', width: 120, pinned: true, filtercondition: 'starts_with', },
         { text: 'នាមត្រកូល', dataField: 'familyNameKh', width: 120, filterable: false },
         { text: 'នាមខ្លួន', dataField: 'firstNameKh', width: 120, filterable: false },
         { text: 'Sex', dataField: 'gender', width: 45, filterable: false },
         { text: 'Date of birth', dataField: 'dob', width: 100, cellsformat: 'dd-MM-yyyy', filtertype: 'date' },
         { text: 'Nationality', dataField: 'nationality', width: 140, filterable: false },
         { text: 'Caretaker', dataField: 'caretakerNameKh', width: 120, filterable: false },
         { text: 'Relationship', dataField: 'relationship', width: 120, filterable: false },
         { text: 'Distance', dataField: 'distance', width: 85, filterable: false },
         { text: '', dataField: 'province_code', hidden: true },
         { text: 'Province', dataField: 'provinceNameEn', width: 140, },
         { text: '', dataField: 'district_code', hidden: true },
         { text: 'District', dataField: 'districtNameEn', width: 120, },
         { text: '', dataField: 'commune_code', hidden: true },
         { text: 'Commune', dataField: 'communeNameEn', width: 120, },
         { text: '', dataField: 'village_code', hidden: true },
         { text: 'Village', dataField: 'villageNameEn', width: 120, },
         { text: 'Address', dataField: 'address', width: 140, filterable: false },
         { text: 'Phone 1', dataField: 'phone1', width: 120, },
         { text: 'Phone 2', dataField: 'phone2', width: 120, filterable: false },
         { text: 'Blood group', dataField: 'bloodGroup', width: 90, filterable: false },
         { text: 'DoB estimated?', dataField: 'estimatedDoB', width: 110, filterable: false },
         { text: 'Overaged', dataField: 'overAge', width: 85, filterable: false },
         { text: 'Deceased', dataField: 'deceased', width: 85, filterable: false },
         { text: '', dataField: 'isForeigner', hidden: true },
         { text: '', dataField: 'billingCode', hidden: true },
         { text: '', dataField: 'hasPoorId', hidden: true },
         { text: '', dataField: 'poorIdExpiry', hidden: true },
         { text: '', dataField: 'hasHEF', hidden: true },
         { text: '', dataField: 'HEFexpiry', hidden: true },
         { text: '', dataField: 'LMTR', hidden: true },
         { text: '', dataField: 'isEmployee', hidden: true },
         { text: '', dataField: 'thirdPartyPayer', hidden: true },
         { text: '', dataField: 'insuranceName', hidden: true },
         { text: '', dataField: 'employeeCardId', hidden: true },
         { text: '', dataField: 'employeeCardExpiry', hidden: true },
      ],
      rendertoolbar: function(toolbar) {
         toolbar.append("<div><h4>Patients information</h4></div>");
      },
      // Add action buttons and their event handlers to the grid.
      renderstatusbar: function (statusbar) {
         var container = $("<div class='grid_buttons'></div>");
         statusbar.append(container);
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="newBtn" value="New" />');
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="editBtn" value="Edit" />');
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="registerBtn" value="Register" />');
         container.append('<input class="btn btn-default btn-sm grid-btn col-1 btn-primary" type="button" id="closeGridBtn" value="Close" />');

         $('#newBtn').on('click', function() {
            $('#grid').addClass('hidden');
            $('#dataForm').removeClass('hidden');
            $('.content-header .container-fluid').append('<div id="formTitle" class="text-center"><h4>Add new patient</h4></div>');
            $('#isForeigner').jqxSwitchButton({ checked:false });
            $('#isEmployee').jqxSwitchButton({ checked:false });
            $('#hasPoorId').jqxSwitchButton({ checked:false });
            $('#hasHEF').jqxSwitchButton({ checked:false });
            $('#thirdPartyPayer').jqxSwitchButton({ checked:false });
         });

         $('#editBtn').on('click', function () {
            if (datarow !== null) {
               // hide the grid
               $('#grid').addClass('hidden');

               // Populate the form.
               $.each(datarow, function( inputID, value ) {
                  $('#' + inputID).val(value);
               });

               // Show the form.
               $('.content-header .container-fluid').append('<div id="formTitle" class="text-center"><h4>Edit patient information</h4></div>');
               $('#dataForm').removeClass('hidden');

               $('#isForeigner').jqxSwitchButton({ checked:true });
               $('#isEmployee').jqxSwitchButton({ checked:true });
               $('#hasPoorId').jqxSwitchButton({ checked:true });
               $('#hasHEF').jqxSwitchButton({ checked:true });
               $('#thirdPartyPayer').jqxSwitchButton({ checked:true });
   
               $('#familyNameEn').focus();
            }
            else {
               toastr["warning"]('Please select a row to edit.', 'Patients');
            }
         });

         $('#registerBtn').on('click', function () {
            if (datarow !== null) {
               // var answer = confirm('Delete contact ' + datarow.firstName + '?');
               // if (answer) {
               //    // Call the controller method to delete a contact.
               //    jQuery.ajax({
               //       type: 'post',
               //       url: '/contact/delete',
               //       contentType: "application/json; charset=utf-8",
               //       data: '{"contactID": "' + datarow.contactID + '"}',
               //       complete: function (XHR, status) {
               //          datarow = null;
               //          $('#grid').jqxGrid('updatebounddata');
               //       }
               //    });
               // }
            }
            else {
               toastr["warning"]('Please select a patient to register.', 'Patients');
            }
         });

         $('#closeGridBtn').on('click', function () {
            $('#grid').jqxGrid('destroy');
            window.location = '/';
         });
      },  // renderstatusbar
   });

   // Load variable 'datarow' with the selected row.
   $("#grid").bind('rowselect', function (event) {
      var row = event.args.rowindex;
      datarow = $("#grid").jqxGrid('getrowdata', row);
   });

   
   // The cancel button event handler.
   $('#cancelBtn').on('click', function() {
      $('.content-header .container-fluid').empty();
      $('#dataForm').addClass('hidden');
      $('#grid').removeClass('hidden');
   });

   //-----------------------------------
   // Patient category fields validation
   //-----------------------------------
   
   
   // Load initial data.
   getDistricts(17);   // Siem Reap province

});


/**
 * Loads the districts of the selected province.
 * It, in turn, loads the communes belonging to the first district in the list.
 * 
 * @param int province 
 * @returns void
 */
function getDistricts(province) {
   $.get('/patient/getDistrictsByProvince', { provinceID: province }, function (data) {
      $('#districtID').empty();
      $.each(data, function (index, value) {
         $('#districtID').append('<option value="' + data[index].districtID + '">' + data[index].districtNameEn + '</option>');
      });
      getCommunes($('#districtID').find("option:first-child").val());
   }, 'json');
}


/**
 * Loads the communes of the selected district.
 * It, in turn, loads the villages belonging to the first commune in the list.
 * 
 * @param int district 
 * @returns void
 */
 function getCommunes(district) {
   $.get('/patient/getCommunesByDistrict', { districtID: district }, function (data) {
      $('#communeID').empty();
      $.each(data, function (index, value) {
         $('#communeID').append('<option value="' + data[index].communeID + '">' + data[index].communeNameEn + '</option>');
      });
      getVillages($('#communeID').find("option:first-child").val());
   }, 'json');
}


/**
 * Loads the villages of the selected commune in the list.
 * 
 * @param int commune 
 * @returns void
 */
 function getVillages(commune) {
   $.get('/patient/getVillagesByCommune', { communeID: commune }, function (data) {
      $('#villageID').empty();
      $.each(data, function (index, value) {
         $('#villageID').append('<option value="' + data[index].villageID + '">' + data[index].villageNameEn + '</option>');
      });
   }, 'json');
}
