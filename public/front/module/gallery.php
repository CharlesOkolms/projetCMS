<?php

	$gallery = Picture::getAll();

?>
<div class="gallery">
    <div class="title">Galerie d'images</div>
    <div id="gallery_carousel">

		<?php var_dump($gallery); ?>
    </div>
</div>
