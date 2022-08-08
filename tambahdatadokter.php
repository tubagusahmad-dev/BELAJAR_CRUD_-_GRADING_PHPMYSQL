<?php
    session_start();

    require('./koneksi.php');

    if(!isset($_SESSION['login'])){
        header('Location: ./login.php');
    }

    $nama = "";
    $alamat = "";
    $spesifikasi = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nama = $_POST['nama_dokter'];
        $alamat = $_POST['alamat_dokter'];
        $spesifikasi = $_POST['spesifikasi'];

        $query = "INSERT INTO tb_dokter (nama_dokter, spesifikasi_dokter, alamat_dokter) VALUES ('$nama', '$spesifikasi', '$alamat')";
        $hasil = mysqli_query($con, $query);

        if($hasil){
            echo '<script type="text/javascript">alert("Tambah data berhasil")</script>';
        }else{
            echo '<script type="text/javascript">alert("Tambah data gagal")</script>';
        }

        header('Location: ./datadokter.php');

    }

?>



<!DOCTYPE html>
    <head>
        <title>SIRS Abdul Muluk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./src/lib/css/chota.min.css"/>
    </head>
    <body>
        
        <div class="is-full-screen is-full-width is-center bg-grey">
            <div style="width: 25%;" class="card">
                <h2 class="text-center">Tambah Data</h2>
                <form action=" " method="post">
                    <div style="font-size: 14px;">Nama</div>
                    <input style="margin-bottom: 10px;" name="nama_dokter" id="nama" class="outline" type="text" value="<?php echo $nama ?>" placeholder="Nama" required></input>
                    <div style="font-size: 14px;">Alamat</div>
                    <input style="margin-bottom: 10px;" name="alamat_dokter" id="alamat" class="outline" type="text" value="<?php echo $alamat ?>" placeholder="Alamat" required></input>
                    <div style="font-size: 14px;">Spesifikasi</div>
                    <textarea style="margin-bottom: 10px;" name="spesifikasi" id="spesifikasi" class="outline" type="text" value="" placeholder="Spesifikasi Dokter" required><?php echo $spesifikasi ?></textarea>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Tambah"></input>
                </form>
            </div>
        </div>
    </body>

</html>