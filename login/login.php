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
                            session_start();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/2cc335b51d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/fontawesome.min.css">
    <script src="assets/script/star.js"></script>
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
        <div id="stars"></div>
        <div class="d-flex justify-content-center ">
            <div id="wrapper">
                <div class="center">
                    <h1>Log in</h1>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" name="username" id="username" placeholder="Gebruikersnaam" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Wachtwoord" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="submit" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                    <a id="a" href="">
                        <p>Forgot password?</p>
                    </a>
                </div>
                <div id="wrapper2">
                    <div class="center">
                        <p><a id="a2" href="register.php">Geen account? Registreer je dan.</a></p>
                    </div>
                </div><br>
                <script src="../assets/script/script.js"></script>
            </div>

        </div>

        </body>

</html>