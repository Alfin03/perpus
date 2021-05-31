<!DOCTYPE html>
<html lang="en">
<?php
include "koneksi.php";
session_start();
$msg = '';
   
    
    if (isset($_POST['login']))
    {
        $user = mysqli_real_escape_string($connect, $_POST['username']);
        $pass = mysqli_real_escape_string($connect, $_POST['password']);
        $query = mysqli_query($connect, "SELECT * from akun,detail_akun WHERE akun.no_induk=detail_akun.no_induk AND akun.no_induk='$user' and detail_akun.password='$pass'");
        $cek = mysqli_num_rows($query);
        if ($cek > 0)
        {
            if($_POST['input'] == $_SESSION['captcha']){
                setcookie("username", $user, time()+3600 );
                setcookie("password", $pass, time()+3600 );
                header("Location: index.php");
            }
            else{
                $msg = '<span style="color:red">CAPTCHA FAILED!!!</span>';
            }
        }
        else
        {?><script>
            alert ("Username dan Password Tidak Tepat");</script><?php
        }
    }
?>
<style>
    .captchaStyle{
        display:flex;
        flex-direction:column;
        align-items: center;
        justify-content: center;
        background-color: white;
    }
</style>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link 
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" method="post" action="login.php">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" maxlength="20" required name="username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" maxlength="20" name="password" required placeholder="Password">
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
                                        <button class="btn btn-primary btn-user btn-block" id="login" type="submit" value="login" name="login"> Login</button>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a href="register.php">Belum Punya Akun? Daftar!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



</body>

</html>