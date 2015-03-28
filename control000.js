$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($("#kategori2").val() == "" && $("#isim2").val() == "" && $("#kisi2").val() == "") {
    $( "#sub0" ).prop( "disabled", true );
    $( "#sub1" ).prop( "disabled", true );
    $( "#sub2" ).prop( "disabled", true );

    }
	else {
	$( "#sub0" ).prop( "disabled", false );
	$( "#sub1" ).prop( "disabled", false );
	$( "#sub2" ).prop( "disabled", false );
	}

});


$('#kategori2').change(function(){

if($("#kategori2").val() == "") {

	$( "#kategori2" ).prop( "disabled", false );
	$( "#isim2" ).prop( "disabled", false );
	$( "#kisi2" ).prop( "disabled", false );

}
else {

	$( "#isim2" ).prop( "disabled", true );
	$( "#kisi2" ).prop( "disabled", true );

}

});
$('#isim2').change(function(){

if($("#isim2").val() == "") {

	$( "#kategori2" ).prop( "disabled", false );
	$( "#isim2" ).prop( "disabled", false );
	$( "#kisi2" ).prop( "disabled", false );

}
else {

	$( "#kategori2" ).prop( "disabled", true );
	$( "#kisi2" ).prop( "disabled", true );

}

});
$('#kisi2').change(function(){

if($("#kisi2").val() == "") {

	$( "#kategori2" ).prop( "disabled", false );
	$( "#isim2" ).prop( "disabled", false );
	$( "#kisi2" ).prop( "disabled", false );

}
else {

	$( "#kategori2" ).prop( "disabled", true );
	$( "#isim2" ).prop( "disabled", true );

}

});

});