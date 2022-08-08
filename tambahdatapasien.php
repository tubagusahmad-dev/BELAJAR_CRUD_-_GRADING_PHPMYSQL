<?php
    session_start();

    require('./koneksi.php');

    if(!isset($_SESSION['login'])){
        header('Location: ./login.php');
    }

    $nama = "";
    $alamat = "";
    $tanggal = "";
    $keluhan = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nama = $_POST['nama_pasien'];
        $alamat = $_POST['alamat_pasien'];
        $tglmasuk = $_POST['tgl_masuk'];
        $tglkeluar = $_POST['tgl_keluar'];
        $keluhan = $_POST['keluhan'];

        $query = "INSERT INTO tb_pasien (nama_pasien, alamat_pasien, tgl_masuk, tgl_keluar, keluhan) VALUES ('$nama', '$alamat', '$tglmasuk', '$tglkeluar', '$keluhan')";
        $hasil = mysqli_query($con, $query);

        if($hasil){
            echo '<script type="text/javascript">alert("Tambah data berhasil")</script>';
        }else{
            echo '<script type="text/javascript">alert("Tambah data gagal")</script>';
        }

        header('Location: ./datapasien.php');

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
                    <input style="margin-bottom: 10px;" name="nama_pasien" id="pasien" class="outline" type="text" placeholder="Nama" required></input>
                    <div style="font-size: 14px;">Alamat</div>
                    <input style="margin-bottom: 10px;" name="alamat_pasien" id="alamat" class="outline" type="text" placeholder="Alamat" required></input>
                    <div style="font-size: 14px;">Tgl. Masuk</div>
                    <input style="margin-bottom: 10px;" name="tgl_masuk" id="tgl_masuk" class="outline" value="" placeholder="Nama" type="date" required></input>
                    <div style="font-size: 14px;">Tgl. Keluar</div>
                    <input style="margin-bottom: 10px;" name="tgl_keluar" id="tgl_keluar" class="outline" value="" type="date"  required></input>
                    <div style="font-size: 14px;">Keluhan</div>
                    <textarea style="margin-bottom: 10px;" name="keluhan" id="keluhan" class="outline" type="text" placeholder="Tulis keluhan pasien" required></textarea>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Tambah"></input>
                </form>
            </div>
        </div>
    </body>

</html>