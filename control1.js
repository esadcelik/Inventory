$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($('#nereye').val() != '' && $('#adet').val() != '' &&  $('#kategori').val() != '' && $('#isim').val() != '' && $('#cikis_tarih').val() != '') {$( "#sub" ).prop( "disabled", false );}
	else {$( "#sub" ).prop( "disabled", true );}

  });

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($('#isim').val() != '') {$( "#adet" ).prop( "disabled", false );}
	else {$( "#adet" ).prop( "disabled", true );}

  });
	$(function() {
    $( "#cikis_tarih" ).datepicker({dateFormat:"yy-mm-dd"});
    
  });

$('#adet').keyup(function(){
	var adet = $(this).val();
	var isim = $('#isim').val();
	$.post("limit.php", 
	{isim:isim},
	function(data)
	{
	data = parseInt(data);
		if(adet>=0 & adet <= data){}
		else {$(".form-control1").val(data);}
	});

});

	$('#kategori').change(function(){
		var kategori = $(this).val();
			$.post('filloption2.php', {kategori: kategori}, function(data){
				$('#isim').html(data);
				
			});
	});

   $('#adet').keyup(function(){
	var adet = $(this).val();
	if(/^[1-9][0-9]*$/.test(adet)) {}
	else {$(".form-control1").val("");}
	});

$(function() {
    $( "#tarih1" ).datepicker({dateFormat:"yy-mm-dd"});
    
  });
  
  $(function() {
    $( "#tarih2" ).datepicker({dateFormat:"yy-mm-dd"});
    
  });

    $("#aciklama").keyup(removeextra).blur(removeextra);

});

function removeextra() {
    var initVal = $(this).val();
    outputVal = initVal.replace(/[^0-9a-zA-Z_ üÜşŞiİıIğĞçÂ\/âÎîÛû+π.,:;)(ÇöÖ-]/g,"");
    if (initVal != outputVal) {
        $(this).val(outputVal);
    }
};