
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sayfası</title>
</head>
<body>
<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
if (isset($_SESSION["kullanici_adi"])) {

    echo "<h3>Selam ".$_SESSION["kullanici_adi"].". Hoş geldin</h3>";
    echo "<h3>".$_SESSION["email"]." Mail adresin bu.</h3>";
    echo "<a href = 'cikis.php' style = 'color : red; background-color : yellow; border : 1px solid red; padding : 5px 5px;'>Çıkış Yap</a>";
    $isim = $_SESSION["isim"];
    $soyisim = $_SESSION["soyisim"];
    $sehir = $_SESSION["şehir"];
    $ulke = $_SESSION["ülke"];
   
    
}

else {

    echo "Bu sayfayı görüntüleme yetkiniz yok!";
}

//html form ekleyip user update fonk koy.
//ekstradan city, country vs gibi bilgiler al.
//kontrol yapmadan önce yatay dikey sömür sonra kontrolü koy.
//backendde kontrol et input'u
//session ve sessionid araştır.
?>
<p>
<form action = "profile.php" method = "POST">
  <label for="isim">İsim: </label>
  <input type="text" id="isim" name="isim"><br><br>
  <label for="soyisim">Soyisim: </label>
  <input type="text" id="soyisim" name="soyisim"><br><br>
  <label for ="şehir">Şehir: </label>
  <input type = "text" id = "şehir" name = "şehir"><br><br>
  <label for = "ülke">Ülke: </label>
  <input type = "text" id = "ülke" name = "ülke"><br><br>
  <button type = "submit" name = "güncelle">Güncelle</button>
</form>
</body>
</html>
<?php
 if (isset($_POST["güncelle"])) {

    echo "İsminiz: ".$_POST["isim"]."<p>";
    echo "Soyisminiz: ".$_POST["soyisim"]."<p>";
    echo "Şehriniz: ".$_POST["şehir"]."<p>";
    echo "Ülkeniz: ".$_POST["ülke"]."<p>";        
}
?>
