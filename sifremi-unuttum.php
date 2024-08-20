<?php include("hf-element/header.php") ?>
<div class="container">
    <style>
    .bs-example {
        margin: 20px;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0px 0px 8px #28a745;
    }
    </style>
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card card-body bs-example">
            <?php
if (!isset($_GET["step"]) || $_GET["step"] == "1") {
    echo '<form id="submitForm" action="#" method="post" >
    <input type="hidden" >
    <div class="form-group required">
        <label for="username"><b>Telefon Numaranızı Giriniz :</b></label>
        <input type="text" class="form-control text-lowercase" maxlength="10" id="username" required="" name="sifirla_tel" placeholder="Lütfen telefon numaranızı başında sıfır olmadan giriniz.">
    </div>

    <div class="form-group pt-1">
        <button class="btn btn-success col-12" name="sifre_sifirla" type="submit"> Şifremi Sıfırla </button>
    </div>

</form>';
}elseif ($_GET["step"] == "2") {
    echo '<form id="submitForm" action="#" method="post">';

    if (isset($_GET["onay"]) && $_GET["onay"] == "yanlis") {
        echo '<div class="alert alert-danger">Onay kodu hatalı!</div>';
    }

    echo '<div class="form-group required">
            <label for="username"><b>Onay kodunuz:</b></label>
            <input type="text" class="form-control text-lowercase" id="username" maxlength="6" required="" name="gelen_onay_kodu" placeholder="Lütfen onay kodunuzu giriniz.">
        </div>

        <div class="form-group pt-1">
            <button class="btn btn-success col-12" name="unuttum_onay_kodu" type="submit"> Onayla </button>
        </div>
    </form>
    <p class="small-xl pt-3 text-center">
        <span class="text-dark"> Onay kodunuz telefon numaranıza en geç bir dakikada içinde gelecektir </span>
    </p>
';
}elseif ($_GET["step"] == "3") {
    echo '<form id="submitForm" action="#" method="post">';

    if (isset($_GET["onay"]) && $_GET["onay"] == "yanlis") {
        echo '<div class="alert alert-danger">Onay kodu hatalı!</div>';
    }

    echo '<div class="form-group required">
            <label for="username"><b>Yeni Şifreniz :</b></label>
            <input type="password" class="form-control" id="username" required="" name="yeni_sifre" placeholder="Lütfen onay kodunuzu giriniz.">
        </div>
        <div class="form-group required">
            <label for="username"><b>Yeni Şifrenizi Tekrar Giriniz :</b></label>
            <input type="password" class="form-control" id="username" required="" name="yeni_sifre_tekrar" placeholder="Lütfen onay kodunuzu giriniz.">
        </div>

        <div class="form-group pt-1">
            <button class="btn btn-success col-12" name="sifre_onay_degis" type="submit"> Şifremi Güncelle </button>
        </div>
    </form>
';
}
?>

                <p class="small-xl pt-3 text-center">
                    <span class="text-dark"> Hesabınız yok mu? </span>
                    <a href="kayit-ol.php?step=1" class="text-success"> Hesap oluştur. </a> <br>
                </p>

            </div>
        </div>
    </div>
    <br>
</div>
<?php include("hf-element/footer.php") ?>