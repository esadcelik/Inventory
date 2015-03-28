$(document).ready( function(){

$('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function(){
    if(($("#kategori").val() == "" && $("#isim").val() == "" && $("#nereden").val() == "") || 
    ($("#kategori").val() == "" && $("#isim").val() != "" && $("#nereden").val() != "") ||
    ($("#kategori").val() != "" && $("#isim").val() == "" && $("#nereden").val() != "") ||
    ($("#kategori").val() != "" && $("#isim").val() != "" && $("#nereden").val() == "")) 
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
			$.post('fillreportCat.php', {kategori: kategori}, function(data){
				$('#isim').html(data);
			});
	});

$('#isim').change(function(){
		var isim = $(this).val();
			$.post('fillreportName.php', {isim: isim}, function(data){
				$('#nereden').html(data);
			});
	});
$('#kategori').change(function(){

if($("#kategori").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );
	$( "#nereden" ).prop( "disabled", false );


}
else {

	$( "#isim" ).prop( "disabled", true );
	$( "#nereden" ).prop( "disabled", true );

}

});
$('#isim').change(function(){

if($("#isim").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );
	$( "#nereden" ).prop( "disabled", false );


}
else {

	$( "#kategori" ).prop( "disabled", true );
	$( "#nereden" ).prop( "disabled", true );

}

});
$('#nereden').change(function(){

if($("#nereden").val() != "tumu") {

	$( "#kategori" ).prop( "disabled", false );
	$( "#isim" ).prop( "disabled", false );
	$( "#nereden" ).prop( "disabled", false );


}
else {

	$( "#kategori" ).prop( "disabled", true );
	$( "#isim" ).prop( "disabled", true );

}

});

});