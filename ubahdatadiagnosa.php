<?php
    session_start();

    require('./koneksi.php');

    if(!isset($_SESSION['login'])){
        header('Location: ./login.php');
    }

    $iddiagnosa = "";
    $diagnosa = "";
    $iddokter = "";
    $idpasien = "";

    if(isset($_GET['aksi'])){
        $aksi = $_GET['aksi'];
        $iddiagnosa = $_GET['id'];

        if($aksi == 'ubah'){
            $query = "SELECT * FROM tb_diagnosa WHERE id_diagnosa = '$iddiagnosa'";
            $result = mysqli_query($con, $query);
            $hasil = mysqli_fetch_array($result);
            if($hasil){
                $iddiagnosa = $hasil['id_diagnosa'];
                $diagnosa = $hasil['diagnosa'];
                $iddokter = $hasil['id_dokter'];
                $idpasien = $hasil['id_pasien'];
            }else{
                echo '<script type="text/javascript">alert("Gagal Mengambil data");</script>';
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $iddiagnosa = $_GET['id'];
        $diagnosa = $_POST['diagnosa'];
        $iddokter = $_POST['id_dokter'];
        $idpasien = $_POST['id_pasien'];

        $query = "UPDATE tb_diagnosa SET diagnosa = '$diagnosa', id_pasien = '$idpasien', id_dokter = '$iddokter' WHERE id_diagnosa = '$iddiagnosa'";
        $hasil = mysqli_query($con, $query);

        if($hasil){
            echo '<script type="text/javascript">alert("Ubah data berhasil")</script>';
        }else{
            echo '<script type="text/javascript">alert("Ubah data gagal")</script>';
        }

        header("Location: ./");
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
                <h2 class="text-center">Tambah Data</h2>
                <form action="?id=<?php echo $iddiagnosa ?>" method="post">
                    <div style="font-size: 14px;">ID Pasien</div>
                    <input style="margin-bottom: 10px;" name="id_pasien" id="pasien" class="outline" type="text" value="<?php echo $idpasien ?>" placeholder="ID Pasien" required></input>
                    <div style="font-size: 14px;">ID Dokter</div>
                    <input style="margin-bottom: 10px;" name="id_dokter" id="dokter" class="outline" type="text" value="<?php echo $iddokter ?>" placeholder="ID Dokter" required></input>
                    <div style="font-size: 14px;">Diagnosa</div>
                    <textarea style="margin-bottom: 10px;" name="diagnosa" id="diagnosa" class="outline" type="text" value="" placeholder="Keterangan Diagnosa" required><?php echo $diagnosa ?></textarea>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Ubah"></input>
                </form>
            </div>
        </div>
    </body>

</html>