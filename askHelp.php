<!DOCTYPE html>
<html lang="en">
<?php
include('./core.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
    include('aside.php');

    ?>


    <div id="title">Hulp aanvragen</div><br>

    <form action="function.php" method="POST">
        <div id="blas">
            <input type="text" name="title" id="info" value="" placeholder="Onderwerp" required><br><br>
            <input type="text" name="category" id="info" placeholder="Categorie" value="" required><br><br>
        </div>
        <input type="text" name="location" id="location" value="locatie" required><br><br>

        <input type="text" name="info" id="information" placeholder="meer informatie over wat je nodig hebt." required><br><br>
        <input type="hidden" name="typeFunction" value="askHelp">
        <input type="submit" name="submit" id="submit" value="Toevoegen">
    </form>
</body>


</form>

</html>