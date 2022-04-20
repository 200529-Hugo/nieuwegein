<?php 
    require('config.php');
    $type = $_POST['type'];

    if($type == 'categoryAdd'){
        $name = $_POST['name'];
        $info = $_POST['info'];
        if(empty($_POST['hidden'])){
            $hidden = '0';
        } else{
            $hidden = '1';
        }
        $liqry = $conn->prepare("INSERT INTO `category`(`name`, `info`,`hidden`) VALUES (?,?,?);");
        $liqry->bind_param('sss',$name,$info,$hidden);
        $liqry->execute();
        header('Location: index.php');
    }

    if($type == 'categoryEdit'){
        $id = $_POST['cid'];
        $name = $_POST['name'];
        $info = $_POST['info'];
        if(empty($_POST['hidden'])){
            $hidden = '0';
        } else{
            $hidden = '1';
        }
        $liqry = $conn->prepare("UPDATE `category` SET `name` = ?, `info` = ?, `hidden` = ? WHERE `id` = ?;");
        $liqry->bind_param('ssss',$name,$info,$hidden,$id);
        $liqry->execute();
        header('Location: index.php');
    }

    if($type == 'categoryDelete'){
        $id = $_POST['cid'];
        $liqry = $conn->prepare("DELETE FROM `category` WHERE `id` = ?;");
        $liqry->bind_param('s',$id);
        $liqry->execute();
        header('Location: index.php');
    }