<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21/05/2018
 * Time: 17:12
 */

?>

<div id="liste_page">
    <div>
        <a href="?page=page_add" type="button" class="btn btn-primary navbar-btn">Ajouter</a>
    </div>
    <div>
        <table class="table" id="page_list">
            <thead>
            <tr>
                <th scope="col">Nom de la page</th>
                <th scope="col">Créateur</th>
                <th scope="col">Modification</th>
                <th scope="col">Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($liste as $page) {
                //var_dump($page);
                //var_dump($page["writer"]);
                $redac = new User(intval($page->getcreator()));
                ?>
                <tr>
                    <td>
                        <?php
                        echo $page->getTitle();
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $redac->getFirstname()." ".$redac->getLastname();
                        ?>
                    </td>
                    <td>
                        <a href="?page=page_update&id=<?php echo $page->getId();?>" type="button" class="btn btn-primary navbar-btn">
                            <li class="glyphicon glyphicon-edit"></li>
                        </a>
                    </td>
                    <td>
                        <form method="POST"  enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $page["id_page"]; ?>" name="idPage"/>
                            <button type="submit" name="page_deleted" class="btn btn-danger navbar-btn" value="1">
                                <li class="glyphicon glyphicon-trash"></li>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>