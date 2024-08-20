<?php $oldugumsayfa = 'urunler';?>
<?php include 'hf-element/header.php'; ?>
<div class="main-content">
    <h2>Ürün İşlemleri</h2>

    <br /><style>
                        .dtbale{
                            transform: scale(0.95);
                        }
                    </style>
    <div class="dtbale container">
        <div class="row">
            <div class="col">
                <div class="col-xs-12 text-right">
                    <a href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'});" class="btn btn-success">Ürün Ekle</a>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col">
            <div class="panel-body">
                    
            <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Ürün Resmi</th>
            <th>Ürün Adı</th>
            <th>Ürün Kategorisi</th>
            <th>Ürün Fiyatı</th>
            <th>Ürün Stok</th>
            <th>Ürün Durumu</th>
            <th>İşlemler Durumu</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($uruncek as $urun): ?>
    <tr>
        <td><img src="../<?php echo $urun['urun_resim']; ?>" width="75" alt=""></td>
        <td><?php echo $urun['urun_adi']; ?></td>
        <td><?php echo $urun['kategori_adi']; ?></td>
        <td><?php echo $urun['urun_fiyat']; ?></td>
        <td><?php echo $urun['urun_stok']; ?></td>
        <td>
            <?php echo ($urun['urun_durum'] == 1) ? 'Görünür' : 'Gizli'; ?>
        </td>
        <td>
            <form id="formWithButtons" method="post">
                <input type="hidden" name="kategori_id" value="<?php echo $urun['urun_id']; ?>">
                <button type="button" class="btn btn-info tooltip-primary" name="edit" data-toggle="tooltip" data-placement="top" title="" onclick="submitForm('urun_duzenle_uy.php?urunid=<?php echo $urun['urun_id']; ?>')" data-original-title="Düzenle">
                    <i class="entypo-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger tooltip-primary" name="kategori_sil" data-toggle="tooltip" data-placement="top" title="" onclick="submitForm('func/urun_sil.php?kid=<?php echo $urun['urun_id']; ?>')" data-original-title="Sil">
                    <i class="entypo-trash"></i>
                </button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>

    </tbody>
</table> 
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-6">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="func/islem.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Ürün ekleme işlemi</h4>
				</div>
                    <div class="modal-body">
                    <div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="field-3" class="control-label">Ürün Resmi</label> <br>
								<input type="file" name="urun_resim" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Resim seç" style="left: 45px; top: -9.5px;">
							</div>	
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							
							<div class="form-group">
								<label for="field-1" class="control-label">Ürün Adı</label>
								
								<input type="text" name="urun_adi"; class="form-control" id="field-1" placeholder="Ürün adı giriniz">
							</div>	
							
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<label for="field-2" class="control-label">Ürün Kategorisi</label>
								
								<select class="form-control" name="kategori_id";>
										<option selected disable>Ürün Kategorisi</option>
										<?php 
  foreach ($options as $option) {
  ?>
    <option value="<?php echo $option['kategori_id']; ?>"><?php echo $option['kategori_adi']; ?> </option>
    <?php 
    }
   ?>
									</select>
							</div>	
						
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="field-4" class="control-label">Ürün Fiyatı</label>
								
								<input name="urun_fiyat"; type="number" step="0.05" min="0" class="form-control" id="field-4" placeholder="Ürün fiyatı giriniz">
							</div>	
							
						</div>
						
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="field-5" class="control-label">Ürün Durumu</label>
								
								<select class="form-control" name="urun_durum";>
										<option selected disable>Ürün durumu seçiniz</option>
										<option value="1">Görünür</option>
										<option value="0">Gizli</option>
									</select>
							</div>	
						
						</div>
						
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="field-6" class="control-label">Stok Bilgisi
                                </label>
								
								<input type="number" name="stok_sayisi"; class="form-control" id="field-6" placeholder="Stok sayısını giriniz">
							</div>	
						
						</div>
                        <div class="col-md-12">
							<style>
                                .animated {
    			-webkit-transition: height 0.2s;
				-moz-transition: height 0.2s;
				transition: height 0.2s;
			}
                            </style>
							<div class="form-group">
								<label for="field-3" class="control-label">Ürün Açıklaması</label> <br>
								<textarea name="urun_aciklama" class="form-control animated autogrow" naid="field-ta" cols="250" placeholder="Ürün açıklaması yazın" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 48px;"></textarea>
							</div>	
							
						</div>
					</div>
					
				</div>
                    
                    <div class="modal-footer">
                        <!-- Butonlar -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="urun_ekle" class="btn btn-success">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function submitForm(action) {
    var form = document.getElementById('formWithButtons');
    form.action = action;
    form.submit();
}
</script>



<?php include 'hf-element/footer.php'; ?>