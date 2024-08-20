<?php include'func/function.php'; ?>
<?php include'func/islem.php'; ?>
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["admin_var"])) {

} else {
    header("Location: login.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">

	<title>Yönetim Paneli | CONME </title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body" >

<div class="page-container">
	
	<div class="sidebar-menu">

		<div class="sidebar-menu-inner">
			
			<header class="logo-env">

				<!-- logo -->
				<div class="logo">
					<a href="index.html">
						<img src="assets/images/logo@2x.png" width="170" alt="" />
					</a>
				</div>

				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon with-animation">
						<i class="entypo-menu"></i>
					</a>
				</div>

								
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation">
						<i class="entypo-menu"></i>
					</a>
				</div>

			</header>
			
						<div class="sidebar-user-info">

				<div class="sui-normal">
					<a href="#" class="user-link">
						<img src="assets/images/thumb-1@2x.png" width="55" alt="" class="img-circle" />

						
						<strong>Mertcan Mutlu</strong>
						<span>Yönetici</span>
					</a>
				</div>

				<div class="sui-hover inline-links animate-in">
					<a href="#">
						<i class="entypo-pencil"></i>
						Kullanıcı Ayarları
					</a>

					<form action="func/islem.php" method="post">
   					<button class="btn btn-success" name="admin_cikis" type="submit">
       					 <i class="entypo-lock"></i>
       						 Çıkış Yap
  						  </button>
					</form>

					<span class="close-sui-popup">&times;</span>			</div>
			</div>
			
									
			<ul id="main-menu" class="main-menu">

				<li class="<?php echo ($oldugumsayfa == 'panel-ana-sayfasi') ? 'active' : ''; ?>">
					<a href="index.php">
						<i class="entypo-monitor"></i>
						<span class="title">Panel Ana Sayfası</span>
					</a>
				</li>
				<li class="<?php echo ($oldugumsayfa == 'slider') ? 'active' : ''; ?>">
					<a href="slider-islemleri.php">
						<i class="entypo-picture"></i>
						<span class="title">Slider İşlemleri</span>
					</a>
				</li>
				<li class="<?php echo ($oldugumsayfa == 'urunler' || $oldugumsayfa == 'kategoriler') ? 'active has-sub root-level opened' : ''; ?>"> 
					<a href="">
						<i class="entypo-tag"></i>
						<span class="title">Ürün Yönetimi</span>
					</a>
					<ul >
						<!-- <li class="">
							<a href="#">
								<span class="title">Siparişler</span>
							</a>
						</li>-->
						<li class="<?php echo ($oldugumsayfa == 'urunler') ? 'active' : ''; ?>">
							<a href="urunler.php">
								<span class="title">Ürünler</span>
							</a>
						</li>
						<li class="<?php echo ($oldugumsayfa == 'kategoriler') ? 'active' : ''; ?>" >
							<a href="kategori_uy.php">
								<span class="title">Kategoriler</span>
							</a>
						</li>							
					</ul>
					<li class="<?php echo ($oldugumsayfa == 'mesajlar') ? 'active' : ''; ?>">
						<a href="mesajlar.php">
							<i class="entypo-mail"></i>
							<span class="title">Destek Talepleri</span>
						</a>
					</li>
					<!-- <li class="">
						<a href="#" target="_blank">
							<i class="entypo-user"></i>
							<span class="title">Üyeler</span>
						</a>
					</li>-->
					<li class="<?php echo ($oldugumsayfa == 'genelayarlar') ? 'active' : ''; ?>">
						<a href="ayarlar.php">
							<i class="entypo-cog"></i>
							<span class="title">Genel Ayarlar</span>
						</a>
					</li>
				</li>
				
				
				
				
			</ul>
			
		</div>

	</div>
