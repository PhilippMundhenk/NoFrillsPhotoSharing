<?php
	include '../config.php';
	include 'session.php';
	foreach ($_FILES as &$pic) {
	    $date = date_create();
	    move_uploaded_file($pic['tmp_name'], "../$photo_dir/" . date_timestamp_get($date) . str_replace(" ", "_", $pic['name']));
	}
?>