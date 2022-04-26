<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "nieuwegein";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

define("BASEURL", "http://localhost/Periode7/Bureau/CMS/");
define("BASEURL_CMS", "http://localhost/Periode8/Bureau/CMS/");
$portfolioUrl = $_SERVER['DOCUMENT_ROOT'] . "http://localhost/Periode7/Bureau/CMS/";
//   echo $portfolioUrl;

function prettyDump($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}
