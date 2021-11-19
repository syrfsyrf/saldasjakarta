function getDetailOrder(param){
	html = '';
	$.ajax({
		type    : 'ajax',
		url     : base_url+'data/Data_order/getDetailOrderCash',
		async   : true,
		dataType    : 'json',
		success : function(data){
			if (!$.trim(data)){
				total_cart = '0';
				document.getElementById('checkbtn').style.display = 'none';	
			} else {
				if (param == 'SUM') {
					total_cart = data.length;
				} else if (param == 'DETAIL') {
					var i;
					for(i=0; i<data.length; i++){
						html+= '<tr class="text-center">'+
						'<td class="product-remove"><a href="javascript:deleteOrder('+data[i].id+');"><span class="ion-ios-close"></span></a></td>'+
						'<td class="image-prod"><div class="img" style="background-image:url('+base_url+data[i].path+'/'+data[i].file+');"></div></td>'+
						'<td class="product-name">'+
						'<h3>'+data[i].produk+'</h3>'+
						'</td>'+
						'<td class="price">Rp '+data[i].harga_stock+'</td>'+
						'<td class="quantity">'+
						'<div class="input-group mb-3">'+
						'<input type="text" name="quantity" class="quantity form-control input-number" value="'+data[i].kuantitas+'" min="1" max="100">'+
						'</div>'+
						'</td>'+
						'<td class="total">Rp '+data[i].total_produk+'</td>'+
						'</tr>';
					}

					document.getElementById('checkbtn').style.display = 'block';
				} else if (param == 'CART.SUMMARY') {
					var i;
					for(i=0; i<data.length; i++){
						html+= '<p class="d-flex">'+
						'<span><b>'+data[i].kuantitas+' x '+data[i].produk+'</b></span>'+
						'<span>Rp '+data[i].total_produk+'</span>'+
						'</p>'+
						'<hr>';
					}
				}
			}
			if (param == 'DETAIL') {
				$('#targetOrder').html(html);
				sumOrder(param);
			} else if (param == 'CART.SUMMARY') {
				$('#cart_summary').html(html);
				sumOrder(param);
			} else if (param == 'SUM') {
				$('#total_cart').html('['+total_cart+']');
			}
		}
	});
}