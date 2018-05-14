<?php

?>
<form method="POST"  enctype="multipart/form-data">
	<input type="text" name="title" placeholder="Titre" />
	<input type="text" name="headerphoto" placeholder="Photo de Header (lien url)" />
	<textarea title="article_content" name="article"></textarea>
    <input type="file" name="attachment" placeholder="Piece jointe" />
    <input title="Save the article" type="submit" name="article_add" value="add" />
</form>
