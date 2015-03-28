$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($('#kategori').val() != '' && $('#isim').val() != '') {$( "#klm1" ).prop( "disabled", false );}
	else {$( "#klm1" ).prop( "disabled", true );}

  });

	$('#list').text("");

	$('#isim').keyup(function(){
	var isim = $('#isim').val();
	$('#list').text("");
	$.post("getname.php", 
	{isim:isim},
	function(data)
	{
		$('#list').html(data);
	});

	});
	
	$('#isim').keypress(function( e ) {
    if($('#isim').val().length == 0 && e.which === 32) {return false;}
});
$('#isim').on('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(text[0] == " ") {$('#isim').val("");
}
  }, 100);
});

    $("#isim").keyup(removeextra).blur(removeextra);


});

function removeextra() {
    var initVal = $(this).val();
    outputVal = initVal.replace(/[^0-9a-zA-Z_ üÜşŞiıIÂâÎîÛû.,:;)(+π\/ğİĞçÇöÖ'-]/g,"");
    if (initVal != outputVal) {
        $(this).val(outputVal);
    }
};