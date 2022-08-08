<?php
    session_start();

    require('./koneksi.php');

    if(!isset($_SESSION['login'])){
        header('Location: ./login.php');
    }

    $iddokter = "";
    $nama = "";
    $alamat = "";
    $spesifikasi = "";

    if(isset($_GET['aksi'])){
        $aksi = $_GET['aksi'];
        $iddokter = $_GET['id'];

        if($aksi == 'ubah'){
            $query = "SELECT * FROM tb_dokter WHERE id_dokter = '$iddokter'";
            $result = mysqli_query($con, $query);
            $hasil = mysqli_fetch_array($result);
            if($hasil){
                $nama = $hasil['nama_dokter'];
                $alamat = $hasil['alamat_dokter'];
                $spesifikasi = $hasil['spesifikasi_dokter'];
            }else{
                echo '<script type="text/javascript">alert("Gagal Mengambil data");</script>';
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $iddokter = $_GET['id'];
        $nama = $_POST['nama_dokter'];
        $alamat = $_POST['alamat_dokter'];
        $spesifikasi = $_POST['spesifikasi'];

        $query = "UPDATE tb_dokter SET nama_dokter = '$nama', spesifikasi_dokter = '$spesifikasi', alamat_dokter = '$alamat' WHERE id_dokter = '$iddokter'";
        $hasil = mysqli_query($con, $query);

        if($hasil){
            echo '<script type="text/javascript">alert("Ubah data berhasil")</script>';
        }else{
            echo '<script type="text/javascript">alert("Ubah data gagal")</script>';
        }
        
        header('Location: ./datadokter.php');
    }

?>



<!DOCTYPE html>
    <head>
        <title>SIRS : Ubah Data</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./src/lib/css/chota.min.css"/>
    </head>
    <body>
        
        <div class="is-full-screen is-full-width is-center bg-grey">
            <div style="width: 25%;" class="card">
                <h2 class="text-center">Ubah Data</h2>
                <form action="./ubahdatadokter.php?id=<?php echo $iddokter ?>" method="post">
                    <div style="font-size: 14px;">Nama</div>
                    <input style="margin-bottom: 10px;" name="nama_dokter" id="nama" class="outline" type="text" value="<?php echo $nama ?>" placeholder="Nama" required></input>
                    <div style="font-size: 14px;">Alamat</div>
                    <input style="margin-bottom: 10px;" name="alamat_dokter" id="alamat" class="outline" type="text" value="<?php echo $alamat ?>" placeholder="Alamat" required></input>
                    <div style="font-size: 14px;">Spesifikasi</div>
                    <textarea style="margin-bottom: 10px;" name="spesifikasi" id="spesifikasi" class="outline" type="text" value="" placeholder="Spesifikasi Dokter" required><?php echo $spesifikasi ?></textarea>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Ubah"></input>
                </form>
            </div>
        </div>
    </body>

</html>