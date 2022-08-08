<?php
    require('./koneksi.php');

    $check = true;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $passwd = md5($_POST['password']);

        $query = "INSERT INTO tb_pengguna (nama_pengguna, email_pengguna, password) VALUES ('$nama', '$email', '$passwd')";
        $check = mysqli_query($con, $query);
        
    }
?>

<!DOCTYPE html>
    <head>
        <title>SIRS Abdul Muluk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./src/lib/css/chota.min.css"/>
    </head>
    <body>
        
        <div class="is-full-screen is-full-width is-center">
            <div style="width: 25%;" class="card">
                <h2 class="text-center">Login</h2>
                <form action=" " method="post">
                    <div style="font-size: 14px;">Username</div>
                    <input style="margin-bottom: 10px;" name="nama" id="nama" class="outline" type="text"  placeholder="Nama" required></input>
                    <div style="font-size: 14px;">Email</div>
                    <input style="margin-bottom: 10px;" name="email" id="email" class="outline" type="email" placeholder="Email" required></input>
                    <div style="font-size: 14px;">Password</div>
                    <input style="margin-bottom: 10px;" name="password" id="password" class="outline" type="password"  placeholder="Password" required></input>
                    <div style="height: 15px;"></div>
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            if($check){
                                header("Location: ./");
                            }else{
                                echo '<i class="text-failed">Register Gagal</i>';
                            }
                        }
                    ?>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Register"></input>
                    <div style="height: 15px;"></div>
                    <a class="button clear is-full-width" href="./login.php">Login</a>
                </form>
            </div>
        </div>
    </body>

</html>