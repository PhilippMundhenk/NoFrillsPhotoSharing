<!DOCTYPE html>
<?php
	include '../config.php';
	include 'session.php';
?>
<html>
 
<head>
 
    <title><?php echo $title; ?></title>
	<!-- jQuery, -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!-- Fotorama -->
	<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.5.2/fotorama.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.5.2/fotorama.js"></script>

	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Redressed:400|Arvo:400,700|Pinyon+Script:400,700">

 	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
		.fileToUpload{
		    height:auto;
		    width:20%;

		    background-image:url('../icons/upload.png');
    		background-repeat:no-repeat;
   			background-position:left top;  padding-left:15px;
		}

		.titleLine {
		    font-family: "Pinyon Script";
		    color: rgb(0,0,255);
		    font-weight: 700;
		    font-size: 1.700rem;
		    font-style: normal;
        text-align: center;
		}
	</style>
</head>
 
<body>
	<div class="fotorama" data-autoplay="true" data-fit="cover" data-loop="true" data-allowfullscreen="native">
		<?php 
			$path    = '../$photos_dir';
				$files = scandir($path, SCANDIR_SORT_DESCENDING); 
				foreach ($files as &$f) {
				if($f != "." && $f != "..")
				{
					//conventional:
					// echo "<img src=\"$path/$f\"><br/>";
					//lazy:
					echo "<a href=\"$path/$f\"></a><br/>";
				}
			}
		?>
	</div>
</body>
</html>