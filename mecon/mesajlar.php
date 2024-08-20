<?php $oldugumsayfa = 'mesajlar';?>
<?php include 'hf-element/header.php'; ?>

<div class="main-content">
    <h2>Mesajlar</h2>
    <div class="mail-body">

        <div class="mail-header">

            <!-- mail table -->
            <table class="table mail-table">
                <!-- mail table header -->

                <style>
                td {
                    color: black;
                }
                </style>
                <!-- email list -->
                <tbody>
                    <tr class="">
                        <td class="col-name"><span style="font-size: 15px;"><b>Konu</b></span></td>
                        <td class="col-subject"><span style="font-size: 15px;"><b>Gönderen</b></span></td>
                        <td class="col-time"><span style="font-size: 15px;"><b>Tarih</b></span></td>
                        <td class="col-see"><span style="font-size: 15px;"><b>İşlem</b></span></td>
                    </tr>

                    <?php $ters_mesajlar = array_reverse($mesajlar);
                    foreach ($ters_mesajlar as $mesaj) : ?>
                    <tr class="">
                        <td class="col-name">
                            <?php
                                $mesaj_konu = $mesaj['mesaj_konu'];
                                $etiket = '';
                                $sinif = '';
                                switch ($mesaj_konu) {
                                    case 1:
                                        $etiket = 'Şikayet';
                                        $sinif = 'danger';
                                        break;
                                    case 2:
                                        $etiket = 'Öneri';
                                        $sinif = 'warning';
                                        break;
                                    case 3:
                                        $etiket = 'Soru veya İstek';
                                        $sinif = 'info';
                                        break;
                                    case 4:
                                        $etiket = 'Teşekkür';
                                        $sinif = 'success';
                                        break;
                                    default:
                                        $etiket = 'Konu Seçmemiş';
                                        $sinif = 'default';
                                        break;
                                }
                                ?>
                            <span class="label label-<?php echo $sinif; ?>"><?php echo $etiket; ?></span>
                        </td>
                        <td class="col-subject"><?php echo $mesaj['mesaj_kadi'] . ' ' . $mesaj['mesaj_sadi']; ?></td>
                        <td class="col-time"><?php $veritabani_tarihi = $mesaj['mesaj_tarih'];
                                                    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $veritabani_tarihi);
                                                    $yeni_format = $datetime->format('d/m/Y H:i');
                                                    echo $yeni_format;
                                                    ?>
                        </td>
                        <td class="col-see"><a href="javascript:;" onclick="jQuery('#modal-<?php echo $mesaj['mesaj_id'];?>').modal('show');"
                                class="btn btn-default">Detaylar</a></td>
                    </tr>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>

        <?php foreach ($ters_mesajlar as $mesaj) : ?>
        <div class="modal fade" id="modal-<?php echo $mesaj['mesaj_id'];?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Mesaj Detayları</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Adı ve Soyadı :</label>
                                        <span id="field-1"><?php echo $mesaj['mesaj_kadi'] . ' ' . $mesaj['mesaj_sadi']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Tarih :</label>
                                        <span id="field-1"><?php echo $mesaj['mesaj_tarih'];?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Mail Adresi :</label>
                                        <span id="field-2"><?php echo $mesaj['mesaj_mail']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group"><?php
                                $mesaj_konu = $mesaj['mesaj_konu'];
                                $etiket = '';
                                $sinif = '';
                                switch ($mesaj_konu) {
                                    case 1:
                                        $etiket = 'Şikayet';
                                        break;
                                    case 2:
                                        $etiket = 'Öneri';
                                        break;
                                    case 3:
                                        $etiket = 'Soru veya İstek';
                                        break;
                                    case 4:
                                        $etiket = 'Teşekkür';
                                        break;
                                    default:
                                        $etiket = 'Konu Seçmemiş';
                                        break;
                                }
                                ?>
                                        <label for="field-2" class="control-label">Konu :</label>
                                        <span id="field-2"><?php echo $etiket ;?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Mesajı :</label><br>
                                        <span id="field-3"><?php echo $mesaj['mesaj_icerik']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>


        <?php include 'hf-element/footer.php'; ?>