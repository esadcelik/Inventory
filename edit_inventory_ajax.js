$(document).ready( function(){

$('#kategori').change(function(){
		var kategori = $('#kategori').val();
		var isim = $('#isim').val();
		var adet = $('#adet').val();
		$.post('edit_fill_inventory.php', {kategori: kategori, isim: isim,  adet: adet}, function(data){
			$('#isim').html(data);
				
			});
	});

$('#isim').change(function(){
		var kategori = $('#kategori').val();
		var isim = $('#isim').val();
		var adet = $('#adet').val();
		$.post('edit_fill_inventory.php', {kategori: kategori, isim: isim,  adet: adet}, function(data){
			$('#adet').html(data);
				
			});
	});

});