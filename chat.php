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
    <title>Coders Chat | Chat</title>
</head>

<body>
<div class="wrapper">
    <section class="chat-area">
        <header>
            <?php
            $ouser_id = $_GET['user_id'];
            $user = new User();
            $r = $user->getUserData($ouser_id);
            ?>
            <img src="images/<?php echo $r['img'] ?>">
            <div class="details">
                <span><?php echo $r['username'] ?></span>
                <p><?php echo $r['status'] ?></p>
            </div>
        </header>
        <div class="chat-box">

        </div>
        <form action="#" class="typing-area">
            <input type="hidden" class="incoming_id" name="incoming_id" value="<?php echo $ouser_id; ?>">
            <input type="text" class="input-field" name="message" placeholder="Nachricht schreiben ..."
                   autocomplete="off">
            <button>></button>
        </form>

    </section>
</div>
<script src="js/chat.js"></script>
</body>
</html>