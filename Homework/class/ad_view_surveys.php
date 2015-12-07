<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey
include('./db_connect.php');


session_start();
//
$page_title = "Home";
$user = "ADMIN";

include("./admin_header.php");

//Put the inside of the #container tag in the following thingy
echo "";
include("./footer.php");
?>