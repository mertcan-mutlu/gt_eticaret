<?php $oldugumsayfa = 'slider';?>
<?php include 'hf-element/header.php'; ?>
<div class="main-content">
    <h2>Slider İşlemleri</h2>
    <?php
    if (isset($_GET['ekle']) && $_GET['ekle'] == 'basarili') {
        echo '<div class="alert alert-success"><strong>Resim başarıyla yüklendi ve veritabanına eklendi!</strong></div>';
    } elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'hata') {
        echo '<div class="alert alert-danger"><strong>Dosya yüklenirken bir hata oluştu.</strong></div>';
    } elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'secilmedi') {
        echo '<div class="alert alert-danger">Lütfen bir slider görünürlüğü seçin.</div>';
    } elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'boy') {
        echo '<div class="alert alert-danger">Resmin boyutları 1140x431 ve 300dpi olmalıdır. Lütfen uygun boyutta bir resim yükleyin.</div>';
    } elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'boyut') {
        echo '<div class="alert alert-danger">Dosya boyutu çok büyük. Lütfen en fazla 10MB boyutunda bir dosya yükleyin.</div>';
    } elseif (isset($_GET['ekle']) && $_GET['ekle'] == 'format') {
        echo '<div class="alert alert-danger">Yalnızca JPG ve JPEG formatında dosyalar yükleyebilirsiniz.</div>';
    } elseif (isset($_GET['guncelle']) && $_GET['guncelle'] == 'basarili') {
        echo '<div class="alert alert-success">Slider durumu güncellendi.</div>';
    } elseif (isset($_GET['guncelle']) && $_GET['guncelle'] == 'hata') {
        echo '<div class="alert alert-danger">Slider durumu güncellenirken hata oluştu.</div>';
    } elseif (isset($_GET['sil']) && $_GET['sil'] == 'basarili') {
        echo '<div class="alert alert-success">Slider başarı ile silindi.</div>';
    } elseif (isset($_GET['sil']) && $_GET['sil'] == 'bulunmadı') {
        echo '<div class="alert alert-success">Resim dosyası bulunamadı tablodan silindi</div>';
    } elseif (isset($_GET['sil']) && $_GET['sil'] == 'silinmedi') {
        echo '<div class="alert alert-danger">Resim silinmedi</div>';
    }
    ?>
    <br /><style>
                        .dtbale{
                            transform: scale(0.97);
                        }
                    </style>
    <div class="dtbale container">
        <div class="row">
            <div class="col">
                <div class="col-xs-12 text-right">
                    <a href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'});" class="btn btn-success">Slider Ekle</a>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col">
                <div class="panel-body">
                    
                    <table class="table table-bordered table-striped datatable" id="table-2">
                        <thead>
                            <tr>
                                <th>Slider Resmi</th>
                                <th>Slider Durumu</th>
                                <th>Actions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($slider_veri as $slider): ?>
                                <tr>
                                    <td><img src="../<?php echo $slider['slider_resim']; ?>" width="75" alt=""></td>
                                    <td>
                                        <?php echo ($slider['slider_durum'] == 1) ? 'Görünür' : 'Gizli'; ?>
                                    </td>
                                    <td>
                                        <?php $newDurum = ($slider['slider_durum'] == 1) ? 0 : 1; ?>
                                        <form method="post" action="func/islem.php">
                                            <input type="hidden" name="slider_id" value="<?php echo $slider['slider_id']; ?>">
                                            <input type="hidden" name="slider_durum" value="<?php echo $newDurum; ?>">
                                            <button type="submit" class="btn btn-default btn-sm btn-icon icon-left" name="toggle_visibility">
                                                <i class="entypo-eye"></i><?php echo ($slider['slider_durum'] == 1) ? 'Gizle' : 'Görünür Yap'; ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="func/islem.php">
                                            <input type="hidden" name="slider_id" value="<?php echo $slider['slider_id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm btn-icon icon-left" name="delete_slider">
                                                <i class="entypo-trash"></i>
                                                Sil
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
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="dosya" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Resim seç" />
                        </div>
                        <div class="form-group">
                            <select class="form-control required" name="slider_durum">
                                <option disabled selected>Slider Görünürlüğü</option>
                                <option value="1">Görünür</option>
                                <option value="0">Gizli</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="slider_ekle" class="btn btn-success">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php include 'hf-element/footer.php'; ?>