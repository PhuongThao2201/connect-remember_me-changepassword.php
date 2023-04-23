<?php
session_start();
require_once "./connect.php";
$errors = [];
if(isset($_GET['logout'])){
    if(isset($_COOKIE['loggedin'])){
        setcookie("loggedin", "", time() - 3600);
    }else{
        session_destroy();
    }
    header("Location:./login.php");
    die();
}

if(isset($_SESSION['loggedin']) || isset($_COOKIE['loggedin'])){
?>
    <html>
        <head>
            <title>Document</title>
        </head>
        <body>
            <p>Hello welcomback to our website</p>
            <a href="login.php?logout=true">log out</a>
        </body>
    </html>
<?php
    die();
}

if(isset($_POST['login'])){
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $remember = isset($_POST['remember']) ? $_POST['remember'] : null;
    if(empty($username)){
        $errors[] = "Username is required";
    }
    if(empty($password)){
        $errors[] = "Password is required";
    }
    if(count($errors) == 0){
        $password_hash = sha1($password);
        $sql = "SELECT * FROM users WHERE  email = '$username' AND password_hash = '$password_hash'";
        $res = $conn->query($sql);
        if($res->num_rows > 0){
             echo "Login successfully";   
            if(isset($remember)){
                setcookie("loggedin", true, time() + 3600);
            }else{
                $_SESSION['loggedin'] = true;
            }
            die();
        }
        else{
            $errors[] = "Username or password is incorrect";
        }
    }
}

?>
<html>
    <head>
        <title>Document</title>
    </head>
    <body>
        <p>Login form</p>
        <form action="" method="post">
            <label for="email">Ehahahaah:</label> <input type="email" name="Email" id="email"><br>
            <label for="password">Password:</label> <input type="password" name="Password" id="password"><br>
            <input type="checkbox" value="remember" name="remember"> Remember me<br>
            <input type="submit" name="Login" value="Login">
            <ul>
                <?php
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                ?>
            </ul>
        </form>
    </body>
</html>