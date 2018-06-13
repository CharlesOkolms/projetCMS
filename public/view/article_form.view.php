<?php

?>



<div id="article_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre" />
        <input type="text" name="headerphoto" placeholder="Photo de Header (lien url)" />
        <div id="editor_wysiwyg">
            <textarea title="content" name="content" id="editor" rows="5" cols="87"></textarea>
        </div>

        <input title="article_content" name="article" type="hidden">
        <input type="file" name="attachment" placeholder="Piece jointe" />
        <input title="Save the article" type="submit" name="article_add" value="Ajouter" class="btn btn-primary navbar-btn" />
    </form>
</div>

<script>

    CKEDITOR.replace('editor');

    $('#editor').click(function() {
        document.getElementById("editor").insertAdjacentHTML('beforeend', 'name="content"');
    });
</script>
