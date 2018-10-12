function tog(v){return v?'addClass':'removeClass';}
$(document).on('input', '.clearable', function(){
    $(this)[tog(this.value)]('x');
}).on('mousemove', '.x', function( e ){
    $(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');
}).on('touchstart click', '.onX', function( ev ){
    ev.preventDefault();
    $(this).removeClass('x onX').val('').change();
    $(".clearable").trigger("keyup");
});

$(document).on('click','.delete1',function (e) {
  e.preventDefault();
  var row=$(this).parent().parent();
  $('.are').val($(this).parent().text().trim());
  $('.delPar').text(row.find('td:nth-child(1)').text()+" "+row.find('td:nth-child(2)').text()+"?");
  $('.delDate').text(row.find('td:nth-child(3)').text());
  $('.delUser').text(row.find('td:nth-child(4)').text());
});

$(document).on('click','.forwardDoc',function (e) {
  e.preventDefault();
  var row=$(this).parent().parent().parent();
  $('.paricsIDForward').val($(this).parent().text().trim());
  $('.paricsForward').text(row.find('td:nth-child(1)').text()+" "+row.find('td:nth-child(2)').text()+"?");
  $('.dateIssuedForward').text(row.find('td:nth-child(3)').text());
  $('.userForward').text(row.find('td:nth-child(4)').text());
});

$(document).on('click','.cancelDoc',function (e) {
  e.preventDefault();
  var row=$(this).parent().parent().parent();
  $('.paricsIDCancel').val($(this).parent().text().trim());
  $('.paricsCancel').text(row.find('td:nth-child(1)').text()+" "+row.find('td:nth-child(2)').text()+"?");
  $('.dateIssuedCancel').text(row.find('td:nth-child(3)').text());
  $('.userCancel').text(row.find('td:nth-child(4)').text());
});

$("#newPass").on("focusout", function (e) {
    if ($(this).val() != $("#confirmPass").val()) {
        $("#confirmPass").removeClass("valid").addClass("invalid");
    } else {
        $("#confirmPass").removeClass("invalid").addClass("valid");
    }
});

$("#confirmPass").on("keyup", function (e) {
    if ($("#newPass").val() != $(this).val()) {
        $(this).removeClass("valid").addClass("invalid");
    } else {
        $(this).removeClass("invalid").addClass("valid");
    }
});

$(window).scroll(function() {
  var pathArray = window.location.pathname.split( '/' );
  if ($(document).scrollTop() < 50 && ((pathArray[1]=="sppmo" && ""==pathArray[2]) || "home" == pathArray[2])) {
    $('nav').addClass('large');
    $('#btnUp').addClass('scale-out');
  } else {
    $('nav').removeClass('large');
    $('#btnUp').removeClass('scale-out');
  }
});

$(document).on('click','#btnUp',function(e){
  e.preventDefault();
  $("html, body").animate({ scrollTop: 0 }, 600);
  //document.body.scrollTop = 0; // For Chrome, Safari and Opera
  //document.documentElement.scrollTop = 0; // For IE and Firefox
});

$(document).on('click','.transmitBtn',function(e){
  e.preventDefault();
  $('.transmitForm').animate({width:'toggle'},350);
  $('.transmitSend').fadeToggle( "medium" );
});

$(document).on('click','.propBtn',function(e){
  e.preventDefault();
  $('.propForm').animate({width:'toggle',"left":"0px"},350);
  $('.propSend').fadeToggle( "medium" );
});
