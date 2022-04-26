<?php
    include("../core.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<script>
    function myFunction(ID) {
        let text = "You are deleting: "+ID +"!\nEither OK or Cancel.";
        if (confirm(text) == true) {
            document.getElementById('form'+ID).submit();
        }
    }
</script>

<body>
    <h1>Projecten </h1>
    <a href="index.php">Overzicht van projecten</a>
    <br><br><br>
    <form action="crud.php" method="POST">
        Vragen toevoegen: <input type="text" name="questions"><br><br>
        <input type="hidden" name="type" value="questionAdd">
        <input type="submit" name="submit" value="Toevoegen">
    </form>
    <br><br><br>
    <?php
        $liqry = $conn->prepare("SELECT id, questions FROM standardQuestions");
        $liqry->bind_result($id, $questions);
        $liqry->execute();
        $liqry->store_result();
        echo    '<table border=1>
                    <tr>
                    <td>id</td>
                    <td>questions </td>
                    <td>edit </td>
                    <td>delete</td>
                </tr>';
        while ($liqry->fetch()) {
            echo"<tr>
                    <td>$id</td>
                    <td>$questions</td>
                    <td><a href='edit.php?type=question&id=$id'>edit</a><br></td>
                    <td>
                        <form action='crud.php' method='post' id='form$id'>
                            <input type='hidden' name='id' value='$id'>
                            <input type='hidden' name='type' value='questionDelete'>
                        </form>
                        <a onclick='myFunction($id)'>delete</a><br>
                    </td>
                <tr>";
        }
        $liqry->close();
    ?>
</body>

</html>