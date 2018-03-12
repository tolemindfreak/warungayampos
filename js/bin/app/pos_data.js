var foobar = "O HAI";
var MenuList = new Array();
var KategoriList = new Array();
var Total = 0;
var NextTransactionID;
var TransaksiTotal;
var TransaksiKembali;
var TransaksiBayar;

$(document).ready(function(){
    
	function Menu() {
	  //properties/fields
	  	var _id = 1;
		var _nama = "Ayam Bakar";
		var _harga = 11000;
		var _jumlah = 0;

	  return {
	    	setId : function(id){_id = id;},
			getId : function(){return _id;},
			setNama : function(nama){_nama = nama;},
			getNama : function(){return _nama;},
			setHarga : function(harga){_harga = harga;},
			getHarga : function(){return _harga;},
			addAmount : function(){_jumlah = _jumlah + 1;},
			reduceAmount : function(){_jumlah = _jumlah - 1;},
            resetAmount : function(){_jumlah = 0;},
			getAmount : function(){return _jumlah;},
			getTotal : function(){return _jumlah * _harga;}
	  };
	}

	function Kategori() {
	  //properties/fields
	  	var _id = 1;
		var _nama = "Ayam Bakar";

	  return {
	    	setId : function(id){_id = id;},
			getId : function(){return id;},
			setNama : function(nama){_nama = nama;},
			getNama : function(){return _nama;}
	  };
	}
    
    function ResetTransaction(){
        GetNextTransactionID();
        Total = 0;
        TransaksiTotal = 0;
        TransaksiKembali = 0;
        TransaksiBayar = 0;
        $.each(MenuList,function(index,el){
            el.resetAmount();
        });

        $(".MenuListBody > ul li").each(function(){
            if($(this).hasClass("Ordered")){
                $(this).removeClass("Ordered");
                $(this).addClass("Unordered");
            }
        });
        /*
        $.each(UIMenuList,function(index,el){
            if(el.hasClass("Ordered")){
                el.removeClass("Ordered");
                el.addClass("Unordered");
            }
        });*/
        var UIMenuOrderList = $(".OrderList > ul li");
        $(".OrderList > ul li").each(function(){
            if($(this).hasClass("Ordered")){
                $(this).removeClass("Ordered");
                $(this).addClass("Unordered");
            }
        });
        /*
        $.each(UIMenuOrderList,function(index,el){
            if(el.hasClass("Ordered")){
                el.removeClass("Ordered");
                el.addClass("Unordered");
            }
        });*/
        $(".POSUangBayarInput").val(0);
        $(".PriceTotal").text("Rp 0");
    }

	
	GetNextTransactionID();

	function AppendMenu(id,nama,harga,image){
		$styleContent = "";



        $styleContent = 'style="background:url(images/' + image + ');background-size: cover;"';

		$(".MenuListBody > ul").append(
			'<li class="col s3 card row  ' + ' Unordered" ' + $styleContent + '>' +
				'<a class="MenuItemButton waves-effect waves-light btn"data-menuitem="' + id + '">' + 
                    '<div class="MenuItemTextContainer col s12 row">' +
					   '<h7 class="MenuItemName col s12">' + nama + '</h7>' +
					   '<h8 class="MenuItemPrice col s12">Rp ' + harga + '</h8>' +
					   '<h9 class="MenuItemAmount col s12">x1</h9>' + 
                    '</div>' +
					//'<h8 class="MenuItemTotal col s12 center">Rp 0</h8>' + 
				'</a>' + 
				'<a class="MenuItemReduce waves-effect waves-light btn "data-menuitemreduce="' + id + '">-</a>' + 
				'</li>'
			);
	}

	function AppendMenuOrder(id,nama,harga){
		$(".OrderList > ul").append(
				'<li class="col s12 Unordered" data-orderedmenu="'+ id +'">' +
					'<ul class="row">' + 
						'<li class="OrderListAmount col s1">0</li>' +
						'<li class="OrderListName col s7">' + nama + '</li>' + 
						'<li class="OrderListPrice col s3">Rp' + harga + '</li>' +
					'</ul>' + 
				'</li>'
			);
	}

	$.getJSON('ws/ws.php?app=warungnasi&module=menu&action=getMenu', function(data) {
			$.each(data.menu,function(index, el) {
					AppendMenu(el.id,el.nama,el.harga,el.image);
					AppendMenuOrder(el.id,el.nama,el.harga);
					var nMenu = new Menu();
					nMenu.setId(el.id);
					nMenu.setNama(el.nama);
					nMenu.setHarga(el.harga);
					MenuList[index] = nMenu;
			});
	});
    
    function GetNextTransactionID(){
        $.getJSON('ws/ws.php?app=warungnasi&module=menu&action=getNextTransactionID', function(data) {
            NextTransactionID = data.AUTO_INCREMENT;
        });
    }
    
    $(".POSBtnPrint").click(function(){
        $.post('ws/ws.php?app=warungnasi&module=menu&action=addNewTransaction', 
    		{	noTransaksi: NextTransactionID,
    			jumlah: TransaksiTotal,
    			kembali: TransaksiKembali,
    			userId: "yandi"
    		}, 
    		function(data, textStatus, xhr) {
            
            var doc = new jsPDF();

            // We'll make our own renderer to skip this editor
            var specialElementHandlers = {
                '#editor': function(element, renderer){
                    return true;
                }
            };
            doc.setFontSize(40);
            doc.text(35, 25, "Restoran Sawana");
            doc.setFontSize(14);
            var dates = new Date($.now());
            
            doc.text(35, 35, dates.toDateString() + " " + dates.toTimeString());
            doc.setFontSize(18);
            var linePosition = 45;
            
            $.each(MenuList,function(index,el){
                
                
                
                if(el.getAmount() > 0){
                    linePosition += 10;
                    doc.text(35, linePosition, el.getAmount().toString());
                    doc.text(50, linePosition, el.getNama().toString());
                    doc.text(140, linePosition, "Rp " + el.getHarga().toString());
                    $.post('ws/ws.php?app=warungnasi&module=menu&action=addNewTransactionDetails', 
                        {	noTransaksi: NextTransactionID,
                            idMenu: el.getId(),
                            jumlah: el.getAmount()
                        }, 
                        function(data, textStatus, xhr) {
                    });
                }
            });
            
            linePosition += 30;
            
            doc.setFontSize(20);
            doc.text(35, linePosition, "Total");
            doc.text(140, linePosition, "Rp " + TransaksiTotal.toString());
            linePosition += 10;
            doc.text(35, linePosition, "Bayar");
            doc.text(140, linePosition, "Rp " + TransaksiBayar.toString());
            linePosition += 10;
            doc.text(35, linePosition, "Kembali");
            doc.text(140, linePosition, "Rp " + TransaksiKembali.toString());
            
            doc.save('Transaksi Restoran Sawarna ' + dates +' .pdf');
            Materialize.toast('Transaksi Berhasil !', 3000);
            ResetTransaction();
        });
    });
});