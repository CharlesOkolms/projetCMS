<?php

?>
<form method="POST"  enctype="multipart/form-data">
	<input type="text" name="title" placeholder="Titre" />
	<select title="select the template" name="template">
		<?php
			foreach(Template::getAll() as $template){
				echo '<option value="'.$template['id_template'].'">'.$template['name'].'</option>';
			}
		?>
	</select>
	<select title="select the style" name="style">
		<?php
			foreach(Style::getAll() as $style){
				echo '<option value="'.$style['id_style'].'">'.$style['name'].'</option>';
			}
		?>
	</select>

	<input title="Save the page" type="submit" name="page_add" value="add" />
</form>
