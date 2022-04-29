<?php 
    include("../assets/database/core.php");
    $type = $_POST['type'];

    $categoryLocation = 'Location:category.php';
    $questionLocation = 'Location:question.php';
    $locationLocation = 'Location:location.php';
    $categoryURL = $_SERVER['DOCUMENT_ROOT'] . "/nieuwegein-master/assets/img/category/";
    
    if($type == 'categoryAdd'){
        $name = $_POST['name'];
        $info = $_POST['info'];
        if(empty($_POST['hidden'])){
            $hidden = '0';
        } else{
            $hidden = '1';
        }
        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $categoryURL . $newfilename);
        $liqry = $conn->prepare("INSERT INTO `category`(`name`, `info`,`hidden`,`img`) VALUES (?,?,?,?);");
        $liqry->bind_param('ssss',$name,$info,$hidden,$newfilename);
        $liqry->execute();
        header($categoryLocation);
    }

    if($type == 'categoryEdit'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $info = $_POST['info'];
        $file = $_POST['file'];
        if(empty($_POST['hidden'])){
            $hidden = '0';
        } else{
            $hidden = '1';
        }
        unlink($categoryURL.$file);
        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $categoryURL . $newfilename);
        $liqry = $conn->prepare("UPDATE `category` SET `name` = ?, `info` = ?, `hidden` = ?, img = ? WHERE `id` = ?;");
        $liqry->bind_param('sssss',$name,$info,$hidden,$newfilename,$id);
        $liqry->execute();
        header($categoryLocation);
    }

    if($type == 'categoryDelete'){
        $id = $_POST['id'];
        $file = $_POST['file'];
        unlink($categoryURL.$file);
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

    if($type == 'locationAdd'){
        $name = $_POST['name'];
        if(empty($_POST['hidden'])){
            $hidden = '0';
        } else{
            $hidden = '1';
        }
        $liqry = $conn->prepare("INSERT INTO `location`(`name`, `hidden`) VALUES (?,?);");
        $liqry->bind_param('ss',$name,$hidden);
        $liqry->execute();
        header($locationLocation);
    }

    if($type == 'locationEdit'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        if(empty($_POST['hidden'])){
            $hidden = '0';
        } else{
            $hidden = '1';
        }
        
        $liqry = $conn->prepare("UPDATE `location` SET `name` = ?, `hidden` = ? WHERE `id` = ?;");
        $liqry->bind_param('sss',$name,$hidden,$id);
        $liqry->execute();
        header($locationLocation);
    }

    if($type == 'locationDelete'){
        $id = $_POST['id'];
        $liqry = $conn->prepare("DELETE FROM `location` WHERE `id` = ?;");
        $liqry->bind_param('s',$id);
        $liqry->execute();
        header($locationLocation);
    }