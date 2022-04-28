<?php
include('core.php');
include("aside.php"); 
$myaccount =  htmlspecialchars($_SESSION["id"]);

if ($_GET['request'] == 'helping') {
    $request = 'wid';
    $titlePage = "Iedereen die jij helpt";
} else {
    $request = 'uid';
    $titlePage = "Alle cards die jij hebt aangemaakt";
}
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
    <div id="title"><?php echo $titlePage ?> </div><br>
    <div id="container">
        <div id="allCards">
            <?php
            $liqry = $conn->prepare("SELECT request.id, request.uid, request.wid, request.title,category.name, request.location, request.info FROM request INNER JOIN category ON category.id = request.category WHERE $request = '$myaccount' ");
            if ($liqry === false) {
                echo mysqli_error($conn);
            } else {
                $liqry->bind_result($id, $uid, $who, $title, $category, $location, $info);
                if ($liqry->execute()) {
                    $liqry->store_result();
                    while ($liqry->fetch()) {
                        echo "
        <div id='cards'>

            <figure id='image'>
                <img src='assets/img/blue.jpg' alt='logo'>
            </figure>
            <div id='nameCard'>${name}</div><br>
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
                $liqry->close();
            }
            ?>
        </div>
    </div>
</body>

</html>