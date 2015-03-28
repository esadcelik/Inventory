$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($("#kategori").val() == "" || 
    $("#isim").val() == "" ||
    $("#adet").val() == "" ||
    $("#tarih").val() == "" ||
    $("#nereden").val() == "")
       {
    $( "#entry" ).prop( "disabled", true );

    }
	else {
	$( "#entry" ).prop( "disabled", false );
	}

});

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($("#kategori").val() == "" || 
    $("#isim").val() == "" ||
    $("#nereye").val() == "" ||
    $("#tarih").val() == "" ||
    $("#adet").val() == "")
       {
    $( "#outlist" ).prop( "disabled", true );

    }
	else {
	$( "#outlist" ).prop( "disabled", false );
	}

});


$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($("#kategori").val() == "" || 
    $("#isim").val() == "" ||
    $("#adet").val() == "")
       {
    $( "#stock" ).prop( "disabled", true );

    }
	else {
	$( "#stock" ).prop( "disabled", false );
	}

});


$('#kategori').change(function(){
		var kategori = $('#kategori').val();
		$.post('edit_fill_spec.php', {kategori: kategori}, function(data){
			$('#isim').html(data);
				
			});
	});
	
$('#adet').keyup(function(){
	var adet = $(this).val();
	if(/^[1-9][0-9]*$/.test(adet)) {}
	else {$(".form-control1").val("");}
	});
	
$(function() {
    $( "#tarih" ).datepicker({dateFormat:"yy-mm-dd"});
    
  });
  
	
	
});