<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
            function validate(){
                var number = document.getElementById("phone");
                var numCorrect = /^[0-9]+$/;
                if (number.value.trim()=="") {
                    alert("Ups, tidak boleh kosong!");
                    return false;
                }
                else if(number.value.match(numCorrect)){
                    
                    return true;
                }
                else if(!number.value.match(numCorrect)){
                    alert("Nomor hanya boleh diisi angka");
                    return false
                }
            }
        </script>
<style>
    .captchaStyle{
        display:flex;
        flex-direction:column;
        align-items: center;
        justify-content: center;
        background-color: white;
    }
</style>

<?php
include "koneksi.php";
session_start();
$msg = '';

    if (isset($_POST['register']))
    {
        $pwd1 = $_POST['password'];
        $pwd2 = $_POST['password2'];

        if ($_POST['input'] == $_SESSION['captcha'])  {
            if($pwd1 === $pwd2){
                $stambuk = $_POST['nim'];
                $user = $_POST['username'];
                $numphone = $_POST['phone'];
                $pass = $_POST['password'];
                $addr = $_POST['alamat'];
                $query = mysqli_query($connect, "INSERT INTO akun (no_induk,nama) VALUES ('$stambuk','$user')");
                $query1 = mysqli_query($connect, "INSERT INTO detail_akun (no_induk,telepon,password,tingkatan,alamat) VALUES ('$stambuk','$numphone','$pass','user','$addr')");
                    ?>
                <script>
                  document.location='login.php';
                </script>
                <?php
            }
            else{
                ?><script>
                    alert ("Terdapat kesalahan dalam menginput data");</script><?php
            }
        } 
        else{
                $msg = '<span style="color:red">CAPTCHA FAILED!!!</span>';
            }
    }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Perpustakaan - Registrasi</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                            </div>
                            <form class="user" method="post" action="register.php" onsubmit="return validate()">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nim" maxlength="7" required name="nim" placeholder="NIM Anda...">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" required name="username" placeholder="Nama Anda...">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="phone" maxlength="15" required name="phone" placeholder="Nomor Telepon Anda...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" maxlength="20" name="password" required placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password2" maxlength="20" name="password2" required placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <textarea id="alamat" name="alamat" class="form-control form-control-user" placeholder="Alamat Anda..."></textarea>
                                </div>
                                <div class="captchaStyle"> 
                                    <strong>
                                        Type the text in the image to prove you are not a robot
                                    </strong>
                                    <div style='margin:15px'>
                                        <img src="captcha.php">
                                    </div>
                                    <form method="POST" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="text" name="input"/>
                                        <input type="hidden" name="flag" value="1"/>
                                    <div style='margin-bottom:5px'>
                                        <?php echo $msg; ?>
                                    </div>
                                    <div>
                                        Can't read the image? Click
                                        <a href='<?php echo $_SERVER['PHP_SELF']; ?>'>
                                            here
                                        </a>
                                        to refresh!
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block" id="register" type="submit" value="register" name="register"> Daftar</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="login.php">Sudah punya akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>