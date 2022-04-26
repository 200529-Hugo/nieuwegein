<?php
include('./core.php');
?>

<h1>project toevoegen</h1>

<form action="function.php" method="POST">
    title: <input type="text" name="title"><br><br>
    category: <input type="text" name="category"><br><br>
    location: <input type="text" name="location"><br><br>
    info: <input type="text" name="info"><br><br>
    <input type="hidden" name="typeFunction" value="askHelp">
    <input type="submit" name="submit" value="Toevoegen">
</form>