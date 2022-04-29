<?php
include("../core.php");

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
        $sql = "SELECT id, name, password FROM user WHERE name = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $username;

                            header("location: ../home.php");
                        } else {
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">

</head>

<main id="main">


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
    <div id="container">
        <div id="containerOverlay">
            <div id="center">
                <div id="wrapper">
                    <figure id="picture">
                        <img src="../assets/img/logo.svg" alt="logo">
                    </figure>
                    <div id="login">
                        <form action="" method="post">
                            <div class="fromInfo">Je naam</div>
                            <div class="form-group">
                                <input type="text" name="username" id="username" placeholder="" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            </div>
                            <div class="fromInfo">Wachtwoord</div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit" class="btn btn-primary" value="Inloggen">
                            </div>
                        </form>
                        <a href="">
                            <p>Forgot password?</p>
                        </a>
                    </div>
                    <div class="wrapper2">
                        <div class="center">
                            <p><a id="a2" href="register.php">Geen account? Registreer je dan.</a></p>
                        </div>
                    </div>
                    <div class="wrapper2">
                        <div class="center">
                            <p><a id="a2" href="register.php">Terug naar de home pagina</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>

</html>