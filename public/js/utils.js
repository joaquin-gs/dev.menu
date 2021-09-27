$(document).ready(function ($) {

   /*----------------------------------*/
   /* Functions to manage khmer typing */
   /*----------------------------------*/

   // keydown codes
   var KbdMap = [192, 49, 50, 51, 52, 53, 54, 55, 56, 57, 48, 173, 61, 81, 87, 69, 82, 84, 89, 85, 73, 79, 80, 219, 221, 220, 65, 83, 68, 70, 71, 72, 74, 75, 76, 59, 222, 90, 88, 67, 86, 66, 78, 77, 188, 190, 191];

   // Khmer unicode characters
   var normalKH = ['', '\u17e1', '\u17e2', '\u17e3', '\u17e4', '\u17e5', '\u17e6', '\u17e7', '\u17e8', '\u17e9', '\u17e0', '\u17a5', '\u17b2', '\u1786', '\u17b9', '\u17c1', '\u179a', '\u178f', '\u1799', '\u17bb', '\u17b7', '\u17c4', '\u1795', '\u17c0', '\u17aa', '\u17ae', '\u17b6', '\u179f', '\u178a', '\u1790', '\u1784', '\u17a0', '\u17d2', '\u1780', '\u179b', '\u17be', '\u17cb', '\u178b', '\u1781', '\u1785', '\u179c', '\u1794', '\u1793', '\u1798', '\u17bb\u17c6', '\u17d4\u17b9\u17d4', '\u17ca'];
   var shiftKH = ['', '!', '\u17d7', '"', '\u17db', '%', '\u17cd', '\u17d0', '\u17cf', '(', ')', '\u17cc', '=', '\u17ad', '\u1788', '\u17ba', '\u17c2', '\u17ac', '\u1791', '\u17bd', '\u17bc', '\u17b8', '\u17c5', '\u1797', '\u17bf', '\u17a7', '\u17bc\u17c6', '\u17c3', '\u178c', '\u1792', '\u17a2', '\u17c7', '\u1789', '\u1782', '\u17a1', '\u17c4\u17c7', '\u17c9', '\u178d', '\u1783', '\u1787', '\u17c1\u17c7', '\u1796', '\u178e', '\u17c6', '\u17bb\u17c7', '\u17d5', '?'];
   var altKH = ['', '', '@', '\u17d1', '$', '', '\u17d9', '\u17da', '*', '{', '}', 'x', '\u17ce', '\\', '', '', '\u17af', '\u17ab', '', '', '', '\u17a6', '\u17b1', '\u17b0', '\u17a9', '\u17b3', '', '', '', '', '', '', '', '', '', '', '\u17c8', '', '', '', '', '', '', '', '', '', ''];

   $(document).on('keydown', '.khmer', function (event) {
      var key = event.keyCode;
      var str = $(this).val();
      var pos = jQuery.inArray(key, KbdMap);
      if (pos != -1) {
         if (event.shiftKey)
            str = str + shiftKH[pos];      // Shift + keystroke
         else
            if (event.altKey)
               str = str + altKH[pos];     // Alt + keystroke
            else
               str = str + normalKH[pos];  // A normal keystroke
         $(this).val(str);
      }
   });

   $('.khmer').on('keypress', function (event) {
      if (event.charCode != 0) {   // printable characters are not shown.
         event.preventDefault();
      }
   });


   /*------------------------------------------*/
   /* Function to accept only numbers as input */
   /* Negative sign added (26/01/2021)         */
   /*------------------------------------------*/
   $('.numeric').keydown(function (e) {
      var key = e.which || e.keyCode;
      var number = $(this).val();
      if (number.indexOf('-') > -1 && key == 109) {
         // Only one minus sign is accepted.
         return false;
      }
      if ((number.split('.').length - 1) == 1 && key == 110) {
         // Only one point is accepted.
         return false;
      }
      else {
         return (!e.shiftKey && !e.altKey && !e.ctrlKey && key >= 48 && key <= 57 ||
            key >= 96 && key <= 105 || key == 8 || key == 9 || key == 13 || key == 35 || key == 36 ||
            key == 37 || key == 39 || key == 46 || key == 45 || key == 109 || key == 110);
      }
   });


   /*----------------------------------------------------------*/
   /* Function to determine if a number is in between 2 values */
   /*----------------------------------------------------------*/
   Number.prototype.between = function (a, b) {
      var min = Math.min.apply(Math, [a, b]),
         max = Math.max.apply(Math, [a, b]);
      return this >= min && this <= max;
   };

});


/*--------------------------------------------------------*/
/* Functions to calculate the age based on 2 string dates */
/*--------------------------------------------------------*/

function getDaysInMonth(month, year) {
   // This function is called by datesDifference().
   // Because January is 1 based, day 0 is
   // the last day in the previous month.
   return new Date(year, month, 0).getDate();
   // Here January is 0 based. JavaScript counts months from 0
   // return new Date(year, month+1, 0).getDate();
};


/**
 * This function calculates the difference in years, months and days
 * between two given dates.
 * Both dates are string type and must be in the format: yyyy-mm-dd
 * 
 * @param string init_date 
 * @param {string} end_date 
 * @returns string result
 */
function datesDifference(init_date, end_date) {
   var Yi, Ye, Mi, Me, Di, De;
   var Years, Months, Days, maxDays;
   var result = '';

   Yi = parseInt(init_date.substr(0, 4));
   Mi = parseInt(init_date.substr(5, 2));
   Di = parseInt(init_date.substr(8));

   Ye = parseInt(end_date.substr(0, 4));
   Me = parseInt(end_date.substr(5, 2));
   De = parseInt(end_date.substr(8));

   if (Di != De) {                 // Dias distintos
      if (De > Di) {
         if (Mi != Me) {           // Meses distintos
            if (Me > Mi) {
               Months = Me - Mi;
               Years = Ye - Yi;
            }
            else {                 // Segundo mes menor que el primero
               if (Yi != Ye) {
                  if (Ye - Yi > 1) {
                     Years = (Ye - Yi) - 1;
                  }
                  Months = 12 - (Mi - Me);
               }
            }
         }
         else {                    // Meses iguales
            Years = Ye - Yi;
         }
         Days = De - Di;
      }
      else {                       // Di > De
         maxDays = getDaysInMonth(Mi, Yi);  // Ultimo dia de mes inicial
         Days = (maxDays - Di) + De;
         if (Mi != Me) {           // Meses distintos
            if (Mi > Me) {
               Months = 11 - (Mi - Me);
               Years = (Ye - Yi) - 1;
            }
            else {
               Months = (Me - Mi) - 1;
               Years = Ye - Yi;
            }
         }
         else {                    // Meses iguales
            Months = Mi;
            Years = (Ye - Yi) - 1;
         }
      }
   }
   else {                          // Dias iguales
      if (Mi != Me) {              // Meses distintos
         if (Mi > Me) {
            Months = 12 - (Mi - Me);
            Years = (Ye - Yi) - 1;
         }
         else {
            Months = Me - Mi;
            Years = Ye - Yi;
         }
      }
      else                         // Meses iguales
         if (Yi != Ye) {
            Years = Ye - Yi;
         }
   }
   if (Years > 0) {
      result = Years.toString() + ((Years == 1) ? ' year' : ' years');
   }
   if (Months > 0) {
      if (Years > 0) {
         result = result + ', ';
      }
      result = result + Months.toString() + ((Months == 1) ? ' month ' : ' months');
   }
   if (Days > 0) {
      if (Years > 0 || Months > 0) {
         result = result + ', ';
      }
      result = result + Days.toString() + ((Days == 1) ? ' day ' : ' days');
   }
   return result;
};


/**
 * This function returns a given date in one of 
 * two formats: dd-mm-yyyy or yyyy-mm-dd
 * 
 * @param {string} format 
 * @returns date today
 */
function getCurrentDate(format) {
   var today = new Date();
   var dd = today.getDate();

   var mm = today.getMonth() + 1;
   var yyyy = today.getFullYear();
   if (dd < 10) {
      dd = '0' + dd;
   }

   if (mm < 10) {
      mm = '0' + mm;
   }
   today = mm + '-' + dd + '-' + yyyy;
   if (format == 'dd-mm-yyyy') {
      today = dd + '-' + mm + '-' + yyyy;
   }
   if (format == 'yyyy-mm-dd') {
      today = yyyy + '-' + mm + '-' + dd;
   }
   return today;
};
