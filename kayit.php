<?php
include ("baglanti.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$username_err = "";
$email_err = "";
$parola_err = "";
$parola_tekrar_err = "";



if (isset($_POST['kaydol'])) {

    // Kullanıcı adı Doğrulama 

    if(empty($_POST["kullaniciadi"])) {

        $username_err = "Kullanıcı adı boş geçilemez!";
    }

    else if (strlen($_POST["kullaniciadi"]) < 6) {

        $username_err = "Kullanıcı adı en az 6 karakter olmalı!";
    }

    else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullaniciadi"])) {

        $username_err = "Kullanıcı adı sadece büyük-küçük harf ve rakamdan oluşmalıdır!";
    }

    else {

        $username = $_POST["kullaniciadi"];

    }

    // Email Doğrulama

    if (empty($_POST["email"])){

        $email_err = "Email boş geçilemez!";
    }

    else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

        $email_err = "Geçersiz email!";
    }

    else {

        $email = $_POST["email"];
    }

    // Parola Doğrulama

    if (empty($_POST["parola"])) {

        $parola_err = "Parola boş geçilemez!";
    }

    else {

        $parola = password_hash($_POST["parola"],PASSWORD_DEFAULT);
    }

    // Parola Tekrar Doğrulama

    if (empty($_POST["parola_tekrar"])) {

        $parola_tekrar_err = "Parola tekrar kısmı boş geçilemez!";
    }

    else if ($_POST["parola"] != $_POST["parola_tekrar"]) {

        $parola_tekrar_err = "Parolalar eşleşmiyor!";
    }

    else {

        $parola_tekrar = $_POST["parola_tekrar"];
    }


        if(isset($username) && isset($email) && isset($parola)) {

        $ekle = "INSERT INTO kullanicilar (kullanici_adi, email, parola) VALUES ('$username','$email','$parola')"; //second order sqli kontrolleri kaldırıp sömür.
        $calistir_ekle = mysqli_query($baglanti, $ekle);
        
        if ($calistir_ekle) {

            echo '<div class="alert alert-success" role="alert">
            Başarıyla kayıt oldunuz. Giriş sayfasına gidebilirsiniz.
            </div>';
        }

        else{

            echo '<div class="alert alert-danger" role="alert">
            Bir hata oluştu. Lütfen tekrar deneyiniz.
            </div>';
        }

        mysqli_close($baglanti);
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container p-5">
        <div class="card p-5">

            <form action="kayit.php" method="POST">

            <div class="mb-3">

                    <label for="exampleInputEmail1" class="form-label">Kullanıcı adı</label>
                    <input type="text" class="form-control 
                    
                    <?php 
                        if(!empty($username_err)) {

                            echo "is-invalid";
                        }
                    ?>"
                    id="exampleInputEmail1" name="kullaniciadi">
                    <div id="validationServer04Feedback" class="invalid-feedback">
                    <?php
                        echo $username_err;
                    ?>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email adresi</label>
                    <input type="text" class="form-control 
                    <?php 
                        if(!empty($email_err)) {

                            echo "is-invalid";
                        }
                    ?>" 
                    id="exampleInputEmail1" name="email">
                    <div id="validationServer04Feedback" class="invalid-feedback">
                    <?php 
                    echo $email_err;
                    ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Parola</label>
                    <input type="password" class="form-control 
                    <?php 
                        if(!empty($parola_err)) {

                            echo "is-invalid";
                        }
                    ?>" id="exampleInputPassword1" name="parola">
                    <div id="validationServer04Feedback" class="invalid-feedback">
                    <?php echo $parola_err; 
                    ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Parola Tekrar</label>
                    <input type="password" class="form-control 
                    <?php 
                        if(!empty($parola_tekrar_err)) {

                            echo "is-invalid";
                        }
                    ?>" id="exampleInputPassword1" name="parola_tekrar">
                    <div id="validationServer04Feedback" class="invalid-feedback">
                    <?php echo $parola_tekrar_err; 
                    ?>
                    </div>
                </div>

                <button type="submit" name= "kaydol" class="btn btn-primary">Kayıt Ol</button>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>

