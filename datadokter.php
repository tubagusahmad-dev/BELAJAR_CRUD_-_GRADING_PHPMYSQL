<?php 
    session_start();

    require('./koneksi.php');

    if(!isset($_SESSION['login'])){
        header('Location: ./login.php');
    }

    $query = "SELECT * FROM tb_dokter";

    if(isset($_GET["sort"])){
        $sort = $_GET["sort"];

        if($sort == "by_latest"){
            $query = "SELECT * FROM tb_dokter ORDER BY id_dokter DESC";
        }else if($sort == "by_older"){
            $query = "SELECT * FROM tb_dokter ORDER BY id_dokter ASC";
        }else if($sort == "by_name_atoz"){
            $query = "SELECT * FROM tb_dokter ORDER BY nama_dokter ASC";
        }else if($sort == "by_name_ztoa"){
            $query = "SELECT * FROM tb_dokter ORDER BY nama_dokter DESC";
        }
    }

    $result = mysqli_query($con, $query);
    $dokter = mysqli_fetch_array($result);

    if(isset($_GET['aksi'])){
        $aksi = $_GET['aksi'];
        $id = $_GET['id'];

        if($aksi == 'hapus'){
            $query = "DELETE FROM tb_dokter WHERE id_dokter = '$id'";
            $hasil = mysqli_query($con, $query);
            if($hasil){
                echo '<script type="text/javascript">alert("Hapus dats berhasil");</script>';
            }else{
                echo '<script type="text/javascript">alert("Hapus data gagal");</script>';
            }
            header('Location: ./datadokter.php');
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
        </style>

        <script type="">
            function optionSelect(evt){
                window.location = '?sort=' + evt.value
            }
        </script>
    </head>
    <body>
        
        <div style="padding: 40px;" class="is-full-screen is-full-width">
            <a href="./" class="button clear">Kembali</a>
            <h2 class="text-center">Data Dokter</h2>
            <div style="padding-bottom: 30px;">
                <select style="float: left; width: 200px;" class="outline primary" onchange="optionSelect(this)">
                    <option value="volvo">Urut berdasarkan</option>
                    <option value="by_latest">Data Baru</option>
                    <option value="by_older">Data Lama</option>
                    <option value="by_name_atoz">Nama A-Z</option>
                    <option value="by_name_ztoa">Nama Z-A</option>
                </select>
                <a href="./tambahdatadokter.php" style="float: right;" class="button primary">Tambah Data</a>
            </div>
            <div style="height:15px;"></div>
            <table class="bd-primary">
                <tr class="bg-primary">
                    <th class="text-light">ID</th>
                    <th class="text-light">Nama</th>
                    <th class="text-light">Spesifikasi</th>
                    <th class="text-light">Alamat</th>
                    <th class="text-light">Aksi</th>
                </tr>
                <?php foreach($result as $hasil){ ?>
                    <tr>
                        <th><?php echo $hasil['id_dokter']; ?></th>
                        <th><?php echo $hasil['nama_dokter']; ?></th>
                        <th><?php echo $hasil['spesifikasi_dokter']; ?></th>
                        <th><?php echo $hasil['alamat_dokter']; ?></th>
                        <th>
                            <a href="<?php echo "./ubahdatadokter.php?aksi=ubah&id=".$hasil['id_dokter']; ?>" class="button success">Ubah</a> 
                            <a href="<?php echo "./datadokter.php?aksi=hapus&id=".$hasil['id_dokter']; ?>" class="button dark">Hapus</a>
                        </th>
                    </tr>
                <?php }; ?>
            </table>
        </div>
    </body>
</html>