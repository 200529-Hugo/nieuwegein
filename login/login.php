<?php
include("../core.php");
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../home.php");
    exit;
}

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $liqry = $conn->prepare("SELECT id, name, password FROM user WHERE name = ?");
        $liqry->bind_param("s", $param_username);
        $param_username = $username;
        $liqry->execute();
        $liqry->bind_result($id, $username, $hashed_password);
        $liqry->fetch();
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["name"] = $username;
            header("location: ../home.php");
        } else {
            $login_err = "Invalid username or password.";
        }
    }
}
?>

    <?php
    if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    if (!empty($username_err)) {
        echo '<div class="alert alert-danger">' . $username_err . '</div>';
    }
    if (!empty($password_err)) {
        echo '<div class="alert alert-danger">' . $password_err . '</div>';
    }
    ?>

    <h1>Log in</h1>
    <form action="" method="post">
                        
        <input type="text" name="username" placeholder="Gebruikersnaam"  value="<?php echo $username; ?>">
        <input type="password" name="password" placeholder="Wachtwoord" >
        <input type="submit" id="submit" class="btn btn-primary" value="Login">
                        
    </form>
    <a id="a" href="">
        <p>Forgot password?</p>
    </a>
    <a id="a2" href="register.php">Geen account? Registreer je dan.</a>