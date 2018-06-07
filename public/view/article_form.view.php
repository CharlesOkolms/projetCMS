<?php

?>
<form method="POST"  enctype="multipart/form-data">
	<input type="text" name="title" placeholder="Titre" />
	<input type="text" name="headerphoto" placeholder="Photo de Header (lien url)" />
    <textarea name="content" id="editor">
        <p>Here goes the initial content of the editor.</p>
    </textarea>
	<input title="article_content" name="article" type="hidden">
    <input type="file" name="attachment" placeholder="Piece jointe" />
    <input title="Save the article" type="submit" name="article_add" value="add" />
</form>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            // The language code is defined in the https://en.wikipedia.org/wiki/ISO_639-1 standard.
            language: 'fr'
        } )
        .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>