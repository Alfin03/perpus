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

    <title>Perpustakaan - Daftar Peminjam</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            <li class="nav-item active">
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

            <li class="nav-item">
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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Peminjam Buku</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Pinjam</th>
                                            <th>ID Buku</th>
                                            <th>Nama Peminjam</th>
                                            <th>Telepon</th>
                                            <th>Deadline</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Denda</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID Pinjam</th>
                                            <th>ID Buku</th>
                                            <th>Nama Peminjam</th>
                                            <th>Telepon</th>
                                            <th>Deadline</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Denda</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>


                                    <?php
    include "koneksi.php";
    
    $queryanggota = mysqli_query($connect, "SELECT * FROM pinjam,proses_pinjam,detail_akun,akun WHERE pinjam.id_pinjam=proses_pinjam.id_pinjam AND pinjam.no_induk=akun.no_induk AND akun.no_induk=detail_akun.no_induk ");
    date_default_timezone_set('Asia/Kuala_Lumpur');
$waktu = date("Y-m-d");
        
    $query = mysqli_query($connect, "UPDATE proses_pinjam,pinjam SET status='PINJAM' WHERE pinjam.id_pinjam=proses_pinjam.id_pinjam AND kembali>NOW()");

    $query1 = mysqli_query($connect, "UPDATE proses_pinjam,pinjam SET status='TELAT' WHERE pinjam.id_pinjam=proses_pinjam.id_pinjam AND kembali<NOW()");

  
    $q = $connect->query("SELECT * FROM pinjam WHERE NOW() > kembali");
  
    $no = 1;
    while($r = $q->fetch_assoc()) {
     
     $t = date_create($r['kembali']);
     $n = date_create(date('Y-m-d'));
     $terlambat = date_diff($t, $n);
     $hari = $terlambat->format("%a");

     
     $denda = $hari * 1000;
     $query2 = mysqli_query($connect, "UPDATE proses_pinjam,pinjam SET denda='$denda' WHERE pinjam.id_pinjam=proses_pinjam.id_pinjam AND kembali<NOW() AND status='TELAT' AND denda='0'");

}
    
       
   
    
if($queryanggota>0) {
    

    while ($anggota = mysqli_fetch_array($queryanggota))

    {
        
        
?>
<?php
if (isset($_GET['hapus']))
{ 
$id_buku = $_GET['id_buku'];
  
$id_pinjam = $_GET['id_pinjam'];
$querydelete = mysqli_query($connect, "DELETE FROM proses_pinjam WHERE id_pinjam='$id_pinjam'");
$querydelete = mysqli_query($connect, "DELETE FROM pinjam WHERE id_pinjam='$id_pinjam'");

if ($querydelete)
{
    $selSto =mysqli_query($connect, "SELECT jumlah FROM detail_buku WHERE id_buku='$id_buku'");
    $sto    =mysqli_fetch_array($selSto);
    $stok   =$sto['jumlah'];
    $sisa    =$stok+1 ;
    $query = mysqli_query($connect, "UPDATE detail_buku SET jumlah='$sisa' WHERE id_buku='$id_buku'");
  

    

?>
<script>
    
            alert ("SELESAI");
document.location='index.php';

            
         </script>
<?php
}
else
{
?>
<script>
            alert ("GAGAL");
            
         </script>
<?php
}
}
?>
    <tr>
        <td><?=$anggota['id_pinjam']?></td>
        <td><?=$anggota['id_buku']?></td>
        <td><?=$anggota['nama']?></td>
        <td><?=$anggota['telepon']?></td>
        <td><?=$anggota['kembali']?></td>
        <td><?=$anggota['alamat']?></td>
        <td><?=$anggota['status']?></td>
        <td><?=$denda?></td>
        <td><a href="peminjam.php?hapus=ok&id_pinjam=<?=$anggota['id_pinjam']?>&id_buku=<?=$anggota['id_buku']?>"><button type="button" class="btn btn-sm btn-info"> SELESAI</button></a></td></td>
        


    </tr>
<?php
    }}
?>
    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>