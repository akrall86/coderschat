<?php
session_start();
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Coders Chat | Login</title>
</head>
<body>
<div class="wrapper">
    <section class="form login">
        <header>Coders Chat Login</header>
        <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="error-text"></div>
            <div class="field input">
                <label for="uname">Username</label>
                <input type="text" name="uname" id="uname" placeholder="Username" required>
            </div>
            <div class="field input">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" placeholder="Passwort" required>
            </div>

            <div class="field button">
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])){
            include_once __DIR__ . "/classes/class.user.php";
            $user = new User();
            $check = $user->signin($_POST['uname'], $_POST['password']);
            if ($check == true){
                echo "Erfolgreich eingeloggt!";
                header("Refresh: 3; url=users.php");
            } else{
                echo "Login fehlgeschlagen!";
            }
        }
        ?>
        <div class="link">Noch kein Mitglied <a href="index.php">Sign Up</a></div>
    </section>
</div>
</body>
</html>