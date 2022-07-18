<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Coders Chat | Sign Up</title>
</head>
<body>
<div class="wrapper">
    <section class="form signup">
        <header>Coders Chat</header>
        <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="error-text"></div>
            <div class="field input">
                <label for="uname">Username</label>
                <input type="text" name="uname" id="uname" placeholder="Username" required>
            </div>
            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="field input">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" placeholder="Passwort" required>
            </div>
            <div class="field image">
                <label>Bild auswählen</label>
                <input type="file" name="image" accept="image/x-png, image/gif, image/jpg, image/jpeg" required>
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Sign Up">
            </div>
        </form>
        <?php
            if (isset($_POST['submit'])){
                include_once __DIR__ . "/classes/class.user.php";
                $user = new User();
                $check = $user->signup($_POST['uname'], $_POST['email'], $_POST['password']);
                if ($check == true){
                    echo "Erfolgreich registriert!";
                    header("Refresh: 3; url=login.php");
                } else{
                    echo "Registrierung fehlgeschlagen!";
                }
            }
        ?>
        <div class="link">Bereits registriert? <a href="login.php">Login</a></div>
    </section>
</div>
</body>
</html>