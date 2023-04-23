<?php
require_once './connect.php';

if(isset($_POST['Update'])) {
    $email = $_POST['email'];
    $password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);
    $new_password = $conn->real_escape_string($new_password);
    $confirm_password = $conn->real_escape_string($confirm_password);

    $password_hash = sha1($password);

    $sql = "SELECT * FROM users WHERE email = '$email' AND  password = '$password_hash'";

    $res = $conn->query($sql);

    if($res->num_rows > 0) {
        $new_password_hash = sha1($new_password);

        $sql ="UPDATE users SET password= '$new_password_hash' WHERE email = '$email'";

        $res = $conn->query($sql);
        if($res ){
            echo 'Change password successfully';

            die();
        }
      
    }else {
        echo 'doi mk tbai';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="phppot-container tile-container">
        <form name="frmChange" method="post" action=""
            onSubmit="return validatePassword()">
            <div class="validation-message text-center"><?php if(isset($message)) { echo $message; } ?></div>
            <h2 class="text-center">Change Password</h2>
            <div>
            <div class="row">
                    <label class="inline-block">Email</label>
                    <span id="email"
                        class="validation-message"></span> <input
                        type="email" name="email"
                        class="full-width">

                </div>
                <div class="row">
                    <label class="inline-block">Current Password</label>
                    <span id="currentPassword"
                        class="validation-message"></span> <input
                        type="password" name="currentPassword"
                        class="full-width">

                </div>
                <div class="row">
                    <label class="inline-block">New Password</label> <span
                        id="newPassword" class="validation-message"></span><input
                        type="password" name="newPassword"
                        class="full-width">

                </div>
                <div class="row">
                    <label class="inline-block">Confirm Password</label>
                    <span id="confirmPassword"
                        class="validation-message"></span><input
                        type="password" name="confirmPassword"
                        class="full-width">

                </div>
                <div class="row">
                <button type="submit" name = "Update" class="btn">Update</button>
                </div>
            </div>

        </form>
    </div>
</body>
</html>