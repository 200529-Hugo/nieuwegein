<?php 
    include('../core.php');
    $type = $_POST['type'];

    $categoryLocation = 'Location:category.php';
    $questionLocation = 'Location:question.php';
    
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
        header($categoryLocation);
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
        header($categoryLocation);
    }

    if($type == 'categoryDelete'){
        $id = $_POST['cid'];
        $liqry = $conn->prepare("DELETE FROM `category` WHERE `id` = ?;");
        $liqry->bind_param('s',$id);
        $liqry->execute();
        header($categoryLocation);
    }

    if($type == 'questionAdd'){
        $questions = $_POST['questions'];
        $liqry = $conn->prepare("INSERT INTO `standardQuestions` (`questions` ) VALUES (?);");
        $liqry->bind_param('s', $questions);
        $liqry->execute();
        $liqry->close();
        header($questionLocation);
    }

    if($type == 'questionEdit'){
        $id = $_POST['id'];
        $questions = $_POST['questions'];
        $liqry = $conn->prepare("UPDATE standardQuestions SET questions = ? WHERE id = ? LIMIT 1;");
        $liqry->bind_param('si', $questions, $id);
        $liqry->execute();
        $liqry->close();
        header($questionLocation);
    }

    if($type == 'questionDelete'){
        $id = $_POST['id'];
        $liqry = $conn->prepare("DELETE FROM standardQuestions WHERE id = ?;");
        $liqry->bind_param('i', $id);
        $liqry->execute();
        $liqry->close();
        header($questionLocation);
    
    }