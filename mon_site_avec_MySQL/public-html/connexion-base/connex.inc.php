<?php
function connex($base,$param)
{
	include($param.".inc.php");
	$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS,$base);
	/*
	if (!$idcom) {
		echo ("Erreur de connexion ! <br>");
	} else { 
		echo ("Connexion établie avec succès ! <br>");
	}*/
	return $idcom;
}
?>
