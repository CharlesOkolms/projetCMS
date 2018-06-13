<?php
//var_dump($article);
?>

<div id="article_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre" value="<?php echo $article->getTitle();?>" <?php if($CURRENT_USER->isPublisher()){ echo "readonly";} ?>/>
        <input type="text" name="headerphoto" placeholder="Photo de Header (lien url)" <?php if($CURRENT_USER->isPublisher()){ echo "readonly";} ?>/>
        <div id="editor_wysiwyg">
            <textarea name="content" id="editor" rows="5" cols="87" <?php if($CURRENT_USER->isPublisher()){ echo "readonly";} ?>><?php echo $article->getContent();?></textarea>
        </div>

        <input title="article_content" name="article" type="hidden" <?php if($CURRENT_USER->isPublisher()){ echo "readonly";} ?>>
        <input type="file" name="attachment" placeholder="Piece jointe" <?php if($CURRENT_USER->isPublisher()){ echo "disabled";} ?>/>
        <?php if($CURRENT_USER->isWriter()) {?>
            <input title="Save the article" type="submit" name="article_update" value="Editer" class="btn btn-primary navbar-btn" />
        <?php } else if($CURRENT_USER->isPublisher()) { ?>
            <select title="Choix publication page" id="Page" name="page">
                <?php
                foreach ( $pages as $unePage ) {
                    if($unePage->getTitle()!="Gallery"){?>
                        <option value="<?=$unePage->getId();?>"><?=$unePage->getTitle();?></option>
                <?php }
                } ?>
            </select>
            <input title="Published the article" type="submit" name="article_published" value="Publier" class="btn btn-primary navbar-btn" />
        <?php } ?>
    </form>
</div>

<script>

    CKEDITOR.replace('editor');

    $('#editor').click(function() {
        document.getElementById("editor").insertAdjacentHTML('beforeend', 'name="content"');
    });
</script>
