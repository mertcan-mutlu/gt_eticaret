<?php include 'hf-element/header.php'; ?>

<div class="main-content">
    <h2>Ürün düzenleme işlemi</h2>

    <?php 
try {
    $sql = "SELECT kategori_id, kategori_adi FROM kategoriler";
    $statement = $db->prepare($sql);
    $statement->execute();
    $kategoriler = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Veritabanından kategorileri çekerken hata oluştu: " . $e->getMessage();
}

if (isset($_GET['urunid'])) {
    $urun_id = $_GET['urunid'];
    $sql = "SELECT * FROM urunler WHERE urun_id = :urun_id";
    $gelenveri = $db->prepare($sql);
    $gelenveri->bindParam(':urun_id', $urun_id);
    $gelenveri->execute();
    $urun = $gelenveri->fetch(PDO::FETCH_ASSOC);
    
    if (!$urun) {
        echo "Ürün bulunamadı.";
        die();
    }
}   
    ?>

    <div class="div">
        <form action="func/islem.php" method="post" enctype="multipart/form-data">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        Ürün Düzenle
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 15px;">
                    <label for="field-1" class="col-sm-3 control-label text-right">Şuanki Görsel:</label>
                    <div class="col-sm-9" style="margin-bottom: 10px;">
                    <input type="hidden" name="eski_resim" value="<?php echo $urun['urun_resim']; ?>">
                        <img src="../<?php echo $urun['urun_resim']; ?>" width="200px" alt="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label text-right">Resim Seç:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                        <input type="file" name="yeni_resim" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Resim seç" />
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" name="kid" value="<?php echo $_GET['urunid']; ?>">
                    
                    <label for="field-2" class="col-sm-3 control-label text-right">Ürün Adı:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="urun_adi" value="<?php echo $urun['urun_adi']; ?>" aria-invalid="false">
                    </div>
                    
                </div>
                <div class="form-group">
                    <input type="hidden" name="kid" value="<?php echo $_GET['urunid']; ?>">
                    
                    <label for="field-2" class="col-sm-3 control-label text-right">Ürün Fiyat:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                    <input name="urun_fiyat" type="number" step="0.05" min="0" class="form-control" id="field-4" value="<?php echo $urun['urun_fiyat']; ?>" placeholder="Ürün fiyatı giriniz">
                    </div>
                    
                </div>
                <div class="form-group">
                    <input type="hidden" name="kid" value="<?php echo $_GET['urunid']; ?>">
                    
                    <label for="field-2" class="col-sm-3 control-label text-right">Ürün Stok:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                    <input type="number" name="urun_stok" value="<?php echo $urun['urun_stok']; ?>" class="form-control" id="field-6" placeholder="Stok sayısını giriniz">
                    </div>
                    
                </div>
                <div class="form-group">
                    <input type="hidden" name="kid" value="<?php echo $_GET['urunid']; ?>">
                    
                    <label for="field-2" class="col-sm-3 control-label text-right">Ürün Açıklama:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                    <textarea name="urun_aciklama" class="form-control animated autogrow" naid="field-ta" cols="250" placeholder="Ürün açıklaması yazın" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 48px;"><?php echo $urun['urun_aciklama']; ?></textarea>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="filed-3" class="col-sm-3 control-label text-right">Ürün Kategorisi:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                    <select class="form-control" name="urun_kategori">
    <option disabled>Ürün Kategorisi Seçin</option>
    <?php foreach ($kategoriler as $kategori) : ?>
        <option value="<?php echo $kategori['kategori_id']; ?>" <?php echo ($urun['kategori_id'] == $kategori['kategori_id']) ? 'selected' : ''; ?>>
            <?php echo $kategori['kategori_adi']; ?>
        </option>
    <?php endforeach; ?>
</select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="filed-3" class="col-sm-3 control-label text-right">Ürün Durumu:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">
                        <select class="form-control" name="urun_durum">
                            <option disabled>ürün görünürlüğü</option>
                            <option value="1" <?php echo ($urun['urun_durum'] == 1) ? 'selected' : ''; ?>>Görünür</option>
                            <option value="0" <?php echo ($urun['urun_durum'] == 0) ? 'selected' : ''; ?>>Gizli</option>
                        </select>
                    </div>
                </div>

                <div class="form-group default-padding">
                    <button type="submit" name="urun_guncelle" class="btn btn-success">Değişiklikleri kaydet</button>
                    <button type="reset" class="btn">Eski haline getir</button>
                </div>
            </div>
        </form>
    </div>

<?php include 'hf-element/footer.php'; ?>