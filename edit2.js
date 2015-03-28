$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($("#kategori").val() == "" || 
    $("#isim").val() == "" ||
    $("#adet").val() == "")
       {
    $( "#stock_d" ).prop( "disabled", true );
    $( "#stock_e" ).prop( "disabled", true );

    }
	else {
	$( "#stock_e" ).prop( "disabled", false );
	$( "#stock_d" ).prop( "disabled", false );
	}

});

$('#isim').change(function(){
if(!$("#isim").val() == "") {$( "#kategori" ).prop( "disabled", true );}
if($("#isim").val() == "") {$( "#kategori" ).prop( "disabled", false );}
});

$('#adet').change(function(){
if(!$("#adet").val() == "") {$( "#isim" ).prop( "disabled", true );}
if($("#adet").val() == "") {$( "#isim" ).prop( "disabled", false );}
});

});