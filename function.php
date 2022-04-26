<?php 
include('./core.php');
session_start();

$typeFunction = $_POST['typeFunction'];

if ($typeFunction == "messageSendTxt") {
    $id = $_POST['id'];
    $message = $_POST['message'];
    $messager = $_POST['messager'];
    $receiver = $_POST['receiver'];

    $liqry = $conn->prepare("INSERT INTO `chat` (`message`, `messager`, `receiver` ) VALUES (?, ?, ?);");
    $liqry->bind_param('sss', $message, $messager, $receiver);  
    $liqry->execute();
    $liqry->close();    
    header("Location: ./offerHelp.php?messager=$messager&receiver=$receiver&id=$id");
    die();
}

if ($typeFunction == "messageSendQuick") {
    $id = $_POST['id'];
    $message = $_POST['message'];
    $messager = $_POST['messager'];
    $receiver = $_POST['receiver'];

    $liqry = $conn->prepare("INSERT INTO `chat` (`message`, `messager`, `receiver` ) VALUES (?, ?, ?);");
    $liqry->bind_param('sss', $message, $messager, $receiver);
    $liqry->execute();
    $liqry->close();
    header("Location: ./offerHelp.php?messager=$messager&receiver=$receiver&id=$id");
    die();
}

if($typeFunction == "askHelp"){
    $uid = $_SESSION['id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $info = $_POST['info'];
    $who = "no one";
    $created = date("Y/m/d");
    $liqry = $conn->prepare("INSERT INTO `request` (`uid`, `title`, `category`, `location`, `info`, `who`, hidden, created ) VALUES (?, ?, ?, ?, ?, ?, 0, ?);");
    $liqry->bind_param('sssssss', $uid, $title, $category, $location, $info, $who, $created);
    $liqry->execute();
    $liqry->close();
    header('Location: ./home.php');
    die();
}

if($typeFunction == "noHelp"){
    $liqry = $conn->prepare("UPDATE request SET who = ? WHERE id = ? LIMIT 1;");
    $liqry->bind_param('si', $who, $id);
    $liqry->execute();
    $liqry->close();
    header('Location: ./home.php');
    die();
}

if($typeFunction == "solved"){
    $id = $_POST['id'];
    $liqry = $conn->prepare("DELETE FROM request WHERE id = ?;");
    $liqry->bind_param('i',$id);
    $liqry->execute();
    $liqry->close();
}