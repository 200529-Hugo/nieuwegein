<?php
    include("../assets/database/core.php");
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
    <form action="crud.php" method="post" style="border: 1px solid black;" enctype="multipart/form-data">
        <h1>Category add</h1>
        <b>Naam:</b>
        <input type="text" name="name">
        <br>
        <b>Informatie:</b>
        <textarea name="info"></textarea>
        <br>
        <p>Symbol</p>
        <input type="file" name="fileToUpload" required>
        <br>
        <b>Verstopt:</b>
        <input type="checkbox" name="hidden" value="1">
        <br>
        <input type="hidden" name="type" value="categoryAdd">
        <button type="submit"></button>
    </form>
    <br>
    <?php
        $liqry = $conn->prepare("SELECT id, name, info, img, hidden FROM category;");
        $liqry->bind_result($id, $name, $info, $img, $hidden);
        $liqry->execute();
        $liqry->store_result();
        echo    '<table border=1>
                    <tr>
                    <td>id</td>
                    <td>Name </td>
                    <td>Info </td>
                    <td>Image </td>
                    <td>hidden </td>
                    <td>edit </td>
                    <td>delete</td>
                </tr>';
        while ($liqry->fetch()) {
            echo"<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$info</td>
                    <td>$img</td>
                    <td><input type='checkbox' ";
                    if ($hidden == true) {
                        echo "checked ";
                    }
                    echo "disabled></td>
                    <td><a href='edit.php?type=category&id=$id'>edit</a><br></td>
                    <td>
                        <form action='crud.php' method='post' id='form$id'>
                            <input type='hidden' name='file' value='$img'>
                            <input type='hidden' name='id' value='$id'>
                            <input type='hidden' name='type' value='categoryDelete'>
                        </form>
                        <a onclick='myFunction($id)'>delete</a><br>
                    </td>
                <tr>";
        }
        $liqry->close();
    ?>
</body>
</html>