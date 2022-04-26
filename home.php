<?php include('./core.php'); ?>

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
    session_start();

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
    <?= "<a href='askHelp.php?name=$name'>Hulp nodig</a><br>" ?>
    <?= "<a href='yourQuestions.php?name=$name'>Kijken of je al geholpen word</a><br>" ?>
    <?= "<a href='yourHelpQuestions.php?name=$name'>Al de mensen die je helpt</a><br>" ?>

    <br>
    <br>
    Iedereen die hulp nodig heeft.
    <?php
        $liqry = $conn->prepare("SELECT id, title, category, location, info, who FROM request WHERE who = 'no one'");
        $liqry->bind_result($id, $title, $category, $location, $info, $who);
        if ($liqry->execute()) {
            $liqry->store_result();
            while ($liqry->fetch()) { echo "
                <div id='cards'>
                    ${id}<br>${name}<br>${title}<br>${category}<br>${location}<br>${info}<br>${who}<br>
                    <a href='offerHelp.php?messager=${name}&receiver=${name}&id=${id}'>ello</a>
                </div>";
            }
        }
        $liqry->close();
    ?>

</body>

</html>