<?php
include("../assets/database/core.php");
    $liqry = $conn->prepare("SELECT user.name, chat.message, chat.created FROM chat INNER JOIN user ON user.id = chat.mid WHERE chat.request = ? ORDER BY created");
    $liqry->bind_param('s', $_GET['id']);
    $liqry->bind_result($name,$message,$created);
    $liqry->execute();
    $liqry->store_result();
    while ($liqry->fetch()) {?>
        <div id="cards">
            <?= $name ?><br>
            <?= $message ?><br>
            <?= $created ?><br>
        </div>
        <br>
<?php
    }
    $liqry->close();
    ?>