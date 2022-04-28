<?php 
include('./core.php');
session_start();

$typeFunction = $_POST['typeFunction'];

if ($typeFunction == "messageSendTxt") {
    $id = $_POST['id'];
    $message = $_POST['message'];
    $messager = $_POST['mid'];
    $receiver = $_POST['rid'];

    $liqry = $conn->prepare("INSERT INTO `chat` (`request`,`message`, `mid`, `rid` ) VALUES (?, ?, ?, ?);");
    $liqry->bind_param('ssss',$id, $message, $messager, $receiver);  
    $liqry->execute();
    $liqry->close();    
    header("Location: ./offerHelp.php?messager=$messager&receiver=$receiver&id=$id");
    die();
}

if ($typeFunction == "messageSendQuick") {
    $id = $_POST['id'];
    $message = $_POST['message'];
    $messager = $_POST['mid'];
    $receiver = $_POST['rid'];

    $liqry = $conn->prepare("INSERT INTO `chat` (`request`,`message`, `mid`, `rid` ) VALUES (?,?, ?, ?);");
    $liqry->bind_param('ssss',$id, $message, $messager, $receiver);
    $liqry->execute();
    $liqry->close();
    header("Location: ./offerHelp.php?messager=$messager&receiver=$receiver&id=$id");
    die();
}

if($typeFunction == "askHelp"){
    $uid = $_SESSION['id'];
    $title = $_POST['title'];
    $category = $_POST['category'][0];
    $location = $_POST['location'];
    $info = $_POST['info'];
    $wid = 0;
    $created = date("Y/m/d");
    $liqry = $conn->prepare("INSERT INTO `request` (`uid`, `wid`, `title`, `category`, `location`, `info`, hidden, created ) VALUES (?, ?, ?, ?, ?, ?, 0, ?);");
    $liqry->bind_param('sssssss', $uid, $wid, $title, $category, $location, $info, $created);
    $liqry->execute();
    $liqry->close();
    header('Location: ./home.php');
    die();
}

if($typeFunction == "noHelp"){
    $liqry = $conn->prepare("UPDATE request SET wid = 0 WHERE id = ?;");
    $liqry->bind_param('i', $_POST['id']);
    $liqry->execute();
    $liqry->close();
    $liqry = $conn->prepare("DELETE FROM chat WHERE request = ?;");
    $liqry->bind_param('i',$_POST['id']);
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
    $liqry = $conn->prepare("DELETE FROM chat WHERE request = ?;");
    $liqry->bind_param('i',$id);
    $liqry->execute();
    $liqry->close();
    header('Location: ./home.php');
    die();
}