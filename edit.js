$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($("#kategori").val() == "" || 
    $("#isim").val() == "" ||
    $("#kisi").val() == "" ||
    $("#adet").val() == "" ||
    $("#tarih").val() == "") 
       {
    $( "#entry_d" ).prop( "disabled", true );
    $( "#entry_e" ).prop( "disabled", true );
    $( "#stock_d" ).prop( "disabled", true );
    $( "#stock_e" ).prop( "disabled", true );
    $( "#outlist_d" ).prop( "disabled", true );
    $( "#outlist_e" ).prop( "disabled", true );

    }
	else {
	$( "#entry_e" ).prop( "disabled", false );
	$( "#entry_d" ).prop( "disabled", false );
	$( "#stock_e" ).prop( "disabled", false );
	$( "#stock_d" ).prop( "disabled", false );
	$( "#outlist_e" ).prop( "disabled", false );
	$( "#outlist_d" ).prop( "disabled", false );
	}

});


$('#isim').change(function(){
if(!$("#isim").val() == "") {$( "#kategori" ).prop( "disabled", true );}
if($("#isim").val() == "") {$( "#kategori" ).prop( "disabled", false );}
});

$('#kisi').change(function(){
if(!$("#kisi").val() == "") {$( "#isim" ).prop( "disabled", true );}
if($("#kisi").val() == "") {$( "#isim" ).prop( "disabled", false );}
});

$('#adet').change(function(){
if(!$("#adet").val() == "") {$( "#kisi" ).prop( "disabled", true );}
if($("#adet").val() == "") {$( "#kisi" ).prop( "disabled", false );}
});

$('#tarih').change(function(){
if(!$("#tarih").val() == "") {$( "#adet" ).prop( "disabled", true );}
if($("#tarih").val() == "") {$( "#adet" ).prop( "disabled", false );}
});

});