<?php

ini_set('display_errors', true);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host = "localhost";
$kullanici = "root";
$parola = "";
$veritabani = "uyelik";

$baglanti = new mysqli($host, $kullanici, $parola, $veritabani);//PDO ARAŞTIR BURAYA KOY
//mysqli_set_charset($baglanti, "UTF8");

if ($baglanti -> connect_errno) {
    echo "Failed to connect to MySQL: ". $baglanti -> connect_error;
    exit();
}

?>