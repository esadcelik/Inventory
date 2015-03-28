$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($('#kategori1').val() != '') {$( "#klm0" ).prop( "disabled", false );}
	else {$( "#klm0" ).prop( "disabled", true );}

  });

	$('#kategori1').keyup(function(){	
	var kategori = $('#kategori1').val();
	$.post("getcat.php", 
	{kategori:kategori},
	function(data)
	{
		$('#list').html(data);
	});
	});
	
  $('#kategori1').keypress(function( e ) {
    if($('#kategori1').val().length == 0 && e.which === 32) {return false;}
	});

$('#kategori1').on('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(text[0] == " ") {$('#kategori1').val("");
}
  }, 100);
});
    $("#kategori1").keyup(removeextra).blur(removeextra);

});

function removeextra() {
    var initVal = $(this).val();
    outputVal = initVal.replace(/[^0-9a-zA-Z_ üÂâÎîÛû.,:;)(+π\/ÜşŞiıIİğĞçÇöÖ'-]/g,"");
    if (initVal != outputVal) {
        $(this).val(outputVal);
    }
};