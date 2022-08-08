<?php
    session_start();

    require('./koneksi.php');

    if(!isset($_SESSION['login'])){
        header('Location: ./login.php');
    }

    $idpasien = "";
    $nama = "";
    $alamat = "";
    $keluhan = "";

    if(isset($_GET['aksi'])){
        $aksi = $_GET['aksi'];
        $idpasien = $_GET['id'];

        if($aksi == 'ubah'){
            $query = "SELECT * FROM tb_pasien WHERE id_pasien = '$idpasien'";
            $result = mysqli_query($con, $query);
            $hasil = mysqli_fetch_array($result);
            if($hasil){
                $nama = $hasil['nama_pasien'];
                $alamat = $hasil['alamat_pasien'];
                $keluhan = $hasil['keluhan'];
            }else{
                echo '<script type="text/javascript">alert("Gagal Mengambil data");</script>';
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $idpasien = $_GET['id'];
        $nama = $_POST['nama_pasien'];
        $alamat = $_POST['alamat_pasien'];
        $keluhan = $_POST['keluhan'];

        $query = "UPDATE tb_pasien SET nama_pasien = '$nama', alamat_pasien = '$alamat', keluhan = '$keluhan' WHERE id_pasien = '$idpasien'";
        $hasil = mysqli_query($con, $query);

        if($hasil){
            echo '<script type="text/javascript">alert("Ubah data berhasil")</script>';
        }else{
            echo '<script type="text/javascript">alert("Ubah data gagal")</script>';
        }

        header('Location: ./datapasien.php');
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
                <form action="./ubahdatapasien.php?id=<?php echo $idpasien ?>" method="post">
                    <div style="font-size: 14px;">Nama</div>
                    <input style="margin-bottom: 10px;" name="nama_pasien" id="pasien" class="outline" type="text" value="<?php echo $nama ?>" placeholder="Nama" required></input>
                    <div style="font-size: 14px;">Alamat</div>
                    <input style="margin-bottom: 10px;" name="alamat_pasien" id="dokter" class="outline" type="text" value="<?php echo $alamat ?>" placeholder="Alamat" required></input>
                    <div style="font-size: 14px;">Keluhan</div>
                    <textarea style="margin-bottom: 10px;" name="keluhan" id="diagnosa" class="outline" type="text" value="" placeholder="Tulis keluhan pasien..." required><?php echo $keluhan ?></textarea>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Ubah"></input>
                </form>
            </div>
        </div>
    </body>

</html>