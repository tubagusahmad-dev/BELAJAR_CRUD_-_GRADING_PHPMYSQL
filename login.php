<?php

    session_start();

    require('./koneksi.php');

    $check = true;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $passwd = md5($_POST['password']);

        $query = "SELECT * FROM tb_pengguna WHERE email_pengguna = '$email' AND password = '$passwd'";
        $result = mysqli_query($con, $query);
        $check = mysqli_fetch_array($result);
        
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
                    <input style="margin-bottom: 10px;" name="email" id="email" class="outline" type="email" placeholder="Email" required></input>
                    <input style="margin-bottom: 10px;" name="password" id="password" class="outline" type="password"  placeholder="Password" required></input>
                    <div style="height: 15px;"></div>
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            if($check){
                                $_SESSION['login'] = true;
                                header("Location: ./");
                            }else{
                                echo '<i class="text-failed">Nama atau sandi salah</i>';
                            }
                        }
                    ?>
                    <div style="height: 15px;"></div>
                    <input type="submit" class="button primary is-full-width" id="button-login" class="button primary is-full-width" value="Login"></input>
                    <div style="height: 15px;"></div>
                    <a class="button clear is-full-width" href="./register.php">Register</a>
                </form>
            </div>
        </div>
    </body>

</html>