<?php
include('./core.php');
    $liqry = $conn->prepare("SELECT * FROM chat WHERE request = ? ORDER BY created  ");
    $liqry->bind_param('s', $_GET['id']);
    $liqry->bind_result($cid,$req,$rid,$mid,$message,$created);
    $liqry->execute();
    $liqry->store_result();
    while ($liqry->fetch()) {?>
        <div id="cards">
            <?= $mid ?><br>
            <?= $message ?><br>
            <?= $created ?><br>
        </div>
        <br>
<?php
    }
    $liqry->close();
    ?>