var TransaksiList = new Array();
var TotalTransaksi;
$(document).ready(function(){
    
    function TransaksiItem() {
	  //properties/fields
	  	var _id = 1;
		var _jumlah = 0;
        var _kembali = 0;
		var _waktu;
        var _userID;

	  return {
	    	setId : function(id){_id = id;},
			getId : function(){return _id;},
			setJumlah : function(jumlah){_jumlah = jumlah;},
			getJumlah : function(){return _jumlah;},
            setKembali : function(kembali){_kembali = kembali;},
			getKembali : function(){return _kembali;},
			setWaktu : function(waktu){_waktu = waktu;},
			getWaktu : function(){return _userID;}
	  };
	}
   
    function AppenTransaksiList(id,jumlah,kembali,userid,waktu){
        $(".ListMenuContent > table > tbody").append(
                '<tr>' +
                    '<td>' + id + '</td>' +
                    '<td>Rp ' + jumlah + '</td>' +
                    '<td>Rp ' + kembali + '</td>' +
                    '<td>'+ userid +'</td>' +
                    '<td>' + waktu + '</td>' +
                '</tr>'
        );
    }
    
    $.getJSON('ws/ws.php?app=warungnasi&module=menu&action=getTransactionList', function(data) {
        TotalTransaksi = 0;
        $.each(data.transaksi,function(index, el) {
            AppenTransaksiList(el.notransaksi,el.jumlah,el.kembali,el.userid,el.waktu);
            var nTransaksi = new TransaksiItem();
            nTransaksi.setId(el.id); 
            nTransaksi.setJumlah(parseInt(el.jumlah));
            nTransaksi.setKembali(el.kembali);
            nTransaksi.setKembali(el.kembali);
            TransaksiList[index] = nTransaksi;
            TotalTransaksi += parseInt(el.jumlah);
        });
        $(".LISTTRANSAKSITOTAL").text("Rp " + TotalTransaksi);
	});
   
});