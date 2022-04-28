<?php
include('core.php');
session_start();
$myaccount =  htmlspecialchars($_SESSION["id"]);

if($_GET['request'] == 'helping'){
    $request = 'wid';
} else{
    $request = 'uid';
}

$liqry = $conn->prepare("SELECT id, uid, wid, title, category, location, info FROM request WHERE $request = '$myaccount' ");
if ($liqry === false) {
    echo mysqli_error($conn);
} else {
    $liqry->bind_result($qid, $uid, $who, $title, $category, $location, $info);
    if ($liqry->execute()) {
        $liqry->store_result();
        while ($liqry->fetch()) {
?>
            <div id="cards">
                <?php echo $qid ?><br>
                <?php echo $uid ?><br>
                <?php echo $title ?><br>
                <?php echo $category ?><br>
                <?php echo $location ?><br>
                <?php echo $info ?><br>
                <?php echo $who ?><br>
                <td>
                    <?php 
                        echo '<a href="offerHelp.php?messager=' . $who . '&receiver=' . $uid . '&id=' . $qid . '">ello</a><br>'
                    ?>
                </td>
            </div>
<?php
        }
    }
    $liqry->close();
}
