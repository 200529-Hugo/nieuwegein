<?php
include('assets/database/config.php');
$myaccount = $con->real_escape_string($_GET['name']);

$liqry = $con->prepare("SELECT id, name, title, category, location, info, who FROM request WHERE name = '$myaccount' ");
if ($liqry === false) {
    echo mysqli_error($con);
} else {
    $liqry->bind_result($id, $name, $title, $category, $location, $info, $who);
    if ($liqry->execute()) {
        $liqry->store_result();
        while ($liqry->fetch()) {
?>
            <div id="cards">
                <?php echo $id ?><br>
                <?php echo $name ?><br>
                <?php echo $title ?><br>
                <?php echo $category ?><br>
                <?php echo $location ?><br>
                <?php echo $info ?><br>
                <?php echo $who ?><br>
                <td><?php //echo '<a href="offerHelp.php?messager=' . htmlspecialchars($_SESSION["name"]) . '&receiver=' . $name . '&id=' . $id . '">ello</a><br>' 
                    ?>
                </td>
                <td><?php echo '<a href="seeHelper.php?messager=' . $myaccount . '&receiver=' . $who . '&id=' . $id . '">ello</a><br>'
                    ?></td>
            </div>
<?php
        }
    }
    $liqry->close();
}
