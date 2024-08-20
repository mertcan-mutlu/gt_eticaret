<?php $oldugumsayfa = 'genelayarlar';?>
<?php include 'hf-element/header.php'; ?>

<div class="main-content">
    <h2>Genel Ayarlar</h2>

    <?php 
                    if (isset($_GET['guncelle']) && $_GET['guncelle'] == 'basarili') {
                        echo '<div class="alert alert-success"><strong>Güncelleme başarılı!</strong></div>';
                    }
                    ?>

    <div class="div">
        <form action="func/islem.php" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        Ürün Düzenle
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 15px;">
                </div>  
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Mail Adresiniz :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_mail" value="<?php echo $ayarcek['ayar_mail'];?>" aria-invalid="false">
                    </div> 
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">İnstagram Adresiniz (URL) :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_instagram" value="<?php echo $ayarcek['ayar_instagram_link'];?>" aria-invalid="false">
                    </div> 
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Facebook Adresiniz (URL) :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_facebook" value="<?php echo $ayarcek['ayar_facebook_link'];?>" aria-invalid="false">
                    </div> 
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Youtube Adresiniz (URL) :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_youtube" value="<?php echo $ayarcek['ayar_youtube_link'];?>" aria-invalid="false">
                    </div> 
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Adresiniz :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_adres" value="<?php echo $ayarcek['ayar_adres'];?>" aria-invalid="false">
                    </div></div>
                    <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Telefon Numaranız :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_telefon" value="<?php echo $ayarcek['ayar_telefon'];?>" aria-invalid="false">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Site Mesajı :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_sitemesaj" value="<?php echo $ayarcek['ayar_sitemesaj'];?>" aria-invalid="false">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Maps Konumu :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="ayar_konum" value="<?php echo $ayarcek['ayar_konum'];?>" aria-invalid="false">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label text-right">Hakkımızda Yazısı :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                    <textarea class="form-control autogrow" name="ayar_hakkimizda" placeholder="Hakkımızda yazısını yazınız." style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 48px; width: 521px;"><?php echo $ayarcek['ayar_hakkimizda']; ?></textarea>
                    </div>
                </div>
                <div class="form-group"><?php $bakim = $ayarcek['ayar_bakim'];?>
                    <label for="field-2" class="col-sm-3 control-label text-right">Bakım Modu :</label>
                    <div class="col-sm-5" style="margin-bottom: 15px;">
                    <select name="ayar_bakim" class="form-control">
										<option disabled>Lütfen bir seçim yapınız</option>
										<option value="1" <?php if ($bakim === 1) echo ' selected'; ?>>Bakımda</option>
                                        <option value="0" <?php if ($bakim === 0) echo ' selected'; ?>>Yayında</option>
									</select>
                    </div>
                </div>


                
                <div class="col-sm-offset-3 col-sm-5">
                <button type="submit" name="genel_ayar_guncelle" class="btn btn-success">Değişiklikleri kaydet</button>
                    <button type="reset" class="btn">Eski haline getir</button>
								</div> <br><br><br>
            </div>
        </form>
    </div>

<?php include 'hf-element/footer.php'; ?>