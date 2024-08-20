<?php $oldugumsayfa = 'kategoriler';?>
<?php include 'hf-element/header.php'; ?>
<div class="main-content">
    <h2>Kategori İşlemleri</h2>
    <?php
    if (isset($_GET['ekle']) && $_GET['ekle'] == 'basarili') {
        echo '<div class="alert alert-success"><strong>Kategori Eklendi!</strong></div>';
    } elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'hata') {
        echo '<div class="alert alert-danger"><strong>Dosya yüklenirken bir hata oluştu.</strong></div>';
    }
    elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'secilemdi') {
        echo '<div class="alert alert-danger"><strong>Lütfen kategori durumunu seçiniz</strong></div>';
    }
    elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'kategori_bos') {
        echo '<div class="alert alert-danger"><strong>Lütfen kategori ismini giriniz</strong></div>';
    }
    elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'boyut') {
        echo '<div class="alert alert-danger"><strong>En fazla 10MB büyüklüğünde dosya seçebilirsiniz. </strong></div>';
    }
    elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'format') {
        echo '<div class="alert alert-danger"><strong>Sadece *jpg yada *jpeg uzantılı dosya seçebilirsiniz.</strong></div>';
    }
    ?>
    <br /><style>
                        .dtbale{
                            transform: scale(0.95);
                        }
                    </style>
    <div class="dtbale container">
        <div class="row">
            <div class="col">
                <div class="col-xs-12 text-right">
                    <a href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'});" class="btn btn-success">Kategori Ekle</a>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col">
                <div class="panel-body">
                    
                <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Kategori Resmi</th>
      <th>Kategoriler</th>
      <th>Kategori Durumu</th>
      <th>İşlemler</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($kategori_veri as $kategori): ?>
    <tr>
      <th ><img src="../<?php echo $kategori['kategori_resim']; ?>" width="75" alt=""></th>
      <td><?php echo $kategori['kategori_adi']; ?></td>
      <td><?php echo ($kategori['kategori_durum'] == 1) ? 'Aktif' : 'Pasif Kategori'; ?></td>
      <td><form id="formWithButtons" method="post">
    <input type="hidden" name="kategori_id" value="<?php $id=$kategori['kategori_id']; echo $id; ?>">
    <button type="button" class="btn btn-info tooltip-primary" name="edit" data-toggle="tooltip" data-placement="top" title="" onclick="submitForm('kategori_duzenle_uy.php?kid=<?php echo $id; ?>')" data-original-title="Düzenle"> <i class="entypo-pencil"></i></button>
    <button type="button" class="btn btn-danger tooltip-primary" name="kategori_sil" data-toggle="tooltip" data-placement="top" title="" onclick="submitForm('func/islem_sil.php?kid=<?php echo $id; ?>')" data-original-title="Sil"> <i class="entypo-trash"></i></button>
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
					<h4 class="modal-title">Kategori Ekle</h4>
				</div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="dosya" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Resim seç" />
                        </div>
                        <div class="form-group">
								<label class="control-label" for="full_name" >Kategori Adı</label>
								<input class="form-control" name="kategori_adi" id="full_name" data-validate="required" placeholder="Kategori adını giriniz">
							</div>
                        <div class="form-group">
                            <select class="form-control required" name="kategori_durum">
                                <option disabled selected>Kategori Durumu</option>
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="kategori_ekle" class="btn btn-success">Ekle</button>
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