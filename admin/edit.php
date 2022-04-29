<?php 
    include("../assets/database/core.php");
    $type = $_GET['type'];
?>

<form action="crud.php" method="POST"  enctype="multipart/form-data">
    <?php
        if($type == "question"){
            $id = $_GET['id'];
            $liqry = $conn->prepare("SELECT id, questions FROM standardQuestions WHERE id = ?;");
            $liqry->bind_param('i', $id);
            $liqry->execute();
            $liqry->bind_result($qid, $questions);
            while ($liqry->fetch()) {
                echo "ID: <input readonly type='number' name='id' value='$qid'><br>";
                echo "Question: <input type='text' name='questions' value='$questions'><br>";
            }
            $liqry->close();
        }
        if($type == "category"){
            $id = $_GET['id'];
            $liqry = $conn->prepare("SELECT id, name, info, hidden, img FROM category WHERE id = ?;");
            $liqry->bind_param('i', $id);
            $liqry->execute();
            $liqry->bind_result($qid, $name, $info, $hidden, $img);
            while ($liqry->fetch()) {
                echo "ID: <input readonly type='number' name='id' value='$qid'><br>";
                echo "Name: <input type='text' name='name' value='$name'><br>";
                echo "Info: <textarea name='info'>$info</textarea><br>";
                echo "Symbol: <input type='file' name='fileToUpload' required>";
                echo "<input name='hidden' type='checkbox' ";
                    if ($hidden == true) {
                        echo "checked";
                    }
                echo "><input type='hidden' name='file' value='$img'>";
            }
            $liqry->close();
        }
        if($type == "location"){
            $id = $_GET['id'];
            $liqry = $conn->prepare("SELECT id, name, hidden FROM location WHERE id = ?;");
            $liqry->bind_param('i', $id);
            $liqry->execute();
            $liqry->bind_result($qid, $name, $hidden);
            while ($liqry->fetch()) {
                echo "ID: <input readonly type='number' name='id' value='$qid'><br>";
                echo "Name: <input type='text' name='name' value='$name'><br>";
                echo "<input name='hidden' type='checkbox' ";
                if ($hidden == true) {
                    echo "checked";
                }
                echo '>';
            }
            $liqry->close();
        }
    ?>
    <br>
    <input type="hidden" name="type" value="<?= $type ?>Edit">
    <input type="submit" name="submit" value="Opslaan">
</form>