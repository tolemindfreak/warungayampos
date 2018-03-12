<div id="POSAPP" class="row">
        <header class="col s12 POSHeader">
        </header>
        <aside class="col s12 m3 l3 row card POSAside">
            <div class="OrderSummary col s12">
                <h5>Order Summary</h5>
            </div>
            <div class="OrderList col s12">
                <ul class="row">
                <!--
                    <li class="col s12 Ordered" data-orderedmenu="1">
                        <ul class="row">
                            <li class="OrderListAmount col s1">2</li>
                            <li class="OrderListName col s7">Ayam Bakar</li>
                            <li class="OrderListPrice col s3">Rp22.000</li>
                        </ul>
                    </li>
                    -->
                </ul>
            </div>
            <div class="row OrderPrice col s12">
                <ul class="row col s12">
                    <li class="col s6">Total</li>
                    <li class="col s6 PriceTotal">Rp 0</li>
                </ul>
            </div>
            <div class="row col s12">
                <form>
                    <input type="number" value="0" class="POSUangBayarInput">
                    <input type="button" value="Hitung" class="waves-effect waves-light btn POSBtnHitung" style="width:100%;">
                </form>
            </div>
        </aside>
        <main class="MenuList col s12 m8 l8 offset-m3 row card ">
            <div class="MenuListHead col s12">
                <ul>

                </ul>
            </div>
            <div class="MenuListBody col s12 row">
                <ul>
                    <!-- Akan Di Tambahkan Otomatis dengan JQuery Ajax -->
                </ul>
            </div>
        </main>
    </div>
    <div id="modal1" class="modal modal-fixed-footer OrderSummaryModal">
        <div class="modal-content">
            <h4>Order Summary</h4>
            <div class="row col s12">
                <div class="row col s3 card" style="height:200px;padding-top:130px;margin:20px;">
                    <h6 style="font-weight:bold;">Total : </h6>
                    <h6 style="font-weight:bold;" class="OrderSummaryModalTotal">Rp 50.000</h6>
                </div>
                <div class="row col s3 card" style="height:200px;padding-top:130px;margin:20px;">
                    <h6 style="font-weight:bold;">Uang Bayar : </h6>
                    <h6 style="font-weight:bold;" class="OrderSummaryModalBayar">Rp 100.000</h6>
                </div>
                <div class="row col s3 card" style="height:200px;padding-top:130px;margin:20px;">
                    <h6 style="font-weight:bold;">Uang Kembali :</h6>
                    <h6 style="font-weight:bold;" class="OrderSummaryModalKembali">Rp 50.000</h6>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat POSBtnPrint">PRINT</a>
        </div>
    </div>
    <script type="text/javascript" src="js/bin/app/pos_data.js"></script>
    <script type="text/javascript" src="js/bin/app/pos_main.js"></script>