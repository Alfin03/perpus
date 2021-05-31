<!DOCTYPE html>
<html lang="en">
<?php
include "koneksi.php";
error_reporting (E_ALL ^ E_NOTICE);
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$a = $username;

  if (!isset($username))
  {
    ?>
    <script>
      alert('Cookie habis');
      document.location='login.php';
    </script>
    <?php
    exit;
  }
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan - Peminjaman Buku</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    
                </div>
                <div class="sidebar-brand-text mx-3">Perpustakaan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Peminjaman
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="peminjaman.php" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-book-reader"></i>
                    <span>Peminjaman Buku</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <?php
            $sqla= mysqli_query($connect, "SELECT * FROM akun,detail_akun WHERE akun.no_induk=detail_akun.no_induk AND akun.no_induk='$username' AND detail_akun.password='$password' AND detail_akun.tingkatan='admin'");
            $cek = mysqli_num_rows($sqla);
  
            if (!isset($username)  || $cek > 0){?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="peminjam.php" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-address-card"></i>
                    <span>Daftar Peminjam</span>
                </a>
            </li><?php
            } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                Administrasi
            </div>
            <?php
             $sqla= mysqli_query($connect, "SELECT * FROM akun,detail_akun WHERE akun.no_induk=detail_akun.no_induk AND akun.no_induk='$username' AND detail_akun.password='$password' AND detail_akun.tingkatan='admin'");
            $cek = mysqli_num_rows($sqla);
  
            if (!isset($username)  || $cek > 0){?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="tambah.php" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Tambah Buku</span>
                </a>
            </li><?php
            } ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="list.php" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Daftar Buku</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Kelompok 9</span>
                                
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 text-center">Form Peminjaman Buku</h1>
                    <div class="col-sm-12">
                    <form class="form-horizontal" method="post" action="peminjaman.php">
                        


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="jb">Judul Buku :</label>
                            <div class="col-sm-12">
                               <select class="form-control" id="pinjam" name="pinjam">
                                <?php
   
                    include "koneksi.php";

                $sql="SELECT * from buku, detail_buku WHERE buku.id_buku=detail_buku.id_buku AND jumlah!=0 ORDER BY nama_buku";

                $hasil=mysqli_query($connect,$sql);
                $no=0;
                while ($data = mysqli_fetch_array($hasil)) {
                $no++;
                ?>
                <option value="<?php echo $data['id_buku'];?>"><?php echo $data['nama_buku'];?></option>
                <?php 
        }
    ?>
            </select>
                            </div>
                        </div>

                        <div class="form-group text-left">
                            <label class="control-label col-sm-2" for="kembali">Pengembalian :</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="kembali" name="kembali">
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-floppy-save"></span> Submit</button>
                                <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span> Reset</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php
if (isset($_POST['submit']))
{
$id = $_POST['id'];

$pinjam = $_POST['pinjam'];

$kembali = $_POST['kembali'];


date_default_timezone_set('Asia/Kuala_Lumpur');
$waktu = date("Y-m-d H:i:s");
$selSto =mysqli_query($connect, "SELECT jumlah FROM detail_buku WHERE id_buku='$pinjam'");
    $sto    =mysqli_fetch_array($selSto);
    $stok   =$sto['jumlah'];
    $sisa    =$stok-1;
$id_buku =mysqli_query($connect, "SELECT id_buku FROM buku WHERE id_buku='$pinjam'");
    $ib    =mysqli_fetch_array($id_buku);
    $x   =$ib['id_buku'];

$p = 'P_';


    
$queryinsert = mysqli_query($connect, "INSERT INTO pinjam (no_induk,id_buku,kembali) VALUES ('$a','$x','$kembali')");
$queryinsert2 = mysqli_query($connect, "UPDATE pinjam SET id_pinjam=CONCAT('$p',1000+urut)");
$queryinsert3 = mysqli_query($connect, "INSERT INTO proses_pinjam (urutan) VALUES ('')");
$queryinsert1 = mysqli_query($connect, "UPDATE proses_pinjam SET id_pinjam=CONCAT('$p',1000+urutan)");    
if ($queryinsert)
{
    $query = mysqli_query($connect, "UPDATE detail_buku SET jumlah='$sisa' WHERE id_buku='$pinjam'");
?>
<script>
            alert ("Inputan Berhasil");
         header("Location: index.php");</script>

<?php
}
else {
?>
<script>
            alert ("Inputan Gagal");
        header("Location: index.php");</script>
<?php
}
}
?>
</div></div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kelompok 9</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda ingin keluar ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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