<?php
    function endsWith($haystack, $needle) {
        return $needle === '' || substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

    function createThumbs( $images, $thumbs, $thumbWidth ) 
    {
      $dir = opendir( $images );

      while (false !== ($f = readdir( $dir ))) {
        $info = pathinfo($images . $f);
        if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg' ) 
        {
          if (!file_exists("../$thumbs_dir/{$f}"))
          {
            $exif = exif_read_data("$images$f");
            $img = imagecreatefromjpeg( "{$images}{$f}" );

            //image turning for iOS
            if (isset($exif['Orientation']))
            {
              switch ($exif['Orientation'])
              {
                case 3:
                  $img = imagerotate($img, 180, 0);
                  break;
                case 6:
                  $img = imagerotate($img, 270, 0);
                  break;
                case 8:
                  $img = imagerotate($img, 90, 0);
                  break;
              }
            }

            $width = imagesx( $img );
            $height = imagesy( $img );
            
            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );
			      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			      imagejpeg( $tmp_img, "{$thumbs}{$f}" );
          }
        }
      }
      closedir( $dir );
    }
?>