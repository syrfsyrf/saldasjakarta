var base_url = 'http://localhost/saldasjakarta/';
// var base_url = window.location.host;
// var base_url = 'http://47.254.249.69/saldasjakarta/';

var id_pesanan = 'NULL';
var id_user;
var total_order_nof = 0;

// console.log(id_pesanan);

function getUserLastOrder(id){
	id_user = id;
	html = '';
	
	$.ajax({
		type    : 'ajax',
		url     : base_url+'data/Data_order/getUserLastOrder/'+id,
		async   : true,
		dataType    : 'json',
		success : function(data){
                if (!$.trim(data)){   /*
                	alert('No Available Stock');*/
                	console.log('empty getUserLastOrder');
                } else {
                	var i;
                	for(i=0; i<data.length; i++){
                		id_pesanan = data[i].id_pesanan;
                	}
                	getDetailOrder(id_pesanan);
                }
            }
        });
	// console.log('getuser here');
}

function getDetailOrder(id, param){
	html = '';

	$.ajax({
		type    : 'ajax',
		url     : base_url+'data/Data_order/getDetailOrder/'+id,
		async   : true,
		dataType    : 'json',
		success : function(data){
                if (!$.trim(data)){   /*
                	alert('No Available Stock');*/
                	// console.log('empty getDetailOrder');
                        html = 
                          '<div class="cart-row">'+
                          '<div class="cart-item cart-column">'+
                          '<div class="p-3 bg-success text-white">'+
                          '<div class="row">'+
                          '<div class="col-md-5">'+
                          'Empty'+
                          '</div>'+
                          '<div class="col-md-3"></div>'+
                          '<div class="col-md-3"></span></div>'+
                          '<div class="col-md-1"></div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>';
                } else {
                    if (param == 'DETAIL') {
                        sumOrderDetail(id);
                        var i;
                        for(i=0; i<data.length; i++){
                          html += 
                          '<div class="cart-row">'+
                          '<div class="cart-item cart-column">'+
                          '<div class="p-3 bg-success text-white">'+
                          '<div class="row">'+
                          '<div class="col-md-5">'+
                          ''+data[i].produk+'<br> Rp'+data[i].harga_stock+''+
                          '</div>'+
                          '<div class="col-md-3">'+data[i].kuantitas+'</div>'+
                          '<div class="col-md-3"><span class="cart-price">Rp'+data[i].total_produk+'</span></div>'+
                          '<div class="col-md-1"></div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>';
                      }
                    } else {
                        sumOrder(id);
                        var i;
                        for(i=0; i<data.length; i++){
                          html += 
                          '<div class="cart-row">'+
                          '<div class="cart-item cart-column">'+
                          '<div class="p-3 bg-success text-white">'+
                          '<div class="row">'+
                          '<div class="col-md-5">'+
                          ''+data[i].produk+'<br> Rp'+data[i].harga_stock+''+
                          '</div>'+
                          '<div class="col-md-3">'+data[i].kuantitas+'</div>'+
                          '<div class="col-md-3"><span class="cart-price">Rp'+data[i].total_produk+'</span></div>'+
                          '<div class="col-md-1"><a href="#" class="btn-trash" onclick="deleteOrder('+data[i].id+')"><i class="text-white fas fa-trash"></i></a></div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>';
                      }
                    }

              }
              $('#cart_items').html(html);
          }
      });
}

function getDetailOrderCash(id, param){
    html = '';

    $.ajax({
        type    : 'ajax',
        url     : base_url+'data/Data_order/getDetailOrderCash/'+id,
        async   : true,
        dataType    : 'json',
        success : function(data){
                if (!$.trim(data)){   /*
                    alert('No Available Stock');*/
                    // console.log('empty getDetailOrder');
                        html = 
                          '<div class="cart-row">'+
                          '<div class="cart-item cart-column">'+
                          '<div class="p-3 bg-success text-white">'+
                          '<div class="row">'+
                          '<div class="col-md-5">'+
                          'Empty'+
                          '</div>'+
                          '<div class="col-md-3"></div>'+
                          '<div class="col-md-3"></span></div>'+
                          '<div class="col-md-1"></div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>';
                } else {
                    if (param == 'DETAIL') {
                        sumOrder(id);
                        var i;
                        for(i=0; i<data.length; i++){
                          html += 
                          '<div class="cart-row">'+
                          '<div class="cart-item cart-column">'+
                          '<div class="p-3 bg-success text-white">'+
                          '<div class="row">'+
                          '<div class="col-md-5">'+
                          ''+data[i].produk+'<br> Rp'+data[i].harga_stock+''+
                          '</div>'+
                          '<div class="col-md-3">'+data[i].kuantitas+'</div>'+
                          '<div class="col-md-3"><span class="cart-price">Rp'+data[i].total_produk+'</span></div>'+
                          '<div class="col-md-1"></div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>';
                      }
                    } else {
                        sumOrder(id);
                        var i;
                        for(i=0; i<data.length; i++){
                          html += 
                          '<div class="cart-row">'+
                          '<div class="cart-item cart-column">'+
                          '<div class="p-3 bg-success text-white">'+
                          '<div class="row">'+
                          '<div class="col-md-5">'+
                          ''+data[i].produk+'<br> Rp'+data[i].harga_stock+''+
                          '</div>'+
                          '<div class="col-md-3">'+data[i].kuantitas+'</div>'+
                          '<div class="col-md-3"><span class="cart-price">Rp'+data[i].total_produk+'</span></div>'+
                          '<div class="col-md-1"><a href="#" class="btn-trash" onclick="deleteOrder('+data[i].id+')"><i class="text-white fas fa-trash"></i></a></div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>';
                      }
                    }

              }
              $('#cart_items').html(html);
          }
      });
}

function deleteOrder(param){
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_order/deleteOrder',
        async   : true,
        dataType    : 'json',
        data : {id_pesanan:param},
        success : function(data){
            getDetailOrderCash();
            sumOrder(id_pesanan);
        }
    });
}

function doCancel(){
    if (id_pesanan == 'NULL') {
        console.log('Nothing To Cancel');
    } else {
        $.ajax({
            type    : "POST",
            url     : base_url+'data/Data_order/cancelOrder',
            async   : true,
            dataType    : 'json',
            data : {id_pesanan:id_pesanan},
            success : function(data){
                location.reload();
            }
        });
    }
}

function doCheckOut(){
    if (id_pesanan == 'NULL') {
        console.log('Nothing To Check Out');
    } else {
        var x = document.getElementById("dibayar_text");
        if (x.style.display === "none") {
            x.style.display = "block";
        }
    }
}

function checkOut(){
    kembali = document.getElementById("kembalian").value;
    dibayar = document.getElementById("kembalian").dibayar_textbox;
    if (kembali == ' ' || dibayar == ' ' || kembali < 0) {
        alert("nominal tidak valid");
    } else {
        $.ajax({
            type    : "POST",
            url     : base_url+'data/Data_order/checkOut/KASIR',
            async   : true,
            dataType    : 'json',
            data : {id_pesanan:id_pesanan},
            success : function(data){
                if (data == true) {
                    alert("Sukses");
                    location.reload();
                } else {
                    for(i=0; i<data.length; i++){
                        alert('Stock '+data[i].nama+' tidak tersedia');
                    }
                }
            }
        });
    }
}

function getOrder(id){
    var alertstock;
	html = '';
	kategori = '';
	$.ajax({
		type    : 'ajax',
		url     : base_url+'data/Data_order/getOrder/'+id,
		async   : true,
		dataType    : 'json',
		success : function(data){
                if (!$.trim(data)){   /*
                	alert('No Available Stock');*/
                	kategori = 'No Available Stock';
                } else {
                	var i, id;
                	for(i=0; i<data.length; i++){
                        if (data[i].sisa_stok == '0') {
                            alertstock = 'onclick="alert(\'No Available Stock\');"';
                        } else {
                            alertstock = 'onclick="addOrder('+data[i].id_stock+')"';
                        }
                		kategori = data[i].kategori;
                		html += '<div class="col-xl-6 col-md-6 mb-6">'+
                		'<button class="btn btn-secondary btn-block" '+alertstock+'>'+
                		'<div class="text-white">'+
                		'<div class="card-body" style="text-align:center;"><h6>'+data[i].nama+'</h6><div> Rp '+data[i].harga+'/'+data[i].jenis_harga_detail+'</div><div class="text-white-50 small">Sisa Stok: '+data[i].sisa_stok+'</div></div>'+
                		'</div>'+
                		'</button>'+
                		'</div>';
                	}
                }
                $('#targetOrder').html(html);
                document.getElementById("kategoriname").innerHTML = kategori;
            }
        });
}

function generateOrder(id_user){
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_order/generateOrder',
        async   : true,
        dataType    : 'json',
        data : {id_user:id_user, metode_pembayaran:'1'},
        success : function(data){
            if (data == true) {
                getUserLastOrder(id_user);
            } else {
                console.log('im FALSE');
            }
        }
    });
}

function addOrder(id_stock){
    if (id_pesanan == 'NULL') {
        generateOrder(id_user);
    } else {
        $.ajax({
            type    : "POST",
            url     : base_url+'data/Data_order/addOrder',
            async   : true,
            dataType    : 'json',
            data : {id_stock:id_stock, qty:1},
            success : function(data){
                getDetailOrderCash();
                // $('#show_log').html(html);
                // console.log('im here');
            }
        });
    }

	// console.log(id_user);
}

function sumOrder(id){
    html = '';
    $.ajax({
        type    : 'ajax',
        url     : base_url+'data/Data_order/sumOrder/'+id,
        async   : true,
        dataType    : 'json',
        success : function(data){
                if (!$.trim(data)){   /*
                    alert('No Available Stock');*/
                    // kategori = 'No Available Stock';
                } else {
                    var i, id;
                    for(i=0; i<data.length; i++){
                        total_order = data[i].total_order;
                        total_order_nof = data[i].total_order_nof;
                    }
                }
                document.getElementById("totalOrder").innerHTML = 'Rp'+total_order;
            }
        });
}

function sumOrderDetail(id){
    html = '';
    $.ajax({
        type    : 'ajax',
        url     : base_url+'data/Data_order/sumOrderDetail/'+id,
        async   : true,
        dataType    : 'json',
        success : function(data){
                if (!$.trim(data)){   /*
                    alert('No Available Stock');*/
                    // kategori = 'No Available Stock';
                } else {
                    var i, id;
                    for(i=0; i<data.length; i++){
                        total_order = data[i].total_order;
                        total_order_nof = data[i].total_order_nof;
                    }
                }
                document.getElementById("totalOrder").innerHTML = 'Rp'+total_order;
            }
        });
}

$(document).ready(function(){
    $("#dibayar_textbox").change(function(){
        var kembali;
        var dibayar = document.getElementById("dibayar_textbox").value;
        // alert(total_order_nof);
        kembali = dibayar - total_order_nof;
        document.getElementById("kembalian").value = kembali;
    });

    $("input#testing").change(function(){
        alert('ok');
    });
});

function getTransaksi(id){
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_transaksi/getTransaksi',
        async   : true,
        dataType    : 'json',
        data : {id_user:id},
        success : function(data){
            if (!$.trim(data)){   /*
                alert('No Available Stock');*/
                // kategori = 'No Available Stock';
            } else {
                var i, id;
                var tgl_pembayaran = '';
                var status = '';
                for(i=0; i<data.length; i++){
                    if (data[i].tgl_pembayaran==null) {
                        tgl_pembayaran = '';
                    } else {
                        tgl_pembayaran = data[i].tgl_pembayaran;
                    }

                    if (data[i].status == '0') {
                        status = '<button class="btn btn-primary btn-icon-split"><span class="text">'+data[i].detail+'</span></button>';
                    } else if (data[i].status == '1') {
                        status = '<button class="btn btn-success btn-icon-split"><span class="text">'+data[i].detail+'</span></button>';
                    } else if (data[i].status == '5') {
                        status = '<button class="btn btn-warning btn-icon-split"><span class="text">'+data[i].detail+'</span></button>';
                    }

                    html += '<tr>'+
                    '<td>'+data[i].insert_date+'</td>'+
                    '<td>'+status+'</td>'+
                    '<td>'+data[i].jenis+'</td>'+
                    '<td>'+tgl_pembayaran+'</td>'+
                    '<td>'+
                    '<div class="dropdown no-arrow">'+
                    '<a href="#" class="dropdown-toggle btn btn-info btn-circle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                    '<i class="fas fa-ellipsis-v fa-sm fa-fw "></i></a>'+
                    '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">'+
                    '<a class="dropdown-item" href="'+base_url+'Pembayaran/detail/'+data[i].id+'">Detail</a>'+
                    '</div>'+
                    '</div>'+
                    '</td>'+
                    '</tr>';
                }
            }
            $('#tableTrans').html(html);
        }
    });
}