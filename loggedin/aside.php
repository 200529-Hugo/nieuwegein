<?php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}
$name = htmlspecialchars($_SESSION["name"]);
?>
<aside>
    <figure id="logo">
        <img src="../assets/img/download.png" alt="logo">
    </figure>
    <h1><?= $name ?></h1>
    <p>
        <br>
        <a href="home.php">Home</a><br>
        <a href='askHelp.php'>Hulp nodig</a><br>
        <a href='see.php?request=searching'>Kijken of je al geholpen word</a><br>
        <a href='see.php?request=helping'>Al de mensen die je helpt</a><br>

        <a href="../reset-password.php">Reset Your Password</a><br><br>
        <a id="signOut" href="../logout.php">Sign Out of Your Account</a>
    </p>
</aside>