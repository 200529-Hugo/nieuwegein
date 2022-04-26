<?php
include('./core.php');


$id = $_GET['id'];
$messager = $_GET['messager'];
$receiver = $_GET['receiver'];


$query1 = $conn->prepare("UPDATE request SET who = ? WHERE id = ?;");

$query1->bind_param('si', $messager, $id);
$query1->execute();
$query1->close();
?>
<head>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<form action="function.php" method="POST">
    message<input type="text" name="message" value="">
    <input type="hidden" name="messager" value="<?= $messager ?>">
    <input type="hidden" name="receiver" value="<?= $receiver ?>">
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
        <input type="hidden" name="messager" value="<?= $messager ?>">
        <input type="hidden" name="receiver" value="<?= $receiver ?>">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="typeFunction" value="messageSendQuick">
        <input type="submit" name="submit" value="Opslaan">
        </form>

    <!-- alles op het scherm krijgen -->
<?php
    $liqry = $conn->prepare("SELECT * FROM chat WHERE (messager = ? AND receiver = ?) OR (messager = ? AND receiver = ?) ORDER BY created  ");
    $liqry->bind_param('ssss', $messager, $receiver ,$messager, $receiver);
    $liqry->bind_result($cid,$rid,$message, $messager, $receiver, $created);
    $liqry->execute();
    $liqry->store_result();
    while ($liqry->fetch()) {?>
        <div id="cards">
            <?= $messager ?><br>
            <?= $message ?><br>
            <?= $created ?><br>
            <br><br>
        </div>
<?php
    }
    $liqry->close();
    echo '<a href="notEnoughHelp.php?id=' . $id . '">Mijn helper kan me niet genoeg helpen</a><br>';
    echo '<a href="solved.php?id=' . $id . '">Mijn probleem is opgelost</a><br>';
?>
        
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="./assets/js/script.js"></script>
</body>