<?php 
    include('../core.php');
    $type = $_GET['type'];
?>

<form action="crud.php" method="POST">
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
    ?>
    <br>
    <input type="hidden" name="type" value="<?= $type ?>Edit">
    <input type="submit" name="submit" value="Opslaan">
</form>