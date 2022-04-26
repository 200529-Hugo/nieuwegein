<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
    include('../core.php');

    $sql = "SELECT * FROM category;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();

    $sql2 = "SELECT id, name FROM category;";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result = $stmt2->get_result();

    $sql3 = "SELECT id, name FROM category;";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
    $result2 = $stmt3->get_result();
?>

<body>
    <form action="crud.php" method="post" style="border: 1px solid black;">
        <h1>Category add</h1>
        <b>Naam:</b>
        <input type="text" name="name">
        <br>
        <b>Informatie:</b>
        <textarea name="info"></textarea>
        <br>
        <b>Verstopt:</b>
        <input type="checkbox" name="hidden" value="1">
        <br>
        <input type="hidden" name="type" value="categoryAdd">
        <button type="submit"></button>
    </form>
    <br>
    <div style="border: 1px solid black;">
        <h1>Categories</h1>
        <?php 
            while ($info = $results->fetch_assoc()) {
                echo $info['id'] . ' ' . $info['name'] . ' ' . $info['info'] .  ' ' . substr($info['hidden'],0,50).'<br>';
            }
        ?>
    </div>
    <br>
    <form action="crud.php" method="post" style="border: 1px solid black;">
        <h1>Category edit</h1>
        <b>Category</b>
        <select name="cid">
            <?php 
                while ($categoryInfo = $result->fetch_assoc()) {
                    echo "<option value='${categoryInfo['id']}'>${categoryInfo['name']}</option>";
                }
            ?>
        </select>
        <br>
        <b>Naam:</b>
        <input type="text" name="name">
        <br>
        <b>Informatie:</b>
        <textarea name="info"></textarea>
        <br>
        <b>Verstopt:</b>
        <input type="checkbox" name="hidden" value="1">
        <br>
        <input type="hidden" name="type" value="categoryEdit">
        <button type="submit"></button>
    </form>
    <br>
    <form action="crud.php" method="post" style="border: 1px solid black;">
        <h1>Category delete</h1>
        <b>Category</b>
        <select name="cid">
            <?php 
                while ($deleteInfo = $result2->fetch_assoc()) {
                    echo "<option value='${deleteInfo['id']}'>${deleteInfo['name']}</option>";
                }
            ?>
        </select>
        <br>
        <input type="hidden" name="type" value="categoryDelete">
        <button type="submit"></button>
    </form>
</body>
</html>