<?php
//var_dump($page);
?>


<div id="page_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre" value="<?php echo $page->getTitle();?>"/>

        <input title="Save the article" type="submit" name="page_update" value="Editer" class="btn btn-primary navbar-btn" />
    </form>
</div>