<?php
$conn = mysqli_connect('localhost', 'root', '', 'nieuwegein');

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
