<?php 

    session_start();

    require('./koneksi.php');

    if(!isset($_SESSION['login'])){
        header('Location: ./login.php');
    }

    $query = "SELECT * FROM tb_diagnosa";

    if(isset($_GET["sort"])){
        $sort = $_GET["sort"];

        if($sort == "by_latest"){
            $query = "SELECT * FROM tb_diagnosa ORDER BY id_diagnosa DESC";
        }else if($sort == "by_older"){
            $query = "SELECT * FROM tb_diagnosa ORDER BY id_diagnosa ASC";
        }
    }

    $result = mysqli_query($con, $query);
    $diagnosa = mysqli_fetch_array($result);

    if(isset($_GET['aksi'])){
        $aksi = $_GET['aksi'];
        $id = $_GET['id'];

        if($aksi == 'hapus'){
            $query = "DELETE FROM tb_diagnosa WHERE id_diagnosa = '$id'";
            $hasil = mysqli_query($con, $query);
            if($hasil){
                echo '<script type="text/javascript">alert("Hapus dats berhasil");</script>';
            }else{
                echo '<script type="text/javascript">alert("Hapus data gagal");</script>';
            }
            header('Location: ./');
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title><?php echo $data; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./src/lib/css/chota.min.css"/>

        <style>
            table, th, td {
                border-collapse: collapse;
                padding: 10px;
            }

            .bg-gambar{
                background-image : url('./src/background.jpeg');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            a:link, a:visited {
                text-decoration: none;
                display: inline-block;
            }

            a:hover {
                color: blue;
            }
        </style>

        <script type="">
            function optionSelect(evt){
                window.location = '?sort=' + evt.value
            }
        </script>
    </head>
    <body>
        
        <div style="padding: 40px;" class="is-full-screen is-full-width bg-gambar">
            <h1 style="margin-top:25px;" class="text-center">Sistem Informasi Rumah Sakit</h1>
            <div class="row">
                <div class="col-6">
                    <div class="card is-center">
                        <a class="is-full-width text-center" href="./datapasien.php">Data Pasien</a>
                    </div>
                </div>
                <div class="col-6">
                <div class="card is-center">
                        <a class="is-full-width text-center" href="./datadokter.php">Data Dokter</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <h2 class="text-center">Data Diagnosa</h2>
                <div style="padding-bottom: 30px;">
                    <select style="float: left; width: 200px;" class="outline primary" onchange="optionSelect(this)">
                        <option value="volvo">Urut berdasarkan</option>
                        <option value="by_latest">Data Baru</option>
                        <option value="by_older">Data Lama</option>
                    </select>
                    <a href="./tambahdatadiagnosa.php" style="float: right;" class="button primary">Tambah Data</a>
                </div>
                <div style="height:15px;"></div>
                <table class="bd-primary">
                    <tr class="bg-primary">
                        <th class="text-light">ID</th>
                        <th class="text-light">ID Pasien</th>
                        <th class="text-light">ID Dokter</th>
                        <th class="text-light">Diagnosa Penyakit</th>
                        <th class="text-light">Aksi</th>
                    </tr>
                    <?php foreach($result as $hasil){ ?>
                        <tr>
                            <th><?php echo $hasil['id_diagnosa']; ?></th>
                            <th><?php echo $hasil['id_pasien']; ?></th>
                            <th><?php echo $hasil['id_dokter']; ?></th>
                            <th><?php echo $hasil['diagnosa']; ?></th>
                            <th>
                                <a href="<?php echo "./ubahdatadiagnosa.php?aksi=ubah&id=".$hasil['id_diagnosa']; ?>" class="button success">Ubah</a> 
                                <a href="<?php echo "./?aksi=hapus&id=".$hasil['id_diagnosa']; ?>" class="button dark">Hapus</a>
                            </th>
                        </tr>
                    <?php }; ?>
                </table>
            </div>
        </div>
    </body>
</html>