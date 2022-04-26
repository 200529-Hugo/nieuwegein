<?php
include("../core.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_register.css">
    <script src="https://kit.fontawesome.com/2cc335b51d.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if (isset($_POST['category']) && $_POST['category'] != "") {
        $helper = $con->real_escape_string($_POST['helper']);
        $name = $con->real_escape_string($_POST['name']);
        $category = $con->real_escape_string($_POST['category']);
        $email = $con->real_escape_string($_POST['email']);
        $number = $con->real_escape_string($_POST['number']);

        $liqry = $con->prepare("INSERT INTO `user` (`helper`, `name`,`category`, `email`, `number` ) VALUES (?, ?, ?, ?, ?);");
        if ($liqry === false) {
            echo mysqli_error($con);
            echo "lukt nie";
        } else {
            $liqry->bind_param('ssssi', $helper, $name, $category, $email, $number);
            if ($liqry->execute()) {
                header('Location:../index.php');
            } else {
                echo mysqli_error($con);
                echo "lukt niet";
            }
        }
        $liqry->close();
    }
    ?>
    <div id="container">
        <div class="d-flex justify-content-center ">
            <div id="wrapper">
                <div class="midden">
                    <figure id="logo">
                        <img src="../assets/img/robot uil.png" alt="logo">
                    </figure>
                    <p>Account gegevens toevoegen</p>
                    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
                        <div class="form-group none">
                            <input type="name" name="helper" placeholder="helper" class="form-control" value="<?php echo $helper ?>">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <div id="tekst">Birthday</div>
                            <input type="date" name="category" placeholder="category" required class="form-control" value="">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="email" required class="form-control" value="">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <input type="number" name="number" placeholder="phone number" required class="form-control" value="">
                            <span class="invalid-feedback"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary padding2" value="Volgende"><br><br>
                            <!-- <a href="register.php">Ga terug</a> -->
                        </div>
                    </form>
                </div>
                <div id="wrapper2">

                </div><br>
            </div>
        </div>
    </div>
</body>

</html>