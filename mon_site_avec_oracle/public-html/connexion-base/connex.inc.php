<?php
	function connect($param)
	{
		include($param.".inc.php");
		$conn = oci_connect(MYUSER,MYPASS,MYHOST);
		return $conn;
	}
?>
