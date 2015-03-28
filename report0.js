$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if($("#kategori").val() == "" && $("#isim").val() == "" ) 
    {
    $( "#sub" ).prop( "disabled", true );
    $( "#exel" ).prop( "disabled", true );}
	else 
	{
	$( "#sub" ).prop( "disabled", false );
	$( "#exel" ).prop( "disabled", false );}


});
$('#kategori').change(function(){
		var kategori = $(this).val();
			$.post('fillreport0Cat.php', {kategori: kategori}, function(data){
				$('#isim').html(data);
			});
	});

$('#kategori').change(function(){

if($("#kategori").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );


}
else {

	$( "#isim" ).prop( "disabled", true );

}

});
$('#isim').change(function(){

if($("#isim").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );


}
else {

	$( "#kategori" ).prop( "disabled", true );

}

});

});