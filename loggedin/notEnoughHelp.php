<?php
include("../assets/database/core.php");
$id = $_GET['id'];
?>

<h1>Andere helper nodig</h1>

<form action="function.php" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="hidden" name="typeFunction" value="noHelp">
    <input type="submit" name="submit" value="Opslaan">
</form>