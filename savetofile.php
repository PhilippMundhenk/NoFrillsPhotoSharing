<?php
// if (isset($_FILES['myFile'])) {
    // Example:

foreach ($_FILES as &$pic) {
    $date = date_create();
    move_uploaded_file($pic['tmp_name'], "uploads/" . date_timestamp_get($date) . str_replace(" ", "_", $pic['name']));
    echo 'successful';
}
// }
?>