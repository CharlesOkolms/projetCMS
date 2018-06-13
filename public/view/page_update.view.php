<?php
//var_dump($page);
?>


<div id="page_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre" value="<?php echo $page->getTitle();?>"/>

        <select title="select the template" name="template" id="page_add_liste">
            <?php
            foreach(Template::getAll() as $template){
                if ($page->getTemplate() == $template){
                    echo '<option value="'.$template['id_template'].'" selected>'.$template['name'].'</option>';
                }
                else {
                    echo '<option value="'.$template['id_template'].'">'.$template['name'].'</option>';
                }

            }
            ?>
        </select>
        <select title="select the style" name="style" id="page_add_liste">
            <?php
            foreach(Style::getAll() as $style){
                echo '<option value="'.$style['id_style'].'">'.$style['name'].'</option>';
            }
            ?>
        </select>

        <input title="Save the article" type="submit" name="page_update" value="Editer" class="btn btn-primary navbar-btn" />
    </form>
</div>