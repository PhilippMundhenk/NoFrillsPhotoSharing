<?php
  include '../config.php';
  include 'session.php';
  include 'thumbnails.php';
?>
<!DOCTYPE html>

<html>

<head>
  <title><?php echo $title; ?></title>
  <!-- jQuery, -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Fotorama -->
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.5.2/fotorama.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.5.2/fotorama.js"></script>

  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Redressed:400|Arvo:400,700|Pinyon+Script:400,700">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel='stylesheet' type='text/css' href='style.css'>

  <script src="photoshare.js"></script>
</head>

<body>
  <?php
    createThumbs("../$photo_dir/","../$thumbs_dir/",$thumbnail_width); 
  ?>
  <h2 class="titleLine" dir="ltr" id="titleLineID"><?php echo $title; ?></h2>

  <hr style="border: 1px outset #000000;">
  <div>
    <table align="center" id="formTable">
      <tr>
        <th>
          <div class="myButton">
            <form id="form1" enctype="multipart/form-data" method="post" action="Upload.aspx" p align="center">
              <label for="fileToUpload" id="uploadLabel">
                <table class="tg" align="center">
                  <tr>
                    <th class="th"><p class="uploadText"><b>upload photos/videos</b></p></th>
                    <th class="th"><img src="../icons/upload.png" class="uploadIcon" width="30" height="30"/></th>
                  </tr>
                </table>
              </label>
              <div class="image-upload">
                <input type="file" name="fileToUpload" id="fileToUpload" onchange="selectAndUpload();" accept="video/*,image/*" multiple="multiple"/>  
              </div>
            </form>
          </div>
        </th>
        <th>
          <div class="myButton" id="downloadTable">
            <table class="tg" align="center">
              <tr>
                <th class="th"><a href="download.php"><p class="downloadText"><b>download all photos/videos</b></p></a></th>
                <th class="th"><a href="download.php"><img src="../icons/download.png" class="downloadIcon" width="30" height="30"/></a></th>
              </tr>
            </table>
          </div>
        </th>
      </tr>
    </table>
    <div id="progress" class="progress"></div>
  </div>

<hr style="border: 1px outset #000000;">

<div class="fotorama" data-nav="thumbs" data-allowfullscreen="native" p align="center">
<?php 
  $path_full = "../$photo_dir"; //full size
  $path = "../$thumbs_dir"; //small size
  $files = scandir($path_full, SCANDIR_SORT_DESCENDING);
  foreach ($files as &$f) {
    if($f != "." && $f != "..")
    {
      if(endsWith(strtolower($f), '.jpg') || endsWith(strtolower($f), '.jpeg'))
      {
        //conventional:
        // echo "<img src=\"$path/$f\"><br/>";
        //lazy:
        echo "<a href=\"$path/$f\" data-full=\"$path_full/$f\"></a><br/>";
      }
      else if(endsWith(strtolower($f), '.jpg') || endsWith(strtolower($f), '.jpeg'))
      {
        //conventional:
        // echo "<img src=\"$path/$f\"><br/>";
        //lazy:
        echo "<a href=\"$path/$f\" data-full=\"$path_full/$f\"></a><br/>";
      }
      else if(endsWith(strtolower($f), '.mp4') || endsWith(strtolower($f), '.m4v') || endsWith(strtolower($f), '.3gp')  || endsWith(strtolower($f), '.mov'))
      {
        echo "<div><h2>Video playback is currently not supported.<br>Please download all to watch.<br>Sorry!</h2></div>";
        // echo "<div><video controls><source src='$path_full/$f' type='video/mp4'</video></div>";
      } 
    }
  }
?>
</div>
</body>

</html>