<?php
include("../core.php");
?>

<h1>Register</h1>

<?php

    $sql2 = "SELECT id, name FROM category WHERE hidden = 0;";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result = $stmt2->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $bio        = $_POST['bio'];
    $category   = implode("-",$_POST['category']);
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

    name: <input type="text" name="name" value=""><br><br>
    bio: <input type="text" name="bio" value=""><br><br>
    Category: <br><br> 
    <?php
        while ($categoryInfo = $result->fetch_assoc()) {
            echo "<input type='checkbox' id='${categoryInfo['id']}' name='category[]' value='${categoryInfo['id']}'>
            <label for='${categoryInfo['id']}'>${categoryInfo['name']}</label>";
        }
    ?>
    <br><br>
    Helper: <br><br><input type="radio" name="helper" value="1">
    <label for="ja">Ja</label><br>
    <input type="radio" name="helper" value="0">
    <label for="nee">nee</label><br>
    password: <input type="password" name="password" value=""><br><br>
    number: <input type="number" name="number" value=""><br><br>
    email: <input type="text" name="email" value=""><br><br>
    <input type="submit" name="submit" value="Toevoegen">
</form>