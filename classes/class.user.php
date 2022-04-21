<?php
include __DIR__ . "/class.db.php";

class User extends Connection
{

    /**
     * @throws Exception
     */
    public function signup($uname, $email, $pw): bool
    {

        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extension = ["jpeg", "png", "jpg", "gif"];

            if (in_array($img_ext, $extension) === true) {
                $type = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
                if (in_array($img_type, $type) === true) {
                    $time = time();
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                        $ran_id = rand(time(), 100000000);
                        $status = "Active now";
                        $encrypt_pass = sha1($pw);
                        $stmt = $this->connect()->prepare("INSERT INTO coderschat.users (unique_id, username, email, password, img, status) 
                                                                    VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$ran_id, $uname, $email, $encrypt_pass, $new_img_name, $status]);
                    }
                } else {
                    throw new Exception("Dateityp ungültig!");
                }
            } else {
                throw new Exception("Dateiformat ungültig!");
            }
            return true;
        }
        return false;
    }

    public function signin($uname, $pw): bool
    {
        $stmt = $this->connect()->prepare("SELECT * FROM coderschat.users WHERE username = ?");
        $stmt->execute([$uname]);
        $rows = $stmt->rowCount();

        if ($rows > 0) {
            $result = $stmt->fetch();
            $user_pass = sha1($pw);
            $enc_pass = $result['password'];

            if ($user_pass === $enc_pass) {
                $status = "Active now";
                $stmt2 = $this->connect()->prepare("UPDATE coderschat.users SET status = '$status' WHERE unique_id = ?");
                $stmt2->execute([$result['unique_id']]);

                $_SESSION['unique_id'] = $result['unique_id'];
                return true;
            } else {
                echo 'Username oder Passwort falsch';
            }
        } else {
            echo 'Username existiert nicht';
        }
        return false;
    }

    public function getUserData($unique_id)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM coderschat.users WHERE unique_id = ?");
        $stmt->execute([$unique_id]);
        $rows = $stmt->rowCount();

        if ($rows > 0) {
            return $stmt->fetch();
        }
        return false;
    }

    public function getUsers()
    {
        $outgoing_id = $_SESSION['unique_id'];
        $stmt = $this->connect()->prepare("SELECT * FROM coderschat.users WHERE NOT unique_id = ? ORDER BY user_id DESC ");
        $stmt->execute([$outgoing_id]);
        $output = "";

        if ($stmt->rowCount() == 0) {
            $output .= "Keine User verfügbar";
        } elseif ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $stmt2 = $this->connect()->prepare("SELECT * FROM coderschat.messages 
                                WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) 
                                AND (outgoing_msg_id = '$outgoing_id' OR  incoming_msg_id = '$outgoing_id')
                                ORDER BY msg_id DESC LIMIT 1");
                $stmt2->execute();
                $row2 = $stmt2->fetch();
                ($stmt2->rowCount() > 0) ? $result = $row2['msg'] : $result = "Keine Nachrichten verfügbar!";
                (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;

                if (isset($row2['outgoing_msg_id'])) {
                    ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Du : " : $you = "";
                } else {
                    $you = "";
                }
                ($row['status'] == "offline now") ? $offline = "offline" : $offline = "";

                $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                                <div class="content">
                                    <img src="images/' . $row['img'] . '">
                                    <div class="details">
                                        <span>' . $row['username'] . '</span>
                                        <p>' . $you . $msg . '</p>
                                    </div>
                                </div>
                                <div class="status-dot"></div>
                            </a>';
            }
        }
        echo $output;
    }
}