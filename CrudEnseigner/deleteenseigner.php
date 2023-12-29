<?php


 
if(!isset($_GET['identifiant']))
    {
        $identifiant=$_GET['identifiant'];

        /*declaration des variable php avec  la connect  a la base de donnee*/
$servername="localhost";
$username="root";
$password="Benoit@2001";
$databasename="PHPPROJECT";

$connection = new mysqli($servername, $username, $password, $databasename);

$sql="DELETE FROM departement WHERE ID_DEPARTEMENT=$identifiant";


    }
    header("location:/PHPPROJECT/index.php");
    exit;
?>