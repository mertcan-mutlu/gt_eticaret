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
    <?php
if (isset($_SESSION['uye_id'])) {
    echo "<script>window.location.href='hesap.php'</script>";
} else {
}
?>
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card card-body bs-example">
                <form id="submitForm" action="hf-element/islem.php" method="post" data-parsley-validate=""
                    data-parsley-errors-messages-disabled="true" novalidate="" _lpchecked="1">
                    <input type="hidden" name="_csrf" value="7635eb83-1f95-4b32-8788-abec2724a9a4">
                    <div class="form-group required">
                        <label for="username"><b>E-posta:</b></label>
                        <input type="text" class="form-control text-lowercase" id="" required="" name="kadi"
                            value="" placeholder="Lütfen e-posta adresinizi giriniz.">
                    </div>
                    <div class="form-group required">
                        <label class="d-flex flex-row align-items-center" for="ksif"><b>Şifre:</b></label>
                        <input type="password" class="form-control" required=""  placeholder="Lütfen şifrenizi giriniz"
                            id="password" name="ksif" value=""><br></button><span class="text-dark mt-5"> Şifrenizi
                            mi unuttunuz? </span>
                        <a href="sifremi-unuttum.php" class="text-success"> Şifremi Sıfırla. </a>
                    </div>
                    <div class="form-group pt-1">
                        <button class="btn btn-success col-12" name="giris_yap" type="submit"> Giriş Yap </button>
                    </div>

                </form>
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