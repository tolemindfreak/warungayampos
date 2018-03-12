var MenuList = new Array();

$(document).ready(function(){
    
    function MenuItem() {
	  //properties/fields
	  	var _id = 1;
		var _nama = "Ayam Bakar";
		var _harga = 11000;

	  return {
	    	setId : function(id){_id = id;},
			getId : function(){return _id;},
			setNama : function(nama){_nama = nama;},
			getNama : function(){return _nama;},
			setHarga : function(harga){_harga = harga;},
			getHarga : function(){return _harga;}
	  };
	}
   
    function AppendMenuList(id,nama,harga,image){
        $(".ListMenuContent > ul").append(
                '<li class="col s3 card row" data-menuitem="' + id + '">' +
                    '<div class="col s3">' +
                        '<img src="images/'+ image + '" alt="" class="MenuImage circle responsive-img" >' +
                    '</div>' +
                    '<div class="col s8">' +
                        '<h6 class="MenuName">' + nama + '</h6>' +
                        '<h7 class="MenuPrice">Rp ' + harga + '</h7>' +
                    '</div>' +
                '</li>'
        );
    }
    
    $.getJSON('ws/ws.php?app=warungnasi&module=menu&action=getMenu', function(data) {
        var dat = {};
        $.each(data.menu,function(index, el) {
                AppendMenuList(el.id,el.nama,el.harga,el.image);
                var nMenu = new MenuItem();
                nMenu.setId(el.id); 
                nMenu.setNama(el.nama);
                nMenu.setHarga(el.harga);
                MenuList[index] = nMenu;
                dat[el.nama] = "images/" + el.image;
        });
        console.log(dat);
         $('input.autocomplete').autocomplete({
            data: dat
          });
	});
   
});