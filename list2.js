$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($('#kisi').val() != '') {$( "#klm2" ).prop( "disabled", false );}
	else {$( "#klm2" ).prop( "disabled", true );}

  });

	$('#kisi').keyup(function(){	
	var kisi = $('#kisi').val();
	$.post("getperson.php", 
	{kisi:kisi},
	function(data)
	{
		$('#list').html(data);
	});



	});
	
	$('#kisi').keypress(function( e ) {
	if($('#kisi').val().length == 0 && e.which === 32) {return false;}
   
});
$('#kisi').on('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(text[0] == " ") {$('#kisi').val("");
}
  }, 100);
});


    $("#kisi").keyup(removeextra).blur(removeextra);

});

function removeextra() {
    var initVal = $(this).val();
    outputVal = initVal.replace(/[^0-9a-zA-Z_ üÂâÎîÛû.,:;)(+π\/ÜşŞiİIğıĞçÇöÖ'-]/g,"");
    if (initVal != outputVal) {
        $(this).val(outputVal);
    }
};