<?php 
include 'blan.php';
////////////////////// Slider İşlemleri ////////////////////////////////////////////////////////////////////////////////////////
// Slider Verilerini Tabloya Çekme
$slider_tablo = $db->query("SELECT slider_resim, slider_durum, slider_id FROM slider");
$slider_veri = $slider_tablo->fetchAll(PDO::FETCH_ASSOC);

// Slider Ekleme Kodları
if (isset($_POST['slider_ekle'])) {
    $izin_verilen_formatlar = ['jpg', 'jpeg']; 
    $dosyaAdi = $_FILES['dosya']['name']; 
    $dosyaUzanti = strtolower(pathinfo($dosyaAdi, PATHINFO_EXTENSION)); 

    // Dosya uzantısını kontrol et
    if (!in_array($dosyaUzanti, $izin_verilen_formatlar)) {
        header("Location: ../slider-islemleri.php?ekle=format");
        die();
    }

    $izin_verilen_boyut = 10 * 1024 * 1024; 
    if ($_FILES['dosya']['size'] > $izin_verilen_boyut) {
        header("Location: ../slider-islemleri.php?ekle=boyut");
        die("Dosya boyutu çok büyük. Lütfen en fazla 10MB boyutunda bir dosya yükleyin.");
    }


    list($genislik, $yukseklik) = getimagesize($_FILES['dosya']['tmp_name']); 

    if ($genislik != 1140 || $yukseklik != 431) {
        header("Location: ../slider-islemleri.php?ekle=boy");
        die();
    }

    // Slider_durumu'nun değerini al
    $slider_durumu = isset($_POST['slider_durum']) ? $_POST['slider_durum'] : '';

    if ($slider_durumu !== '0' && $slider_durumu !== '1') {
        header("Location: ../slider-islemleri.php?ekle=secilmedi");
        die();
    }


    $dosyaYolu = '../../img/slider/' . $dosyaAdi;

    if (move_uploaded_file($_FILES['dosya']['tmp_name'], $dosyaYolu)) {
        echo "Dosya başarıyla yüklendi.";

        $dosyaYoluVeritabani = 'img/slider/' . $dosyaAdi; 
        $ekleme_sorgusu = $db->prepare("INSERT INTO slider (slider_resim, slider_durum) VALUES (?, ?)");
        $ekleme_sorgusu->execute([$dosyaYoluVeritabani, $slider_durumu]);

        header("Location: ../slider-islemleri.php?ekle=basarili");
    } else {
        header("Location: ../slider-islemleri.php?ekle=hata");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_slider'])) {
    $sliderID = $_POST['slider_id'];

    $sqlSelect = "SELECT slider_resim FROM slider WHERE slider_id = $sliderID";

    try {
        $stmt = $db->prepare($sqlSelect);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $resimYolu = "../../" . $row['slider_resim'];
            $sqlDelete = "DELETE FROM slider WHERE slider_id = $sliderID";
            $stmtDelete = $db->prepare($sqlDelete);
            $stmtDelete->execute();

            if (file_exists($resimYolu)) {
                if (unlink($resimYolu)) {
                    header("Location: ../slider-islemleri.php?sil=basarili");
                } else {
                    header("Location: ../slider-islemleri.php?sil=silinmedi");
                }
            } else {
                header("Location: ../slider-islemleri.php?sil=bulunmadı");
            }
        } else {
            echo "Slider bulunamadı.";
        }
    } catch(PDOException $e) {
        echo "Slider silinirken hata oluştu: " . $db->errorInfo()[2];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['toggle_visibility'])) {
    $sliderID = $_POST['slider_id'];
    $newSliderDurum = $_POST['slider_durum'];

    try {
        $sqlUpdate = "UPDATE slider SET slider_durum = :durum WHERE slider_id = :id";
        $stmt = $db->prepare($sqlUpdate);
        $stmt->bindParam(':durum', $newSliderDurum);
        $stmt->bindParam(':id', $sliderID);
        $stmt->execute();
        
        header("Location: ../slider-islemleri.php?guncelle=basarili");
        echo "Slider durumu güncellendi.";
    } catch(PDOException $e) {
        header("Location: ../slider-islemleri.php?guncelle=hata");
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Kategorileri tabloya çektiğim kodlar

$kategori_veri = $db->query("SELECT kategori_resim, kategori_durum, kategori_adi, kategori_id FROM kategoriler");
$kategori_veri = $kategori_veri->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['kategori_ekle'])) {
    $izin_verilen_formatlar = ['jpg', 'jpeg']; 
    $dosyaAdi = $_FILES['dosya']['name']; 
    $dosyaUzanti = strtolower(pathinfo($dosyaAdi, PATHINFO_EXTENSION));

    if (!in_array($dosyaUzanti, $izin_verilen_formatlar)) {
        header("Location: ../kategori_uy.php?ekle=format");
        die();
    }


    $izin_verilen_boyut = 10 * 1024 * 1024; 
    if ($_FILES['dosya']['size'] > $izin_verilen_boyut) {
        header("Location: ../kategori_uy.php?ekle=boyut");
        die("Dosya boyutu çok büyük. Lütfen en fazla 10MB boyutunda bir dosya yükleyin.");
    }
    $kategori_durumu = isset($_POST['kategori_durum']) ? $_POST['kategori_durum'] : '';
    $kategori_adi = isset($_POST['kategori_adi']) ? $_POST['kategori_adi'] : '';

if (isset($_GET['kid'])) {
    $urun_id = $_GET['kid'];

    $sql = "SELECT urun_resim FROM urunler WHERE urun_id = :urun_id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':urun_id', $urun_id);
    $stmt->execute();
    $urun = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($urun && file_exists('../../' . $urun['urun_resim'])) {
        if (unlink('../../' . $urun['urun_resim'])) {
            echo "Ürün resmi başarıyla silindi.";
        } else {
            echo "Ürün resmi silinemedi.";
        }
    } else {
        echo "Ürün resmi bulunamadı veya silinmeye hazır değil.";
    }

    $sil_sql = "DELETE FROM urunler WHERE urun_id = :urun_id";
    $sil_stmt = $db->prepare($sil_sql);
    $sil_stmt->bindParam(':urun_id', $urun_id);

    if ($sil_stmt->execute()) {
        echo "Ürün başarıyla silindi.";
    } else {
        echo "Ürün silinirken bir hata oluştu.";
    }
}

    if (empty($kategori_adi)) {
        header("Location: ../kategori_uy.php?ekle=kategori_bos");
        die("Lütfen bir kategori adı girin.");
    }
    if ($kategori_durumu !== '0' && $kategori_durumu !== '1') {
        header("Location: ../kategori_uy.php?ekle=secilmedi");
        die();
    }

    $dosyaYolu = '../../img/categories/' . $dosyaAdi;

    if (move_uploaded_file($_FILES['dosya']['tmp_name'], $dosyaYolu)) {

        $dosyaYoluVeritabani = 'img/categories/' . $dosyaAdi; 
        $ekleme_sorgusu = $db->prepare("INSERT INTO kategoriler (kategori_resim, kategori_durum, kategori_adi) VALUES (?, ?, ?)");
        $ekleme_sorgusu->execute([$dosyaYoluVeritabani, $kategori_durumu, $kategori_adi]);

        header("Location: ../kategori_uy.php?ekle=basarili");
    } else {
        header("Location: ../kategori_uy.php?ekle=hata");
    }
}



if (isset($_POST['degisiklikaydet'])) {
    $kategori_adi = $_POST['kategori_adi'];
    $kategori_durum = $_POST['kategori_durum'];
    $eski_resim = $_POST['eski_resim'];
    $yeni_resim = $_FILES['yeni_resim']['name']; 

    $kategori_id = $_POST['kid'];

    if (!empty($yeni_resim)) {
        $dosyaYolu = '../../img/categories/' . $yeni_resim;
        if (move_uploaded_file($_FILES['yeni_resim']['tmp_name'], $dosyaYolu)) {
            unlink('../../' . $eski_resim);
            $sql = "UPDATE kategoriler SET kategori_adi = :kategori_adi, kategori_durum = :kategori_durum, kategori_resim = :kategori_resim WHERE kategori_id = :kategori_id";
        }
    } else {
        $sql = "UPDATE kategoriler SET kategori_adi = :kategori_adi, kategori_durum = :kategori_durum WHERE kategori_id = :kategori_id";
    }

    $update = $db->prepare($sql);
    $update->bindParam(':kategori_adi', $kategori_adi);
    $update->bindParam(':kategori_durum', $kategori_durum);
    $update->bindParam(':kategori_id', $kategori_id);

    if (!empty($yeni_resim)) {
        $kayıtsekli = 'img/categories/' . $yeni_resim;
        $update->bindParam(':kategori_resim', $kayıtsekli);
    }

    $update->execute();
    echo "güncellendi";
    exit();
}

    /////////////////////////////////////////////////////////////////////////////////////
    // Ürünler sayfası


if (isset($_POST['urun_ekle'])) {
    $urun_adi = $_POST['urun_adi'];
    $urun_kategori = $_POST['kategori_id'];
    $urun_fiyat = $_POST['urun_fiyat'];
    $urun_durum = $_POST['urun_durum'];
    $stok_sayisi = $_POST['stok_sayisi'];
    $urun_aciklama = $_POST['urun_aciklama'];

    $dosyaAdi = $_FILES['urun_resim']['name'];
    $dosyaYolu = '../../img/product/'.$dosyaAdi;
    
    if (move_uploaded_file($_FILES['urun_resim']['tmp_name'], $dosyaYolu)) {
        $dosyaYoluVeritabani = 'img/product/'.$dosyaAdi;
        $ekleme_sorgusu = $db->prepare("INSERT INTO urunler (urun_resim, urun_adi, kategori_id, urun_fiyat, urun_durum, urun_stok, urun_aciklama) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $ekleme_sorgusu->execute([$dosyaYoluVeritabani, $urun_adi, $urun_kategori, $urun_fiyat, $urun_durum, $stok_sayisi, $urun_aciklama]);

        echo "Ürün başarıyla eklendi.";
    } else {
        echo "Dosya yüklenirken bir hata oluştu.";
    }
}


    $query = "SELECT kategori_adi, kategori_id FROM kategoriler WHERE kategori_durum = 1";
    $result = $db->query($query);
    
    if ($result) {
        $options = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($options as $option) {
        }
    }

    $urun_tablo = "SELECT u.* , k.kategori_adi  FROM urunler u INNER JOIN kategoriler k ON u.kategori_id = k.kategori_id"; 
        $uruncek = $db->query($urun_tablo);
  
        if (isset($_POST['urun_duzenle'])) {
        echo"burdasın urun duzuenle";
        
        
        }

        // Ürün güncelleme işlemi


if (isset($_POST['urun_guncelle'])) {
    $urun_id = $_POST['kid'];
    $urun_adi = $_POST['urun_adi'];
    $urun_kategori = $_POST['urun_kategori'];
    $urun_durum = $_POST['urun_durum'];
    $urun_stok = $_POST['urun_stok'];
    $urun_aciklama = nl2br($_POST['urun_aciklama']);
    $urun_fiyat = $_POST['urun_fiyat'];
    $esk = $_POST['eski_resim'];

    if ($_FILES['yeni_resim']['name'] != '') {
        $yeni_resim = $_FILES['yeni_resim']['name'];
        $hedef_klasor = "../../img/product/";
        $hedef_yol = "img/product/".$yeni_resim;
        $esk = $_POST['eski_resim'];

        $eski_resim_yolu = $esk; 
        if (file_exists('../../'.$eski_resim_yolu)) {
            unlink('../../'.$eski_resim_yolu);
        }

        move_uploaded_file($_FILES['yeni_resim']['tmp_name'], '../../'.$hedef_yol);

        $sql = "UPDATE urunler SET urun_adi = :urun_adi, kategori_id = :kategori_id, urun_durum = :urun_durum, urun_aciklama = :urun_aciklama, urun_fiyat = :urun_fiyat, urun_stok = :urun_stok,  urun_resim = :urun_resim WHERE urun_id = :urun_id";
        $update = $db->prepare($sql);
        $update->bindParam(':urun_adi', $urun_adi);
        $update->bindParam(':kategori_id', $urun_kategori);
        $update->bindParam(':urun_durum', $urun_durum);
        $update->bindParam(':urun_aciklama', $urun_aciklama);
        $update->bindParam(':urun_fiyat', $urun_fiyat);
        $update->bindParam(':urun_stok', $urun_stok);
        $update->bindParam(':urun_resim', $hedef_yol);
        $update->bindParam(':urun_id', $urun_id);

        if ($update->execute()) {
            echo "Ürün güncellendi!";
        } else {
            echo "Ürün güncellenirken bir hata oluştu.";
        }
    } else {
        $sql = "UPDATE urunler SET urun_adi = :urun_adi, kategori_id = :kategori_id, urun_durum = :urun_durum, urun_aciklama = :urun_aciklama, urun_stok = :urun_stok, urun_fiyat = :urun_fiyat WHERE urun_id = :urun_id";
        $update = $db->prepare($sql);
        $update->bindParam(':urun_adi', $urun_adi);
        $update->bindParam(':kategori_id', $urun_kategori);
        $update->bindParam(':urun_durum', $urun_durum);
        $update->bindParam(':urun_aciklama', $urun_aciklama);
        $update->bindParam(':urun_fiyat', $urun_fiyat);
        $update->bindParam(':urun_stok', $urun_stok);
        $update->bindParam(':urun_id', $urun_id);

        if ($update->execute()) {
            echo "Ürün güncellendi!";
        } else {
            echo "Ürün güncellenirken bir hata oluştu.";
        }
    }
}

// Ayar çekme işlemi
$ayar_cek = $db->query("SELECT * FROM ayar");
$ayarcek = $ayar_cek->fetch(PDO::FETCH_ASSOC);

//Genel Ayar Güncelleme İşlemi
if(isset($_POST['genel_ayar_guncelle'])) {
    $ayar_mail = $_POST['ayar_mail'];
    $ayar_adres = $_POST['ayar_adres'];
    $ayar_telefon = $_POST['ayar_telefon'];
    $ayar_instagram = $_POST['ayar_instagram'];
    $ayar_facebook = $_POST['ayar_facebook'];
    $ayar_youtube = $_POST['ayar_youtube'];
    $ayar_sitemesaj = $_POST['ayar_sitemesaj'];
    $ayar_konum = $_POST['ayar_konum'];
    $ayar_hakkimizda = $_POST['ayar_hakkimizda'];
    $ayar_bakim = $_POST['ayar_bakim'];

    $sql = "UPDATE ayar SET ayar_mail = :mail, ayar_adres = :adres, ayar_telefon = :telefon, 
            ayar_instagram_link = :instagram, ayar_facebook_link = :facebook, ayar_youtube_link = :youtube, 
            ayar_sitemesaj = :sitemesaj, ayar_konum = :konum, ayar_hakkimizda = :hakkimizda, ayar_bakim = :bakim WHERE ayar_id = 1";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':mail', $ayar_mail);
    $stmt->bindParam(':adres', $ayar_adres);
    $stmt->bindParam(':telefon', $ayar_telefon);
    $stmt->bindParam(':instagram', $ayar_instagram);
    $stmt->bindParam(':facebook', $ayar_facebook);
    $stmt->bindParam(':youtube', $ayar_youtube);
    $stmt->bindParam(':sitemesaj', $ayar_sitemesaj);
    $stmt->bindParam(':konum', $ayar_konum);
    $stmt->bindParam(':hakkimizda', $ayar_hakkimizda);
    $stmt->bindParam(':bakim', $ayar_bakim, PDO::PARAM_BOOL);

    $stmt->execute();

    header('Location: ../ayarlar.php?guncelle=basarili');
}

$mesaj_sorgu = "SELECT * FROM mesaj";
$calis_mesajsorgu = $db->prepare($mesaj_sorgu);
$calis_mesajsorgu->execute();

$mesajlar = $calis_mesajsorgu->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['admin_cikis'])) {
    session_destroy();    header("Location: ../login.php");
    exit(); 
}

?>
