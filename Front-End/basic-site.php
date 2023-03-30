<?php
	$_SESSION["user"] = "Johnny";
	
	if (isset($_SESSION["user"])) {
		
		include "../Front-End/logout.html";
		include "../Front-End/settings.html";
		include "../Front-End/play.html";
        include "../Front-End/ranking.html";

	}