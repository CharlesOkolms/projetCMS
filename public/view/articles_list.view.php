<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21/05/2018
 * Time: 17:12
 */

?>

<div id="liste_article">
    <div>
        <a href="?page=article_add" type="button" class="btn btn-primary navbar-btn">Ajouter</a>
    </div>
    <div>
        <table class="table" id="article_list">
            <thead>
            <tr>
                <th scope="col">Nom de l'Article</th>
                <th scope="col">Date de création</th>
                <th scope="col">Date de publication</th>
                <th scope="col">Rédacteur</th>
                <th scope="col">Publicateur</th>
                <th scope="col">Modification</th>
                <th scope="col">Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($liste as $article) {
                if($article["deleted"] == NULL) {
                    //var_dump($article);
                    //var_dump($article["writer"]);
                    $redac = new User(intval($article["writer"]));
                    if ($article["publisher"] != null) {
                        $publi = new User(intval($article["publisher"]));
                    }
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $article["title"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $article["written"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $article["published"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $redac->getFirstname() . " " . $redac->getLastname();
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($article["publisher"] != null) {
                                echo $publi->getFirstname() . " " . $publi->getLastname();
                            }
                            ?>
                        </td>
                        <td>
                            <a href="?page=article_update&id=<?php echo $article["id_article"]; ?>" type="button"
                               class="btn btn-primary navbar-btn">
                                <li class="glyphicon glyphicon-edit"></li>
                            </a>
                        </td>
                        <td>
                            <form method="POST"  enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $article["id_article"]; ?>" name="idArticle"/>
                                <button type="submit" name="article_deleted" class="btn btn-danger navbar-btn" value="1">
                                    <li class="glyphicon glyphicon-trash"></li>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>