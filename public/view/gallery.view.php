<?php

foreach($pictures_list as $picture) {	// $picture est un array, pas l'objet
	echo '<div class="picture_block">
			<img class="picture" src="'.PATH_PICTURE.$picture['id'].'.'.$picture['extension'].'" />
			<span class="picture_title">'.$picture['title'].'</span>
		</div>';
}
