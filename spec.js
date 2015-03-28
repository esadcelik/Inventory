$(document).ready( function(){

$('#kategori').keypress(function( e ) {
    if($('#kategori').val().length == 0 && e.which === 32) {return false;}
});

$('#isim').keypress(function( e ) {
    if($('#isim').val().length == 0 && e.which === 32) {return false;}
});

$('#kisi').keypress(function( e ) {
    if($('#kisi').val().length == 0 && e.which === 32) {return false;}
});

$("#kategori").keyup(removeextra).blur(removeextra);
$("#isim").keyup(removeextra).blur(removeextra);
$("#kisi").keyup(removeextra).blur(removeextra);


$('#kategori').on('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(text[0] == " ") {$('#kategori').val("");
}
  }, 100);
});

  
$('#isim').on('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(text[0] == " ") {$('#isim').val("");
}
  }, 100);
});

$('#kisi').on('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(text[0] == " ") {$('#kisi').val("");
}
  }, 100);
});
});

function removeextra() {
    var initVal = $(this).val();
    outputVal = initVal.replace(/[^0-9a-zA-Z_ üÂâÎîÛûÜ\/şŞiıIİğĞ.,:;)(+πçÇöÖ'-]/g,"");
    if (initVal != outputVal) {
        $(this).val(outputVal);
    }
};