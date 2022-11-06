<?php

session_start();

if ( !isset($_GET['name']) || !isset($_SESSION['VeryficationNumber']) )
	header('Location: form.html');

if ( !in_array($_GET['code'], $_SESSION['VeryficationNumber']) )
	print 'Code is wrong, sorry. <a href="form.html">Try again</a>';
else
	print "Hello, {$_GET['name']}. You've entered right code! <a href=\"form.html\">Try again</a>";

?>