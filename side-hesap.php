<?php 
$uye_id = $_SESSION['uye_id'];
$sql = "SELECT * FROM uyeler WHERE uye_id = :uye_id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':uye_id', $uye_id);
$stmt->execute();
$uye_verisi = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="col-lg-4">
                <!-- Account Sidebar-->
                <div class="wizard">
                    <nav class="list-group list-group-flush">
                        <a class="list-group-item active" href="hesap.php">
                            <div class=" justify-content-between align-items-center">
                                <div>
                                    <div class="font-weight-medium text-white">Hesap Ayarları</div>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item" href="#">
                            <div class=" justify-content-between align-items-center">
                                <div>
                                    <div class="font-weight-medium text-dark">Siparişlerim</div>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item" href="#">
                            <div class=" justify-content-between align-items-center">
                                <div>
                                    <div class="font-weight-medium text-dark">Adres Bilgilerim</div>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item" href="#">
                            <div class=" justify-content-between align-items-center">
                                <div>
                                    <div class="font-weight-medium text-dark"></div>
                                </div>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>  