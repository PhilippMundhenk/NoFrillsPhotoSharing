<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: index.php');
}
?>
<!DOCTYPE html>

<html>

<head>
  <title>Photo Sharing</title>
  <!-- jQuery, -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Fotorama -->
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.5.2/fotorama.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.5.2/fotorama.js"></script>

  <!-- Progress Bar -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->

  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Redressed:400|Arvo:400,700|Pinyon+Script:400,700">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel='stylesheet' type='text/css' href='style.css'>

  <script type="text/javascript">

    function fileSelected() {
      var count = document.getElementById('fileToUpload').files.length;
      for (var index = 0; index < count; index ++)
      {
        var file = document.getElementById('fileToUpload').files[index];
        var fileSize = 0;
        if (file.size > 1024 * 1024)
          fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
        else
          fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
      }
    }

    function uploadFile() {
      var fd = new FormData();
      var count = document.getElementById('fileToUpload').files.length;
      for (var index = 0; index < count; index ++)
      {
        var file = document.getElementById('fileToUpload').files[index];
        fd.append(index, file);
      }
      var xhr = new XMLHttpRequest();
      xhr.upload.addEventListener("progress", uploadProgress, false);
      xhr.addEventListener("load", uploadComplete, false);
      xhr.addEventListener("error", uploadFailed, false);
      xhr.addEventListener("abort", uploadCanceled, false);
      xhr.open("POST", "savetofile.php");
      xhr.send(fd);
    }

    function uploadProgress(evt) {
      if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
        document.getElementById('progress').innerHTML = "uploading: "+percentComplete.toString() + '%<br/>Please Wait!';
      }
      else {
        document.getElementById('progress').innerHTML = 'Error';
      }
      if(percentComplete == 100)
      {
        document.getElementById('progress').innerHTML = "uploading: "+percentComplete.toString() + '%' + "<br/>Reloading...";
      }
    }

    function uploadComplete(evt) {
      /* This event is raised when the server send back a response */
      location.reload();
    }

    function uploadFailed(evt) {
      alert("Something went wrong! Please try again.");
    }

    function uploadCanceled(evt) {
      alert("Something went wrong! Please try again.");
    }

    function selectAndUpload() {
      document.getElementById('progress').innerHTML = "uploading... <br/>Please Wait!";
      document.getElementById('formTable').setAttribute("style", "display:none");
      fileSelected();
      uploadFile();
    }
  </script>
</head>

<body>
  <?php
    function endsWith($haystack, $needle) {
        return $needle === '' || substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

    function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
    {
      // open the directory
      $dir = opendir( $pathToImages );

      // loop through it, looking for any/all JPG files:
      while (false !== ($fname = readdir( $dir ))) {
        // parse path for the extension
        $info = pathinfo($pathToImages . $fname);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg' ) 
        {
          if (!file_exists("thumbs/{$fname}"))
          {
            // echo "Creating thumbnail for {$fname} <br />";

            //hack to make iOS crap work
            $exif = exif_read_data("$pathToImages$fname");
            
            // load image and get image size
            $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );

            //hack to make iOS crap work
            if (isset($exif['Orientation']))
            {
              switch ($exif['Orientation'])
              {
                case 3:
                  // Need to rotate 180 deg
                  $img = imagerotate($img, 180, 0);
                  break;

                case 6:
                  // Need to rotate 90 deg clockwise
                  $img = imagerotate($img, 270, 0);
                  break;

                case 8:
                  // Need to rotate 90 deg counter clockwise
                  $img = imagerotate($img, 90, 0);
                  break;
              }
            }

            $width = imagesx( $img );
            $height = imagesy( $img );

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );

            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );

            // copy and resize old image into new image 
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

            // save thumbnail into a file
            imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
          }
        }
      }
      // close the directory
      closedir( $dir );
    }

    createThumbs("uploads/","thumbs/",1000); 
  ?>
  <h2 class="titleLine" dir="ltr" id="titleLineID">Photo Sharing</h2>

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
                    <th class="th"><img src="upload_white.png" class="uploadIcon" width="30" height="30"/></th>
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
                <th class="th"><a href="download.php"><img src="download_white.png" class="downloadIcon" width="30" height="30"/></a></th>
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
  $path_full = 'uploads'; //full size
  $path = 'thumbs'; //small size
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