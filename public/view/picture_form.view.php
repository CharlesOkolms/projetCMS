<?php

?>
<form method="POST"  enctype="multipart/form-data">
	<input type="text" name="title" placeholder="Titre" required />
	<textarea title="description" name="description" required></textarea>
    <input type="file" name="picture" required />
	<input title="Save" type="submit" name="picture_add" value="add" />
</form>
