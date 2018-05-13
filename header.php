<?php 
?>
<link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="public/css/styles2.css">
<script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	var i = 0;
	images = [];
	var time = 3000;
	// Images list 
	images[0]="public/images/banner_01.jpg"
	images[1]="public/images/banner_1.jpg"
	// change Images
	function changeImages() {
		document.slide.src=images[i]; 
		if (i < images.length - 1) {
			i++;

		} else {
			i=0;
		}
		setTimeout("changeImages()" ,time );
	}
	window.onload = changeImages;
</script>
