$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if(($("#kategori").val() == "" && $("#isim").val() == "" && $("#nereye").val() == "") || 
    ($("#kategori").val() == "" && $("#isim").val() != "" && $("#nereye").val() != "") ||
    ($("#kategori").val() != "" && $("#isim").val() == "" && $("#nereye").val() != "") ||
    ($("#kategori").val() != "" && $("#isim").val() != "" && $("#nereye").val() == "")) 
    {
    $( "#sub" ).prop( "disabled", true );
    $( "#exel" ).prop( "disabled", true );}
	else 
	{
	$( "#sub" ).prop( "disabled", false );
	$( "#exel" ).prop( "disabled", false );}

});



$(function() {
    $( "#tarih1" ).datepicker({dateFormat:"yy-mm-dd"});
    
  });
  
  $(function() {
    $( "#tarih2" ).datepicker({dateFormat:"yy-mm-dd"});
    
  });

$('#kategori').change(function(){
		var kategori = $(this).val();
			$.post('fillreport1Cat.php', {kategori: kategori}, function(data){
				$('#isim').html(data);
			});
	});
$('#isim').change(function(){
		var isim = $(this).val();
			$.post('fillreport1Name.php', {isim: isim}, function(data){
				$('#nereye').html(data);
			});
	});
$('#kategori').change(function(){

if($("#kategori").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );
	$( "#nereye" ).prop( "disabled", false );


}
else {

	$( "#isim" ).prop( "disabled", true );
	$( "#nereye" ).prop( "disabled", true );

}

});
$('#isim').change(function(){

if($("#isim").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );
	$( "#nereye" ).prop( "disabled", false );


}
else {

	$( "#kategori" ).prop( "disabled", true );
	$( "#nereye" ).prop( "disabled", true );

}

});
$('#nereye').change(function(){

if($("#nereye").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );
	$( "#nereye" ).prop( "disabled", false );


}
else {

	$( "#kategori" ).prop( "disabled", true );
	$( "#isim" ).prop( "disabled", true );

}

});



});