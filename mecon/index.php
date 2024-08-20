<?php $oldugumsayfa = 'panel-ana-sayfasi';?>
<?php include 'hf-element/header.php'; ?>

<div class="main-content">
    <h2>Panel Anasayfası</h2>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <h1><?php echo (tarih()); ?></h1>
                <h3>Hoşgeldiniz</h3>
            </div>
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" data-start="0" data-end="83" data-postfix="" data-duration="1500" data-delay="0">83</div>
                        <h3>Toplam üye sayısı</h3>
                        <p>Siteye kayıtı tüm kullanıcıların sayısı.</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-green">
                        <div class="icon"><i class="entypo-tag"></i></div>
                        <div class="num" data-start="0" data-end="135" data-postfix="" data-duration="1500" data-delay="600">135</div>
                        <h3>Ürün sayısı</h3>
                        <p>Kayıtlı tüm ürünlerin sayısı</p>
                    </div>
                </div>
                <div class="clear visible-xs"></div>
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="fa fa-check-square"></i></div>
                        <div class="num" data-start="0" data-end="23" data-postfix="" data-duration="1500" data-delay="1200">23</div>
                        <h3>Sipariş sayısı</h3>
                        <p>Toplam verilen sipariş sayısı</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="tile-stats tile-blue">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">52</div>
                        <h3>Anlık ziyaretçi sayısı</h3>
                        <p>Sitede şu anda kullanan kişilerin sayısı</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'hf-element/footer.php'; ?>