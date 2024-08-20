<?php

include '../func/blan.php'; 


$resp = array();

$username = md5($_POST["username"]);
$password = md5($_POST["password"]);

try {

    $stmt = $db->prepare("SELECT * FROM admin WHERE admin_kadi = :username AND admin_sif = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password); 
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);


    $resp['submitted_data'] = $_POST;


    $login_status = 'invalid';
    if ($admin) {
        $login_status = 'success';
    }

    $resp['login_status'] = $login_status;


    if ($login_status == 'success') {


        $_SESSION["admin_var"] = "admin";


        $resp['redirect_url'] = 'index.php';
    }
} catch (PDOException $e) {

    $resp['error'] = 'Veritabanı hatası: ' . $e->getMessage();
}

$stmt = null;
$db = null;

echo json_encode($resp);
?>
