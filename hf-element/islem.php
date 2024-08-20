<?php

    include'blan.php';
    include'vatansms.php';

// Aktif slider sayısını alma işlemi
$aktif_slider_sorgu = $db->query("SELECT COUNT(*) AS aktif_slider_sayisi FROM slider WHERE slider_durum = 1");
$aktif_slider_sayisi = $aktif_slider_sorgu->fetchColumn();

// Slider verilerini çekme işlemi
$slider_resim_sorgu = $db->query("SELECT * FROM slider WHERE slider_durum = 1");
$slider = $slider_resim_sorgu->fetchAll(PDO::FETCH_ASSOC);

// Kategori verilerini çekme işlem
$kategori_cek = $db->query("SELECT kategori_resim, kategori_durum, kategori_adi FROM kategoriler");
$kategori_veri = $kategori_cek->fetchAll(PDO::FETCH_ASSOC);

//ayar tablosunda gelen verileri çekme işlemi
$ayar_cek = $db->query("SELECT * FROM ayar");
$ayarcek = $ayar_cek->fetch(PDO::FETCH_ASSOC);

//iletisim formundan gelen verileri veritabanına kayıt etme işlemi
    if(isset($_POST['iletisim_kaydet'])) {
    $mesaj_kadi = $_POST['mesaj_kadi'];
    $mesaj_sadi = $_POST['mesaj_sadi'];
    $mesaj_mail = $_POST['mesaj_mail'];
    $mesaj_konu = $_POST['mesaj_konu'];
    $mesaj_icerik = $_POST['mesaj_icerik'];

    date_default_timezone_set('Europe/Istanbul');
    $tarih_ve_saat = date('Y-m-d H:i:s');

    try {
        $sql = "INSERT INTO Mesaj (mesaj_kadi, mesaj_sadi, mesaj_mail, mesaj_konu, mesaj_icerik, mesaj_tarih) VALUES (?, ?, ?, ?, ?, ?)";
        $calis = $db->prepare($sql);
        $calis->execute([$mesaj_kadi, $mesaj_sadi, $mesaj_mail, $mesaj_konu, $mesaj_icerik, $tarih_ve_saat]);

        header('Location: ../iletisim.php?gonder=basarili');
    } catch(PDOException $e) {
        header('Location: iletisim.php?gonder=basarisiz');
    }
}
    

//Üye kayıt olma işlemi
if (isset($_POST['uye_kaydet'])) {
    try {
        $uye_ad = trim($_POST['uye_ad']);
        $uye_soyad = trim($_POST['uye_soyad']);
        $uye_mail = trim($_POST['uye_mail']);
        $uye_tel = trim($_POST['uye_tel']);
        $pas_sif = md5(trim($_POST['pas_sif']));
        $onay_kodu = substr(str_shuffle("1234567890"), 0,6);
        date_default_timezone_set('Europe/Istanbul');
        $tarih_ve_saat = date('Y-m-d H:i:s');

        $kontrolSQL = "SELECT COUNT(*) as sayi FROM uyeler WHERE uye_mail = :uye_mail OR uye_tel = :uye_tel";
        $kontrolCalistir = $db->prepare($kontrolSQL);
        $kontrolCalistir->bindParam(':uye_mail', $uye_mail);
        $kontrolCalistir->bindParam(':uye_tel', $uye_tel);
        $kontrolCalistir->execute();
        $kontrolSonuc = $kontrolCalistir->fetch(PDO::FETCH_ASSOC);

        if ($kontrolSonuc['sayi'] > 0) {
            header('Location: ../kayit-ol.php?kayit=var');
            exit();
        }

        $uyeEkleSQL = "INSERT INTO uyeler (uye_ad, uye_soyad, uye_mail, uye_tel, uye_kayittarihi, uye_onaykodu) VALUES (:uye_ad, :uye_soyad, :uye_mail, :uye_tel, :uye_tarih, :onay_kodu)";
        $uyeEklecalistir = $db->prepare($uyeEkleSQL);

        $uyeEklecalistir->bindParam(':uye_ad', $uye_ad);
        $uyeEklecalistir->bindParam(':uye_soyad', $uye_soyad);
        $uyeEklecalistir->bindParam(':uye_mail', $uye_mail);
        $uyeEklecalistir->bindParam(':uye_tel', $uye_tel);
        $uyeEklecalistir->bindParam(':uye_tarih', $tarih_ve_saat);
        $uyeEklecalistir->bindParam(':onay_kodu', $onay_kodu);
        $uyeEklecalistir->execute();
        $uye_id = $db->lastInsertId();

        $sifreEkleSQL = "INSERT INTO pass (uye_id, pas_sif) VALUES (:uye_id, :sifre)";
        $sifreEkle = $db->prepare($sifreEkleSQL);

        $sifreEkle->bindParam(':uye_id', $uye_id);
        $sifreEkle->bindParam(':sifre', $pas_sif);
        $sifreEkle->execute();

        if($sifreEkle){
            $api = new VatanSMSAPI(["$uye_tel"], $onay_kodu.' '.'onay kodu ile gelecek toprakta üyeliğinizi doğrulayabilirsiniz.');
            $response = $api->sendSMS();
            if($response==='1'){
                header("Location: ../kayit-ol.php?step=2&phone=$uye_tel");
            }
        } else {
            header('Location: /kayit-ol.php?gonderme=basarisiz');
        }

    } catch (PDOException $e) {
        header('Location: /kayit-ol.php?kayit=basarisiz');
    } 
}


// Onay kodunu onaylama işlemi
if (isset($_POST['onay_kodu'])) {
    $dogrula_onay = $_POST['gelen_onay_kodu'];
    $tel = trim($_GET['phone']);
    echo $tel;

    try {
        $sorgu = $db->prepare("SELECT * FROM uyeler WHERE uye_tel = :tel AND uye_onaykodu = :dogrula_onay");
        $sorgu->bindParam(':tel', $tel);
        $sorgu->bindParam(':dogrula_onay', $dogrula_onay);
        $sorgu->execute();

        $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($kullanici) {
            $guncelle = $db->exec("UPDATE uyeler SET uye_onaydurumu = '1' WHERE uye_tel = '$tel' AND uye_onaykodu = $dogrula_onay");    

            if ($guncelle) {
                header('Location: kayit-ol.php?step=3');
                exit();
            }
        } else {
            header('Location: kayit-ol.php?step=2&phone=' . $tel . '&onay=yanlis');
exit();
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}


//giriş yapma işlemi
if (isset($_POST['giris_yap'])) {
    $username = trim($_POST['kadi']);
    $password = md5(trim($_POST['ksif']));

    $sql = "SELECT u.uye_id, u.uye_mail, p.pas_sif FROM uyeler AS u INNER JOIN pass AS p ON u.uye_id = p.uye_id WHERE u.uye_mail = :username AND p.pas_sif = :password";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['uye_id'] = $row['uye_id'];

        header("Location: ../hesap.php");
        exit();
    } else {
        echo "Giriş başarısız. Kullanıcı adı veya şifre yanlış!";
    }
}

//oturumu kapatma işlemi
if (isset($_POST['cikis_yap'])) {
    session_destroy();
    header("Location: ../giris-yap.php");
    exit();
}


//şifre sıfırlama işlemi
if (isset($_POST["sifre_sifirla"])) {
    $telefon = $_POST["sifirla_tel"];
    $onay_kodu = substr(str_shuffle("1234567890"), 0,6);
    
    $sql = "SELECT * FROM uyeler WHERE uye_tel = :telefon";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':telefon', $telefon);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $api = new VatanSMSAPI(["$telefon"], $onay_kodu.' '.'onay kodu ile gelecek toprakta hesabınızın şifresini değiştirebilirsiniz.');
        $response = $api->sendSMS();
        $sqlUpdate = "UPDATE uyeler SET uye_sifirlama = :yeni_onay_kodu WHERE uye_tel = :telefon";
        $stmtUpdate = $db->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':yeni_onay_kodu', $onay_kodu);
        $stmtUpdate->bindParam(':telefon', $telefon);
        $stmtUpdate->execute();
        header("Location: sifremi-unuttum.php?step=2&phone=$telefon");
    } else {
        echo "Bu numaraya ait bir hesap bulunmamaktadır.";
    }
}


//sifremi unuttum sayfasındaki onay kodunun doğrulanması
if (isset($_POST['unuttum_onay_kodu'])) {
    $dogrula_onay = $_POST['gelen_onay_kodu'];
    $tel = trim($_GET['phone']);
    echo $tel;
    try {
        $sorgu = $db->prepare("SELECT * FROM uyeler WHERE uye_tel = :tel AND uye_sifirlama = :dogrula_onay");
        $sorgu->bindParam(':tel', $tel);
        $sorgu->bindParam(':dogrula_onay', $dogrula_onay);
        $sorgu->execute();

        $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($kullanici) {
            header('Location: sifremi-unuttum.php?step=3&phone=' . $tel . '&onay=' . $dogrula_onay);

        } else {
            header('Location: sifremi-unuttum.php?step=2&phone=' . $tel . '&onay=yanlis');
            exit();
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}

if (isset($_POST["sifre_onay_degis"])) {
    $yeni_sifre = md5(trim($_POST["yeni_sifre"]));
    $yeni_sifre_tekrar = md5(trim($_POST["yeni_sifre_tekrar"]));
    $telefon = $_GET["phone"]; 
    $onay_kodu = $_GET["onay"];

    $sql = "SELECT * FROM uyeler WHERE uye_tel = :telefon AND uye_sifirlama = :onay_kodu";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':telefon', $telefon);
    $stmt->bindParam(':onay_kodu', $onay_kodu);
    $stmt->execute();

    $uye = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($uye) {

        if ($yeni_sifre == $yeni_sifre_tekrar) {
            $esitsifre = $yeni_sifre;
            $uye_id = $uye['uye_id'];

            $sqlUpdate = "UPDATE pass SET pas_sif = :hashed_sifre WHERE uye_id = :uye_id";
            $stmtUpdate = $db->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':hashed_sifre', $esitsifre);
            $stmtUpdate->bindParam(':uye_id', $uye_id);
            $stmtUpdate->execute();

            echo 'Şifre başarıyla güncellendi!';
        } else {
            echo 'Yeni şifreler uyuşmuyor!';
        }
    } else {
        echo 'Onay kodu veya telefon numarası hatalı!';
    }
}


//sepet ürün ekleme
if (isset($_POST['urun_ekle'])) {
    session_start();

    $urun_id = $_POST['urun_id'];
    $miktar = $_POST['miktar'];

    if (!isset($_SESSION['sepet'])) {
        $_SESSION['sepet'] = array();
    }
    $urun_key = array_search($urun_id, array_column($_SESSION['sepet'], 'urun_id'));
    if ($urun_key !== false) {
        $_SESSION['sepet'][$urun_key]['miktar'] += $miktar;
    } else {
        $_SESSION['sepet'][] = array(
            'urun_id' => $urun_id,
            'miktar' => $miktar
        );
    }

    $sql = "SELECT urun_fiyat FROM urunler WHERE urun_id = :urun_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':urun_id', $urun_id);
    $stmt->execute();
    $urun_fiyat = $stmt->fetchColumn();
    $toplamFiyat = 0;
    foreach ($_SESSION['sepet'] as $sepet_urun) {
        $toplamFiyat += $urun_fiyat * $sepet_urun['miktar'];
    }

    $_SESSION['toplam_fiyat'] = $toplamFiyat;

    header('Location: ../sepet.php');
    exit();
}


// sepetten ürün silme
if(isset($_POST['urun_kaldır'])) {
    $urun_id = $_POST['urun_id'];


    $urun_key = array_search($urun_id, array_column($_SESSION['sepet'], 'urun_id'));

    if($urun_key !== false) {
        unset($_SESSION['sepet'][$urun_key]);
        header("Location: ../sepet.php");

        }
    }


// sepetteki ürün bilgilerini çekme
$sql = "SELECT urun_adi, urun_fiyat, urun_resim FROM urunler WHERE urun_id = :urun_id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':urun_id', $urun_id);
$stmt->execute();

$urun_bilgileri = $stmt->fetch(PDO::FETCH_ASSOC);
?>




