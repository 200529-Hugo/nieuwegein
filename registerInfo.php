<?php
    include("./assets/database/core.php");

    if (isset($_POST['category']) && $_POST['category'] != "") {
        $helper = $_POST['helper'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $email = $_POST['email'];
        $number = $_POST['number'];

        $liqry = $conn->prepare("INSERT INTO `user` (`helper`, `name`,`category`, `email`, `number` ) VALUES (?, ?, ?, ?, ?);");
        $liqry->bind_param('ssssi', $helper, $name, $category, $email, $number);
        $liqry->execute();
        header('Location:../index.php');
        $liqry->close();
    }
    ?>
    <p>Account gegevens toevoegen</p>
    <form action="" method="post">    
        <input type="text" name="helper" placeholder="helper"><br>
        <input type="date" name="category" placeholder="category" required><br>
        <input type="email" name="email" placeholder="email" required ><br>
        <input type="number" name="number" placeholder="phone number" required><br>
        <br>
        <input type="submit" class="btn btn-primary padding2" value="Volgende"><br><br>
    </form>