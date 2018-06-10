<?php
//var_dump($article);
?>



<div id="article_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre" value="<?php echo $article->getTitle();?>"/>
        <input type="text" name="headerphoto" placeholder="Photo de Header (lien url)"/>
        <div id="editor_wysiwyg">
            <textarea name="content" id="editor" rows="5" cols="87" ><?php echo $article->getContent();?></textarea>
        </div>

        <input title="article_content" name="article" type="hidden">
        <input type="file" name="attachment" placeholder="Piece jointe" />
        <input title="Save the article" type="submit" name="article_update" value="Editer" class="btn btn-primary navbar-btn" />
    </form>
</div>

<script>

    CKEDITOR.replace('editor');

    $('#editor').click(function() {
        document.getElementById("editor").insertAdjacentHTML('beforeend', 'name="content"');
    });
</script>
