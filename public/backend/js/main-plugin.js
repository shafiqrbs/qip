
// for multiple image upload
$(function () {
  $(document).on("click", ".btn-add", function (e) {
      e.preventDefault();

      var controlForm = $(".controls:first"),
        currentEntry = $(this).parents(".entry:first"),
        newEntry = $(currentEntry.clone()).appendTo(controlForm);

      newEntry.find("input").val("");
      controlForm
        .find(".entry:not(:last) .btn-add")
        .removeClass("btn-add")
        .addClass("btn-remove")
        .removeClass("btn-success")
        .addClass("btn-danger")
        .html('<span class="fa fa-trash"></span>');
    });
});



$(function () {
  $(document).on("click", ".btn-remove", function (e) {
      e.preventDefault();
      $(this).parents(".entry:first").remove();

      e.preventDefault();
      return false;
    });
});



// for kinzi print
// $('.app').kinziPrint();
        // for kinzi print
$(function () {
  $(document).on("click", "#printbutton", function (e) {

      $('.page-content').kinziPrint({
        // header: $('.print-header-content').html(),
        // footer: $('.print-header-content').html()
      });
      // alert('ok');
});
});

// for DataTable
      $(document).ready( function () {
            $('#table_id').DataTable({
                "paging":   false,
                "ordering": true,
                "info":     true
            });
        } );

// for select2
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

// for select2 multiple
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

// for auto-complete

/*An array containing all the country names in the world:*/
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla",
"Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan",
"Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda",
"Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands",
"Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde",
"Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo",
"Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus",
"Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador",
"Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands",
"Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon",
"Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam",
"Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong",
"Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel",
"Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo",
"Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein",
"Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives",
"Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova",
"Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia",
"Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua",
"Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama",
"Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar",
"Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino",
"Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone",
"Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea",
"South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan",
"Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania",
"Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan",
"Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom",
"United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela",
"Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);




