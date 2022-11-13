<?php
include ("baglanti.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$username_err = "";
$parola_err = "";

if (isset($_POST['giris'])) {

    // Kullanıcı adı Doğrulama 

    if (empty($_POST["kullaniciadi"])) {

        $username_err = "Kullanıcı adı boş geçilemez!";
    }

    else {

        $username = $_POST["kullaniciadi"];

    }

    // Parola Doğrulama

    if (empty($_POST["parola"])) {

        $parola_err = "Parola boş geçilemez!";
    }

    else {

        $parola = $_POST["parola"];
    }

    if(isset($username) && isset($parola)) {

        $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$username'";//sqli dene
        $calistir = mysqli_query($baglanti, $secim);

        $kayit_sayisi = mysqli_num_rows($calistir); // 0 veya 1

        if ($kayit_sayisi > 0) {

            $ilgili_kayit = mysqli_fetch_assoc($calistir);
            $hashli_sifre = $ilgili_kayit["parola"];

            if (password_verify($parola,$hashli_sifre)) {

                session_start();
                $_SESSION["kullanici_adi"] = $ilgili_kayit["kullanici_adi"];
                $_SESSION["email"] = $ilgili_kayit["email"];
                header("location:profile.php");
            }

            else {

                echo '<div class="alert alert-danger" role="alert">
            Kullanıcı adı veya parola hatalı!
            </div>';
            }
        }

        else {

            echo '<div class="alert alert-danger" role="alert">
            Kullanıcı adı veya parola hatalı!
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
    <title>Üye Giriş Sayfası</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="card">

            <form action="login.php" method="POST">

            <div class="mb-3">

                    <label for="exampleInputEmail1" class="form-label"><b>Kullanıcı adı</label>
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

                <button type="submit" name= "giris" class="btn btn-primary"><b>Giriş Yap</button>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>

