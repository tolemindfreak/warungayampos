$(document).ready(function(){
    
   $('.modal').modal();
    
    function getTotal(){
        Total = 0;
        $.each(MenuList,function(index,el){
            Total += el.getTotal();
        });
        return Total;
    }
    
    $('body').on('click', '.btn', function (){
        if ($(this).data("headbtn")) {
            $headBtn = $(this).data("headbtn");
            var listItems = $(".MenuListBody > ul > li");
            listItems.each(function(idx, li) {
                var product = $(li);
                if(!product.hasClass($headBtn)){
                    product.css("display","none");
                }else{
                    product.css("display","block");
                }
            });
        }
        
        if($(this).data("menuitem")){
            if($(this).parent().hasClass("Unordered")){
                    $(this).parent().removeClass("Unordered");
                    $(this).parent().addClass("Ordered");
                    //console.log($('*[data-orderedmenu="' + $(this).data("menuitem") + '" ]').data("orderedmenu"));
                    $('*[data-orderedmenu="' + $(this).data("menuitem") + '" ]').removeClass('Unordered');
                    $('*[data-orderedmenu="' + $(this).data("menuitem") + '" ]').addClass('Ordered');
            }
            MenuList[$(this).data("menuitem") - 1].addAmount();
            var amount = MenuList[$(this).data("menuitem") - 1].getAmount();
            var total = MenuList[$(this).data("menuitem") - 1].getTotal();
            $(this).find(".MenuItemAmount").text("x" + amount);
            //$(this).children(".MenuItemTotal").text("Rp " + total);
            $('*[data-orderedmenu="' + $(this).data("menuitem") + '" ]').find('.OrderListAmount').text(amount);
            $('*[data-orderedmenu="' + $(this).data("menuitem") + '" ]').find('.OrderListPrice').text("Rp " + total);
            $(".PriceTotal").text("Rp "+getTotal());
        }
        
        if($(this).data("menuitemreduce")){
            if($(this).parent().hasClass("Ordered") && MenuList[$(this).data("menuitemreduce") - 1].getAmount() == 1){
                $(this).parent().removeClass("Ordered");
                $(this).parent().addClass("Unordered");
                $('*[data-orderedmenu="' + $(this).data("menuitemreduce") + '" ]').removeClass('Ordered');
                $('*[data-orderedmenu="' + $(this).data("menuitemreduce") + '" ]').addClass('Unordered');
                //$('.OrderList li [data-orderedmenu ="ayambakar" ]').hide();
            }
            MenuList[$(this).data("menuitemreduce") - 1].reduceAmount();
            var amount = MenuList[$(this).data("menuitemreduce") - 1].getAmount();
            var total = MenuList[$(this).data("menuitemreduce") - 1].getTotal();
            $(this).prev().find(".MenuItemAmount").text("x" + amount);
            //$(this).children(".MenuItemTotal").text("Rp " + total);
            $('*[data-orderedmenu="' + $(this).data("menuitemreduce") + '" ]').find('.OrderListAmount').text(amount);
            $('*[data-orderedmenu="' + $(this).data("menuitemreduce") + '" ]').find('.OrderListPrice').text("Rp " + total);
            $(".PriceTotal").text("Rp "+getTotal());
        }
    });
    
    $(".POSBtnHitung").click(function(){
        if(getTotal() == 0){
            Materialize.toast('Belum ada menu yang terpilih!', 3000, 'rounded');
        }else if($(".POSUangBayarInput").val() < getTotal()){
            Materialize.toast('Uangnya Kurang!', 3000, 'rounded');
        }
        else{
            TransaksiTotal = getTotal();
            TransaksiBayar = $(".POSUangBayarInput").val();
            TransaksiKembali = TransaksiBayar - TransaksiTotal;
            $(".OrderSummaryModalTotal").text("Rp " + TransaksiTotal);
            $(".OrderSummaryModalBayar").text("RP " + TransaksiBayar);
            $(".OrderSummaryModalKembali").text("Rp " + TransaksiKembali);
            $('#modal1').modal('open');
        }
        
    });
});