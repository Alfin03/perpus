<!DOCTYPE html>
<html lang="en">
<?php
include "koneksi.php";
error_reporting (E_ALL ^ E_NOTICE);
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$sqla= mysqli_query($connect, "SELECT * FROM akun,detail_akun WHERE akun.no_induk=detail_akun.no_induk AND akun.no_induk='$username' AND detail_akun.password='$password' AND detail_akun.tingkatan='user'");
if ($sqla > 0) {
    $cek = mysqli_num_rows($sqla);
}

  
  if (!isset($username)  || $cek > 0)
  {
    ?>
    <script>
      alert('Restrict');
      document.location='index.php';
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

    <title>Perpustakaan - Dashboard</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    

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
            <li class="nav-item">
                <a class="nav-link collapsed" href="peminjam.php" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-address-card"></i>
                    <span>Daftar Peminjam</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                Administrasi
            </div>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="tambah.php" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Tambah Buku</span>
                </a>
            </li>

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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Penambahan Buku</h1>
                    <div class="col-sm-12">
                    <form class="form-horizontal" method="post" action="tambah.php">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="idbuku">ID Buku :</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="idbuku" placeholder="ID Buku"  name="idbuku" required>
                            </div>
                        </div>

                        <div class="form-group text-left">
                            <label class="control-label col-sm-2" for="judul">Judul Buku :</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul Buku"  name="judul" required>
                            </div>
                        </div>

                        <div class="form-group text-left">
                            <label class="control-label col-sm-2" for="pengarang">Pengarang :</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="pengarang" placeholder="Masukkan Nama Pengarang"  name="pengarang" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tahun">Tahun Terbit :</label>
                            <div class="col-sm-12">
                               <select class="form-control" name="tahun">
                <option value="">Pilih Tahun</option>
                <?php
                $thn_skr = date('Y');
                for ($x = $thn_skr; $x >= 1900; $x--) {
                ?>
                    <option value="<?php echo $x ?>"><?php echo $x ?></option>
                <?php
                }
                ?>
            </select>
                            </div>
                        </div>
                        
                        <div class="form-group text-left">
                            <label for="jumlah" class="control-label col-sm-2 ">Jumlah Buku :</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" id="jumlah" placeholder="Nomor Telepon anda" min="0" max="100" value="0" name="jumlah" required>
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

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kelompok 9sss</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php
if (isset($_POST['submit']))
{
$id = $_POST['idbuku'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$tahun = $_POST['tahun'];
$jumlah = $_POST['jumlah'];


include 'koneksi.php';
date_default_timezone_set('Asia/Kuala_Lumpur');
$waktu = date("Y-m-d H:i:s");


$queryinsert = mysqli_query($connect, "INSERT INTO buku (id_buku,nama_buku) VALUES ('$id','$judul')");
$queryinsert1 = mysqli_query($connect, "INSERT INTO detail_buku (id_buku,tahun,pengarang,jumlah) VALUES ('$id','$tahun','$pengarang','$jumlah')");
if ($queryinsert)
{
    
?>
?><script>
            alert ("Inputan Berhasil");</script>
<?php
}
else {
?>
?><script>
            alert ("Inputan Gagal");</script>
<?php
}
}
?>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

<script type="text/javascript">
        $('.date-own').datepicker({
         
         format: 'yyyy'
       });
</script>
</body>


</html>