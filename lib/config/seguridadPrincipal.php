<?php
	if (!isset($_SESSION["seguridad"]) or $_SESSION["seguridad"]==""){
		header("Location: ../../../../login");
	}
?>