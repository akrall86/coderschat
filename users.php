<?php
session_start();
include_once __DIR__ . "/classes/class.user.php";
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Coders Chat | Users</title>
</head>

<body>
<div class="wrapper">
    <section class="users">
        <header>
            <div class="content">
                <?php
                    $user = new User();
                    $r = $user->getUserData($_SESSION['unique_id']);
                ?>
                <img src="images/<?php echo  $r['img']?>">
                <div class="details">
                    <span><?php echo  $r['username']?></span>
                    <p><?php echo  $r['status']?></p>
                </div>
            </div>
            <a href="">Logout</a>
        </header>
        <div class="users-list">
            <span class="text">Users</span>
            <?php
                $user->getUsers();
            ?>
        </div>
    </section>
</div>
</body>
</html>