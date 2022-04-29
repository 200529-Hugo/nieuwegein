<!DOCTYPE html>
<html lang="en">
<?php
include("../assets/database/core.php");

$sql2 = "SELECT id, name FROM category WHERE hidden = 0;";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$result = $stmt2->get_result();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    include('aside.php');

    ?>


    <div id="title">Hulp aanvragen</div><br>

    <form action="function.php" method="POST">
        <div id="blas">
            <input type="text" name="title" id="info" value="" placeholder="Onderwerp" required><br><br>
            <?php
                while ($categoryInfo = $result->fetch_assoc()) {
                    echo "<input class='checkbox chb' type='checkbox' id='${categoryInfo['id']}' name='category[]' value='${categoryInfo['id']}'>
                        <label for='${categoryInfo['name']}'>${categoryInfo['name']}</label>";
                }
            ?><br><br>
        </div>
        <input type="text" name="location" id="location" placeholder="locatie" required><br><br>

        <input type="text" name="info" id="information" placeholder="meer informatie over wat je nodig hebt." required><br><br>
        <input type="hidden" name="typeFunction" value="askHelp">
        <input type="submit" name="submit" id="submit" value="Toevoegen">
    </form>
</body>


</form>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="../assets/js/script.js"></script>
</html>