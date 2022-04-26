<?php
include('./core.php');
?>

<h1>Delete help</h1>
    <form action="function.php" method="POST">

        <h2 style="color: red">Are you sure you want to delete this product?</h2>
        <?php
            $id = $_GET['id'];
            $liqry = $conn->prepare("SELECT id, uid, title, category, location, info, who FROM request WHERE id = ?;");
            $liqry->bind_param('i', $id);
            $liqry->execute();
            $liqry->bind_result($cid, $name, $title, $category, $location, $info, $who);
            $liqry->store_result();
            $liqry->fetch();
            if ($liqry->num_rows == '1') {
                echo "ID: $cid <br>;
                 <input type='hidden' name='id' value='$cid' />
                 Naam: $name <br>
                 Title: $title <br>
                 Categorie: $category <br>
                 Locatie: $location <br>
                 informatie: $info <br>
                 wie heeft geholpen?: $who <br>";
            }
            
            $liqry->close();
        ?>
        <br>
        <input type="hidden" name="typeFunction" value="solved">
        <input type="submit" name="submit" value="Yes, delete!">
        <a href="index.php">Go back</a>
    </form>