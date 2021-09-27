$(document).ready(function ($) { 

   //loadLanguage('profile', translation);

   $('#myPicture').on('change', function () {
      $('#preview').attr('src', window.URL.createObjectURL(this.files[0]));
   });

   $('#saveBtn').jqxButton({ theme: 'energyblue', width: 90 });
   $('#cancelBtn').jqxButton({ theme: 'energyblue', width: 90 });

   $('#cancelBtn').on('click', function () {
      window.location = '/';
   });
});