<?php 
include 'hf-element/islem.php'; 

$bakim_modu = $ayarcek['ayar_bakim'];

if ($bakim_modu == 0) {
  header('Location: index.php'); 
  exit();
}


?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ahh fare kemirdi! | Bakımdayız.. </title>
    <style>
        body {
            text-align: center;
            padding: 150px;
        }

        h1 {
            font-size: 50px;
        }

        body {
            font: 20px Helvetica, sans-serif;
            color: #333;
        }

        article {
            display: block;
            text-align: left;
            width: 650px;
            margin: 0 auto;
        }

        a {
            color: #00b215;
            text-decoration: none;
        }

        a:hover {
            color: #333;
            text-decoration: none;
        }

        .image-span {
            display: inline-block;
            width: 659px; 
            height: 165px; 
            background-image: url('img/bakim1.png'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center center;
        }
    </style>
</head>
<body>
    <article>
        <span class="image-span"></span>
        <h2>Web sitemizi fareler kemirdiği için şu anda bakımdayız!</h2>
        <div>
            <p>İhtiyacınız olursa bizimle her zaman <a href="mailto:mutlum5588@gmail.com">iletişime</a> geçebilirsiniz, En kısa zamanda tekrar çevrimiçi olacağız!</p>
            <p>&mdash; Gelecek Toprakta Ekibi</p>
        </div>
    </article>
</body>
</html>
