<?php

/* title for the page */
$title = 'Photo Sharing';
/* Shall the access to password protected? */
$use_password = true;
/* password to access the page */
$password = 'password';
/* width of the thumbnails to generate */
$thumbnail_width = 1000;
/* possible to login via index.php?pw=password
   This can be a security issue, as the password is in clear text in the URL.
   It will be logged by your server (if not deactivated) and if an insecure 
   connection (HTTP) is used, it is seen by all devices on the way (including ISP, etc). */
$allow_url_password = true;

/* directory for uploaded files (full size) */
$photo_dir = 'uploads';
/* directory for thumbnails */
$thumbs_dir = 'thumbs';

?>