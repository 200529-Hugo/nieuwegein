<?php
include("../core.php");
?>
<link rel="stylesheet" href="../assets/css/login.css">

<?php

$sql2 = "SELECT id, name FROM category WHERE hidden = 0;";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$result = $stmt2->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $bio        = $_POST['bio'];
    $category   = implode(",", $_POST['category']);
    $helper     = $_POST['helper'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $number     = $_POST['number'];
    $email      = $_POST['email'];

    $liqry = $conn->prepare("INSERT INTO `user` (`name`, `bio`, `category`, `helper`, `password`, `number`, `email` ) VALUES (?, ?, ?, ?, ?, ?,?);");
    $liqry->bind_param('sssssis', $name, $bio, $category, $helper, $password, $number, $email);
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
                        <img src="../assets/img/logo.svg" alt="logo">
                    </figure>
                    <div id="login">
                        name: <input type="text" name="name" value="" required>
                        bio: <input type="text" name="bio" value="" required>
                        Category: <br><br>
                        <?php
                        while ($categoryInfo = $result->fetch_assoc()) {
                            echo "<input class='checkbox' type='checkbox' id='${categoryInfo['id']}' name='category[]' value='${categoryInfo['id']}'>
            <label for='${categoryInfo['name']}'>${categoryInfo['name']}</label>";
                        }
                        ?>
                        Helper: <br><br><input type="radio" name="helper" value="1" required>
                        <label for="ja">Ja</label>
                        <input type="radio" name="helper" value="0" required>
                        <label for="nee">nee</label>
                        <br>
                        password: <input type="password" name="password" value="" required>
                        number: <input type="number" name="number" value="" required>
                        email: <input type="email" name="email" value="" required>
                        location: <input type="text" name="location" value="" required>
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