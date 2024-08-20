<?php include 'hf-element/header.php'; ?>

<div class="main-content">
    <h2>Kategori düzenleme işlemi</h2>

    <?php 
    if (isset($_GET['kid'])) {
        $kid = $_GET['kid'];
        $sql = "SELECT * FROM kategoriler WHERE kategori_id = :kategori_id";
        $gelenveri = $db->prepare($sql);
        $gelenveri->bindParam(':kategori_id', $kid);
        $gelenveri->execute();
        $kategori = $gelenveri->fetch(PDO::FETCH_ASSOC);
        
        if (!$kategori) {
            echo "Kategori bulunamadı.";
            die();
        }
    } else {
        echo "Kategori Düzenlemek için lütfen kategoriler sayfasına gidiniz";
        die();
    }
    ?>

    <div class="div">
        <form action="func/islem.php" method="post" enctype="multipart/form-data">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        Kategori Düzenle
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 15px;">
                    <label for="field-1" class="col-sm-3 control-label text-right">Şuanki Görsel:</label>
                    <div class="col-sm-9" style="margin-bottom: 10px;">
                        <img src="../<?php echo $kategori['kategori_resim']; ?>" width="200px" alt="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label text-right">Resim Seç:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                        <input type="file" name="yeni_resim" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Resim seç" />
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" name="kid" value="<?php echo $_GET['kid']; ?>">
                    <input type="hidden" name="eski_resim" value="<?php $esk= $kategori['kategori_resim']; echo "$esk";?>">
                    <label for="field-2" class="col-sm-3 control-label text-right">Kategori Adı:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="kategori_adi" value="<?php echo $kategori['kategori_adi']; ?>" aria-invalid="false">
                    </div>
                </div>

                <div class="form-group">
                    <label for="filed-3" class="col-sm-3 control-label text-right">Kategori Durumu:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                        <select class="form-control" name="kategori_durum">
                            <option disabled>Slider Görünürlüğü</option>
                            <option value="1" <?php echo ($kategori['kategori_durum'] == 1) ? 'selected' : ''; ?>>Görünür</option>
                            <option value="0" <?php echo ($kategori['kategori_durum'] == 0) ? 'selected' : ''; ?>>Gizli</option>
                        </select>
                    </div>
                </div>

                <div class="form-group default-padding">
                    <button type="submit" name="degisiklikaydet" class="btn btn-success">Değişiklikleri kaydet</button>
                    <button type="reset" class="btn">Eski haline getir</button>
                </div>
            </div>
        </form>
    </div>

<?php include 'hf-element/footer.php'; ?>
