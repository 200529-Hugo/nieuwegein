<?php
include('./core.php');

$id = $_GET['id'];
$messager = $_SESSION["id"];
$receiver = $_GET['receiver'];


$query1 = $conn->prepare("UPDATE request SET wid = ? WHERE id = ? AND wid = 0 AND uid != ?;");
$query1->bind_param('sis', $messager, $id, $messager);
$query1->execute();
$query1->close();
?>
<head>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            setInterval(function(){
                $("#autodata").load("autoChat.php?id=<?= $_GET['id']; ?>");
            }, 100);
        })
    </script>
</head>
<body onload='scrollDown()'>
<?php 
    include("aside.php");
?>
<div id="title">Iedereen die hulp nodig heeft.</div><br>
<div id="container">
<form action="function.php" method="POST">
    message<input type="text" name="message" value="">
    <input type="hidden" name="mid" value="<?= $messager ?>">
    <input type="hidden" name="rid" value="<?= $receiver ?>">
    <input type="hidden" name="id" value="<?= $id ?>">
    <br><br>
    <input type="hidden" name="typeFunction" value="messageSendTxt">
    <input type="submit" name="submit" value="Toevoegen">
</form>

<?php
    $liqry = $conn->prepare("SELECT questions FROM standardQuestions");
    $liqry->bind_result($questions);
    $liqry->execute();
    $liqry->store_result();
?>
    <form action="function.php" method="POST">
        <?php
            while ($liqry->fetch()) {
                echo "<label for='message'>
                            <input class='chb' type='checkbox' name='message' value='$questions'>$questions
                        </label>";
            }
            $liqry->close();
        ?>
        <input type="hidden" name="mid" value="<?= $messager ?>">
        <input type="hidden" name="rid" value="<?= $receiver ?>">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="typeFunction" value="messageSendQuick">
        <input type="submit" name="submit" value="Opslaan">
    </form>

    <!-- alles op het scherm krijgen -->
    <div id="autodata" onload='scrollDown()'></div>
<?php 
    echo '<a href="notEnoughHelp.php?id=' . $id . '">Mijn helper kan me niet genoeg helpen</a><br>';
    echo '<a href="solved.php?id=' . $id . '">Mijn probleem is opgelost</a><br>';
?>
        
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="./assets/js/script.js"></script>
</body>