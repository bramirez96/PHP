<?php
	/**
	* Brandon Ramirez
	*/
$pageTitle = "Regular Expressions";
$trimSpace = "/^\s[0-9]{3}\s*$/"; //3 digits from 1-9 with any number of spaces at both sides
$re = "/^\s*(\\()\s*(\d{3})\s*(\\)\s?)\s*(\d{3})\s*(\-)\s*(\d{4})\s*$/";
//PERECT REGULAR EXPRESSION FOR PHONE NUMBERS YO
$str = "    (  951    )    522   -  0624      "; 
 
preg_match($re, $str, $matches);
$matches[0] = "";
$x = join($matches);
echo $x;
?>