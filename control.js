$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($('#nereden').val() != '' && $('#adet').val() != '' &&  $('#kategori').val() != '' && $('#isim').val() != '' && $('#giris_tarih').val() != '') {$( "#sub" ).prop( "disabled", false );}
	else {$( "#sub" ).prop( "disabled", true );}
	
  });
$('#kategori').change(function(){
		var kategori = $(this).val();
			$.post('filloption1.php', {kategori: kategori}, function(data){
				$('#isim').html(data);
			});
	});
	
  $('#adet').keyup(function(){
	var adet = $(this).val();
	if(/^[1-9][0-9]*$/.test(adet)) {}
	else {$(".form-control1").val("");}
	});
	
$(function() {
    $( "#giris_tarih" ).datepicker({dateFormat:"yy-mm-dd"});
    
  });
  
  
    $("#aciklama").keyup(removeextra).blur(removeextra);

});

function removeextra() {
    var initVal = $(this).val();
    outputVal = initVal.replace(/[^0-9a-zA-Z_ üÜşŞiıIğİπĞÂâÎîÛû\/.,+:;)(çÇöÖ-]/g,"");
    if (initVal != outputVal) {
        $(this).val(outputVal);
    }
};