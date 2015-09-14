<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: index.php');
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lee Hui Xin &amp; Philipp Mundhenk</title>
    <script>

        function downloadURLS() {
            var links = document.getElementsByClassName("downloadLnk");
            for(var i=0; i<links.length; i++) {
                links[i].click();
            }

        }

        window.onload = function() {
            document.getElementById("DownloadButton").click();
        };
    </script>

</head>
<body>
    <div>This page works best in Chrome. Click "Allow" in box "This site is attempting to download multiple files".</div>
    <?php 
        $path_full    = 'uploads'; //full size
        $path    = 'thumbs'; //small size
        $files = scandir($path_full, SCANDIR_SORT_DESCENDING); 
        foreach ($files as &$f) {
            if($f != "." && $f != "..")
            {
                echo "<a class=\"downloadLnk\" href=\"$path_full/$f\" download></a><br/>";
            }
        }
    ?>
<div>
    <button onclick="downloadURLS()" id="DownloadButton" style="display: none;">download all</button>
</div>

</body>
</html>