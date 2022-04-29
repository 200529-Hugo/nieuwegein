<?php
include("./assets/database/core.php");
?>
<link rel="stylesheet" href="./assets/css/login.css">

<?php

$sql = $conn->prepare("SELECT id, name FROM category WHERE hidden = 0;");;
$sql ->execute();
$result = $sql->get_result();

$sql2 = $conn->prepare("SELECT id, name FROM location WHERE hidden = 0;");;
$sql2 ->execute();
$result2 = $sql2->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $bio        = $_POST['bio'];
    $category   = implode(",", $_POST['category']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $number     = $_POST['number'];
    $email      = $_POST['email'];

    $liqry = $conn->prepare("INSERT INTO `user` (`name`, `category`, `password`, `number`, `email` ) VALUES (?, ?, ?, ?, ?);");
    $liqry->bind_param('sssis', $name, $category, $password, $number, $email);
    if ($liqry->execute()) {
        header('Location:login.php');
    }
    $liqry->close();
}
?>
<form action="" method="POST">
    <div id="container">
        <div id="containerOverlay">
            <div id="center">
                <div id="wrapper">
                    <figure id="picture">
                        <img src="./assets/img/logo.svg" alt="logo">
                    </figure>
                    <div id="login">
                        name: <input type="text" name="name" value="" required>
                        Category: <br><br>
                        <?php
                        while ($categoryInfo = $result->fetch_assoc()) {
                            echo "<input class='checkbox' type='checkbox' id='${categoryInfo['id']}' name='category[]' value='${categoryInfo['id']}'>
            <label for='${categoryInfo['name']}'>${categoryInfo['name']}</label>";
                        }
                        ?>
                        <br>
                        password: <input type="password" name="password" value="" required>
                        number: <input type="number" name="number" value="" required>
                        email: <input type="email" name="email" value="" required>
                        location:  <br>
                        <?php while ($locationInfo = $result2->fetch_assoc()) {
                                echo "<input class='checkbox chb2' type='checkbox' id='${locationInfo['id']}' name='location[]' value='${locationInfo['id']}'>
                                <label for='${locationInfo['name']}'>${locationInfo['name']}</label><br>";
                            } 
                        ?>
                        <input type="submit" name="submit" value="Toevoegen">
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
</form>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="./assets/js/script.js"></script>