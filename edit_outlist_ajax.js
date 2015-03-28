$(document).ready( function(){

$('#kategori').change(function(){
		var kategori = $('#kategori').val();
		var isim = $('#isim').val();
		var kisi = $('#kisi').val();
		var adet = $('#adet').val();
		var tarih = $('#tarih').val();
		$.post('edit_fill_outlist.php', {kategori: kategori,isim: isim, kisi: kisi, adet: adet, tarih: tarih}, function(data){
			$('#isim').html(data);
				
			});
	});
$('#isim').change(function(){
		var kategori = $('#kategori').val();
		var isim = $('#isim').val();
		var kisi = $('#kisi').val();
		var adet = $('#adet').val();
		var tarih = $('#tarih').val();
		$.post('edit_fill_outlist.php', {kategori: kategori,isim: isim, kisi: kisi, adet: adet, tarih: tarih}, function(data){
			$('#kisi').html(data);
				
			});
	});
$('#kisi').change(function(){
		var kategori = $('#kategori').val();
		var isim = $('#isim').val();
		var kisi = $('#kisi').val();
		var adet = $('#adet').val();
		var tarih = $('#tarih').val();
		$.post('edit_fill_outlist.php', {kategori: kategori,isim: isim, kisi: kisi, adet: adet, tarih: tarih}, function(data){
			$('#adet').html(data);
				
			});
	});
$('#adet').change(function(){
		var kategori = $('#kategori').val();
		var isim = $('#isim').val();
		var kisi = $('#kisi').val();
		var adet = $('#adet').val();
		var tarih = $('#tarih').val();
		$.post('edit_fill_outlist.php', {kategori: kategori,isim: isim, kisi: kisi, adet: adet, tarih: tarih}, function(data){
			$('#tarih').html(data);
				
			});
	});
});