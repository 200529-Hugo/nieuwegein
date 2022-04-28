<?php 
    include('./core.php'); 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<body>
    <?php
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
    $name = htmlspecialchars($_SESSION["name"]);
    ?>
    <h1>Hi, <b> <?= $name ?></b>. Welcome to our site.</h1>
    <p>
        <a href="login/reset-password.php">Reset Your Password</a>
        <a href="login/logout.php">Sign Out of Your Account</a>
    </p>
    <?= "<a href='askHelp.php'>Hulp nodig</a><br>" ?>
    <?= "<a href='see.php?request=searching'>Kijken of je al geholpen word</a><br>" ?>
    <?= "<a href='see.php?request=helping'>Al de mensen die je helpt</a><br>" ?>

    <br>
    <br>
    Iedereen die hulp nodig heeft.
    <?php
        $liqry = $conn->prepare("SELECT id, uid, wid, title, category, location, info FROM request WHERE wid = 0 AND uid != ?;");
        $liqry->bind_param('s', $_SESSION["id"]);
        $liqry->bind_result($id, $uid, $who, $title, $category, $location, $info);
        if ($liqry->execute()) {
            $liqry->store_result();
            while ($liqry->fetch()) { echo "
                <div id='cards'>
                    ${id}<br>${name}<br>${title}<br>${category}<br>${location}<br>${info}<br>${who}<br>
                    <a href='offerHelp.php?receiver=${uid}&id=${id}'>ello</a>
                </div>";
            }
        }
        $liqry->close();
    ?>

</body>

</html>