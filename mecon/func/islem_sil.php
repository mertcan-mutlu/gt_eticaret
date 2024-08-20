<?php 
include 'blan.php';

if (isset($_GET['kid'])) {
    $kategori_id = $_GET['kid'];

    $sqlSelect = "SELECT kategori_resim FROM kategoriler WHERE kategori_id = :kategoriID";

    try {
        $stmt = $db->prepare($sqlSelect);
        $stmt->bindParam(':kategoriID', $kategori_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $resimYolu = "../../" . $row['kategori_resim'];
            $sqlDelete = "DELETE FROM kategoriler WHERE kategori_id = :kategoriID";
            $stmtDelete = $db->prepare($sqlDelete);
            $stmtDelete->bindParam(':kategoriID', $kategori_id, PDO::PARAM_INT);
            $stmtDelete->execute(); 
            if (file_exists($resimYolu)) {
                if (unlink($resimYolu)) {
                    echo "Başarılı! Resim silindi ve kategori kaydı başarıyla kaldırıldı.";
                } else {
                    echo "Resim silinemedi.";
                }
            } else {
                echo "Resim bulunamadı.";
            }
        } else {
            echo "Kategori bulunamadı.";
        }
    } catch(PDOException $e) {
        echo "Kategori silinirken hata oluştu: " . $e->getMessage();
    }
}
 ?>