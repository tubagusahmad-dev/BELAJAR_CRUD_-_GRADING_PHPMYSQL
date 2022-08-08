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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $diagnosa = $_POST['diagnosa'];
        $iddokter = $_POST['id_dokter'];
        $idpasien = $_POST['id_pasien'];

        $query = "INSERT INTO tb_diagnosa (diagnosa, id_pasien, id_dokter) VALUES ('$diagnosa', '$iddokter', '$idpasien')";
        $hasil = mysqli_query($con, $query);

        if($hasil){
            echo '<script type="text/javascript">alert("Tambah data berhasil")</script>';
            header('Location: ./');
        }else{
            echo '<script type="text/javascript">alert("Tambah data gagal")</script>';
            header('Location: ./');
        }

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
                    <input style="margin-bottom: 10px;" name="id_pasien" id="pasien" class="outline" type="text" value="<?php echo $idpasien ?>" placeholder="ID Pasien" required></input>
                    <input style="margin-bottom: 10px;" name="id_dokter" id="dokter" class="outline" type="text" value="<?php echo $iddokter ?>" placeholder="ID Dokter" required></input>
                    <textarea style="margin-bottom: 10px;" name="diagnosa" id="diagnosa" class="outline" type="text" value="" placeholder="Keterangan Diagnosa" required><?php echo $diagnosa ?></textarea>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Tambah"></input>
                </form>
            </div>
        </div>
    </body>

</html>