
<?php include("hf-element/header.php") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg"
    style="background-image: url(&quot;img/breadcrumb.jpg&quot;);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>iletişim</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<div class="container">
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">

                    <div class="container"><?php
    if (isset($_GET['gonder']) && $_GET['gonder'] == 'basarili') {
        echo '<div class="alert alert-success"><strong>Mesaj başarıyla gönderildi!</strong></div>';
    }else if (isset($_GET['gonder']) && $_GET['gonder'] == 'basarisiz') {
        echo '<div class="alert alert-danger"><strong>Mesaj gönderilirken bir hata ile karşılaşıldı!</strong></div>';
    } ?>
                        <label for="form_name"><b>Neredeyiz ? *</b></label>
                        <div style="width: 100%"><iframe width="533" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $ayarcek['ayar_konum'];?>"></iframe></div>
                        <form action="hf-element/islem.php" method="POST">
                            <div class="controls">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_name"><b>Adınız *</b></label>
                                            <input id="form_name" type="text" name="mesaj_kadi" class="form-control"
                                                placeholder="Lütfen adınızı giriniz*" required="required"
                                                data-error="Firstname is required.">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_lastname"><b>Soyadınız *</b></label>
                                            <input id="form_lastname" type="text" name="mesaj_sadi" class="form-control"
                                                placeholder="Lütfen soyisminizi giriniz *" required="required"
                                                data-error="Lastname is required.">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_email"><b>Mail Adresiniz *</b></label>
                                            <input id="form_email" type="email" name="mesaj_mail" class="form-control"
                                                placeholder="Lütfen mail adresinizi giriniz *" required="required"
                                                data-error="Valid email is required.">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_need"><b>Size nasıl yardımcı olabiliriz ? *</b></label>
                                            <select id="form_need" name="mesaj_konu" class="form-control" required="required"
                                                data-error="Bir konnu seçiniz">
                                                <option value="" selected disabled>---Lütfen bir konu seçiniz---   </option>
                                                <option value="1">Şikayet</option>
                                                <option value="2">Öneri</option>
                                                <option value="3">Soru veya İstekler</option>
                                                <option value="4">Teşekkür</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="form_message"><b>Mesajınız *</b></label>
                                            <textarea id="form_message" name="mesaj_icerik" class="form-control"
                                                placeholder="Lütfen mesajınızı giriniz" rows="4" required="required"
                                                data-error="Please, leave us a message."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-success btn-send  pt-2 btn-block" name="iletisim_kaydet" value="Gönder">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<?php include 'hf-element/footer.php'; ?>