// base_url = 'http://localhost/saldasjakarta/';
base_url = 'http://47.254.249.69/saldasjakarta/';

function getAuditData(){
    var dateStart = document.getElementById("dateStart").value;
    var dateEnd = document.getElementById("dateEnd").value;
    var html = '';
    var summary = 0;
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_transaksi/getAuditData',
        async   : true,
        dataType    : 'json',
        data : {dateStart:dateStart, dateEnd:dateEnd},
        success : function(data){
            if (!$.trim(data)){
            } else {
                var i;
                for(i=0; i<data.length; i++){
                    summary += Number(data[i].total);
                    // alert('Stock '+data[i].nama+' tidak tersedia');
                    html += '<tr>'+
                    '<td>'+data[i].transaction_id+'</td>'+
                    '<td>'+data[i].metode_pembayaran+'</td>'+
                    '<td>'+data[i].tgl_pembayaran+'</td>'+
                    '<td>Rp '+data[i].dtotal+'</td>'+
                    '<td>'+
                    '<div class="dropdown no-arrow">'+
                    '<a href="#" class="dropdown-toggle btn btn-info btn-circle" role="button" id="dropdownMenuLink"'+
                    'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                    '<i class="fas fa-ellipsis-v fa-sm fa-fw "></i></a>'+
                    '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">'+
                    '<a class="dropdown-item" href="#">Detail</a>'+
                    '</div>'+
                    '</div>'+
                    '</td>'+
                    '</tr>';
                }
            }
            $('#t_audit').html(html);
            // alert(summary);
            document.getElementById("summary").innerHTML = formatter.format(summary);
        }
    });
}

var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'IDR',
});

function generateReport(){
    var monthReport = document.getElementById("monthReport").value;
    var year = monthReport.substring(0, 4);
    var month = monthReport.substring(5, 7);
    $.ajax({
        type    : "POST",
        url     : base_url+'data/Data_transaksi/generateReport',
        async   : true,
        dataType    : 'json',
        data : {year:year, month:month},
        success : function(data){
            if (data == true) {
                alert("Sukses Generate Report");
            } else {
                alert("Gagal Generate Report");
            }
        }
    });
}