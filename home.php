<?php
include('./core.php');
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
        include("aside.php");
    ?>

    <div id="title">Iedereen die hulp nodig heeft.</div><br>
    <div id="container">
        <div id="allCards">
            <?php
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                header("location: login/login.php");
                exit;
            }
            ?>
            <?php
            $seeCategory = $conn->prepare("SELECT category FROM user WHERE id = ?");
            $seeCategory->bind_param('s', $_SESSION["id"]);
            $seeCategory->bind_result($theCategory);
            $seeCategory->execute();
            $seeCategory->store_result();
            while ($seeCategory->fetch()) {
                $liqry = $conn->prepare("SELECT request.id, user.name, request.wid, request.title, category.name, request.location, request.info FROM request INNER JOIN user ON user.id = request.uid INNER JOIN category ON request.category = category.id WHERE wid = 0 AND uid != ? AND request.category IN (" . $theCategory . ");");
                $liqry->bind_param('s', $_SESSION["id"],);
                $liqry->bind_result($id, $uid, $who, $title, $category, $location, $info);
                if ($liqry->execute()) {
                    $liqry->store_result();
                    while ($liqry->fetch()) {
                        echo "
            <div id='cards'>
                
                <figure id='image'>
                    <img src='assets/img/blue.jpg' alt='logo'>
                </figure>
                <div id='nameCard'>${uid}</div><br>
                <div id='titleCard'>${title}</div>
                <div id='infoCard'>${info}</div><br>
                <div id='categoryCard'>${category}</div>
                <div id='locationCard'>${location}</div>
                <br>
                <a href='offerHelp.php?receiver=${uid}&id=${id}'>ello</a>
            </div>";
                        "</br>";
                    }
                }
            }
            $liqry->close();
            $seeCategory->close();
            ?>

</body>

</html>