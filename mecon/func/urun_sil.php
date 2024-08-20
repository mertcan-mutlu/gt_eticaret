<?php 
include 'blan.php';

if (isset($_GET['kid'])) {
    $urun_id = $_GET['kid'];
    echo "Ürün ID: " . $urun_id;

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

?>