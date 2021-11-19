// var base_url = 'http://localhost/saldasjakarta/';
// var base_url = window.location.host;
var base_url = 'http://47.254.249.69/saldasjakarta/';

var id_pesanan = 'NULL';
var id_user;
var status = 'NULL';
var total_order_nof = 0;

function getKategori(){
    html = '';
    var data;   

    $.ajax({
        type    : 'ajax',
        url     : base_url+'data/Data_order/getKategori/JS',
        async   : true,
        dataType    : 'json',
        success : function(data){
            if (!$.trim(data)){
                console.log('empty getDetailOrder');
            } else {
                var i;
                for(i=0; i<data.length; i++){
                 html+= '<div class="container">'+
                 '<div class="row justify-content-center mb-3 pb-3">'+
                 '<div class="col-md-12 heading-section text-center">'+
                 '<h2 class="mb-4">'+data[i].jenis+'</h2>'+
                 '<p>Kami sajikan bagian-bagian Daging Ayam dengan kualitas terbaik</p>'+
                 '</div>'+
                 '</div>'+
                 '</div>'+
                 '<div class="container">'+
                 '<div class="row" id="bodyDiv'+data[i].id+'">'+
                 '</div>'+
                 '</div>';
                 getOrder(data[i].id);
             }
         }
         $('#headDiv').html(html);
         }
     });
}

function getOrder(id, param){
    html2 = '';
    var name_kat;
    $.ajax({
        type    : 'ajax',
        url     : base_url+'data/Data_order/getOrder/'+id+'/'+param,
        async   : true,
        dataType    : 'json',
        success : function(data){
                if (!$.trim(data)){
                    $.ajax({
                        type    : 'ajax',
                        url     : base_url+'data/Data_order/getOrderNotFound/'+id,
                        async   : true,
                        dataType    : 'json',
                        success : function(data){
                            name_kat = data[0].jenis;
                            document.getElementById("name_kat").innerHTML = name_kat;
                        }
                    });
                    html2 += '<div class="col-md-6 col-lg-3">'+
                    '<div class="product">'+
                        '<a href="#" class="img-prod"><img class="img-fluid" src="'+base_url+'assets/frontend/images/product-1.jpg" alt="Colorlib Template">'+
                            '<div class="overlay"></div>'+
                        '</a>'+
                        '<div class="text py-3 pb-4 px-3 text-center">'+
                            '<h3><a href="#">No Product</a></h3>'+
                            '<div class="d-flex">'+
                                '<div class="pricing">'+
                                '</div>'+
                            '</div>'+
                            '<div class="bottom-area d-flex px-3">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
                } else {
                    var i;
                    for(i=0; i<data.length; i++){
                        if (data[i].id == null) {
                            name_kat = data[i].kategori;
                            html2 += 
                            '<div class="col-md-6 col-lg-3">'+
                                '<div class="product">'+
                                    '<a href="#" class="img-prod"><img class="img-fluid" src="'+base_url+data[i].path+'/'+data[i].file+'" alt="Colorlib Template">'+
                                        '<div class="overlay"></div>'+
                                    '</a>'+
                                    '<div class="text py-3 pb-4 px-3 text-center">'+
                                        '<h3><a href="#">'+data[i].nama+'</a></h3>'+
                                        '<div class="d-flex">'+
                                            '<div class="pricing">'+
                                                '<p class="price"><span>Rp '+data[i].harga+' /'+data[i].jenis_harga_detail+'</span></p>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="bottom-area d-flex px-3">'+
                                            '<div class="m-auto d-flex">'+
                                                '<a href="'+base_url+'main/detail_produk/'+data[i].id_produk+'" class="add-to-cart d-flex justify-content-center align-items-center text-center">'+
                                                    '<span><i class="ion-ios-menu"></i></span>'+
                                                '</a>'+
                                                '<a href="javascript:addOrder('+data[i].id_stock+');" class="buy-now d-flex justify-content-center align-items-center mx-1">'+
                                                    '<span><i class="ion-ios-cart"></i></span>'+
                                                '</a>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                        } else {
                            html2 = data[i].nama;
                        }
                    }
                    html2 += '<span><div class="toast mt-3">'+
                            '<div class="toast-header">'+
                              'Add To Cart'+
                            '</div>'+
                            '<div class="toast-body">'+
                              'Success'+
                            '</div>'+
                        '</div></span>';
                // document.getElementById("name_kat").innerHTML = name_kat;
                }
                $('#target_product').html(html2);
                html2 = '';
            }
        });
}

function addOrder(id_stock){
/*    alert(id_pesanan);
    alert(status);*/
    if (id_pesanan == 'NULL' && (status == '5' || status == 'NULL' || status == '1')) {
        generateOrder(id_user, id_stock);
    } else if (id_pesanan == 'UNABLE' || status == '3') {
        alert('Please Finish Your Order Before Add To Cart');
    } else if (status != '5') {
        $.ajax({
            type    : "POST",
            url     : base_url+'data/Data_order/addOrder',
            async   : true,
            dataType    : 'json',
            data : {id_stock:id_stock, id_pesanan:id_pesanan},
            success : function(data){
                if (data == true) {
                    // console.log('im TRUE');
                    $('.toast').toast('show');
                    getDetailOrder('SUM', id_pesanan);
                } else {
                    console.log('im FALSE');
                }
            }
        });
    }
}

function getUserAvailablity(id){
    $.ajax({
        type    : 'ajax',
        url     : base_url+'data/Data_order/getUserAvailablity/'+id,
        async   : true,
        dataType    : 'json',
        success : function(data){
                if (!$.trim(data)){   /*
                    alert('No Available Stock');*/
                    console.log('empty getUserAvailablity');
                } else {
                    if (data[0].avail == '0') {
                        id_pesanan = 'UNABLE';
                        status = data[0].status;
                    } else if (data[0].avail == '1') {
                        getUserLastOrder('SUM', id);
                        status = data[0].status;
                    }
                }
                console.log('id-pesanan :'+id_pesanan);
                console.log('avail :'+status);
            }
        });
}

function getUserLastOrder(param, id){
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
                    // console.log('empty getUserLastOrder');
                    id_pesanan = 'NULL';
                } else {
                    var i;
                    for(i=0; i<data.length; i++){
                        id_pesanan = data[i].id_pesanan;
                    }
                    getDetailOrder(param, id_pesanan);
                }
            }
        });
    // console.log('getuser here');
}

function generateOrder(id_user, id_stock){
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_order/generateOrder',
        async   : true,
        dataType    : 'json',
        data : {id_user:id_user, metode_pembayaran: '0'},
        success : function(data){
            if (data.RESPOND_CODE == '00') {
                window.location = base_url+'Login';
            } else if (data == true) {
                getUserLastOrder('SUM', id_user);
                // addOrder(id_stock);
            } else {
                console.log('im FALSE');
            }
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
            getDetailOrder('DETAIL', id_pesanan);
            sumOrder('DETAIL', id_pesanan);
        }
    });
}

function sumOrder(param, id){
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

                if (param == 'DETAIL') {
                    document.getElementById("sum_total").innerHTML = 'Rp'+total_order;
                } else if (param == 'CART.SUMMARY') {
                    document.getElementById("total_summary").innerHTML = 'Rp'+total_order;
                }
            }
        });
}

function getDataUser(id){
    var nama, email, telp, jalan, rt, rw, kecamatan, kelurahan, kota, provinsi, kd_pos, desa;
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_user/getDataUser',
        async   : true,
        dataType    : 'json',
        data : {id_user:id},
        success : function(data){
            if (!$.trim(data)){

            } else {
                var i, id;
                for(i=0; i<data.length; i++){
                    nama = data[i].nama;
                    email = data[i].email;
                    telp = data[i].telp;
                    jalan = data[i].jalan;
                    rt = data[i].rt;
                    rw = data[i].rw;
                    kecamatan = data[i].kecamatan;
                    kelurahan = data[i].kelurahan;
                    kota = data[i].kota;
                    provinsi = data[i].provinsi;
                    kd_pos = data[i].kd_pos;
                    desa = data[i].desa;
                }
            }
            document.getElementById("nama").value = nama;
            document.getElementById("email").value = email;
            document.getElementById("telp").value = telp;
            document.getElementById("jalan").value = jalan;
            document.getElementById("rt").value = rt;
            document.getElementById("rw").value = rw;
            document.getElementById("kecamatan").value = kecamatan;
            document.getElementById("kelurahan").value = kelurahan;
            document.getElementById("kota").value = kota;
            document.getElementById("provinsi").value = provinsi;
            document.getElementById("kd_pos").value = kd_pos;
            document.getElementById("desa").value = desa;
            document.getElementById("id_pesanan").value = id_pesanan;
        }
    });   
}

function checkOut(){
    var id_pesanan = document.getElementById("id_pesanan").value;
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_order/checkOut/ORDER',
        async   : true,
        dataType    : 'json',
        data : {nama:document.getElementById("nama").value,email:document.getElementById("email").value,telp:document.getElementById("telp").value,jalan:document.getElementById("jalan").value,rt:document.getElementById("rt").value,rw:document.getElementById("rw").value,kecamatan:document.getElementById("kecamatan").value,kelurahan:document.getElementById("kelurahan").value,kota:document.getElementById("kota").value,provinsi:document.getElementById("provinsi").value,kd_pos:document.getElementById("kd_pos").value,desa:document.getElementById("desa").value,id_pesanan:id_pesanan,paymentMethod:document.getElementById("paymentMethod").value},
        success : function(data){
            if (data == true) {
                // alert("Sukses Buat Order");
                window.location.replace(base_url+'Main/detail/IDpesanan/'+id_pesanan);
            } else {
                for(i=0; i<data.length; i++){
                    alert('Stock '+data[i].nama+' tidak tersedia');
                }
            }
        }
    });
    // alert('checkOut'+id_pesanan);
}

function doCancel(id){
    $.ajax({
            type    : "POST",
            url     : base_url+'data/Data_order/cancelOrder',
            async   : true,
            dataType    : 'json',
            data : {id_pesanan:id},
            success : function(data){
                    location.reload();
                /*if (data == true) {
                // alert("Sukses Buat Order");
                } else {
                    alert('ERROR');
                }*/
            }
        });
    /*if (id_pesanan == 'NULL') {
        alert('Nothing To Cancel');
    } else {
        // alert(id);
        $.ajax({
            type    : "POST",
            url     : base_url+'data/Data_order/cancelOrder',
            async   : true,
            dataType    : 'json',
            data : {id_pesanan:id},
            success : function(data){
                if (data == true) {
                // alert("Sukses Buat Order");
                    location.reload();
                } else {
                    alert('ERROR');
                }
            }
        });
    }*/
}