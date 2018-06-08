<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21/05/2018
 * Time: 17:12
 */

?>

<h1>Nos Articles</h1>
<button type="button" class="btn btn-primary navbar-btn">Ajouter</button>
<table class="table">
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
        //var_dump($article);
        $id = $article["id_user_writer"];
        $redac = new User($id);
        if($article["id_user_publisher"] != null) {
            $publi = new User($article["id_user_publisher"]);
        }
        ?>
        <tr>
            <th scope="row">
                <?php
                echo $article["title"];
                ?>
            </th>
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
                echo $redac->getFirstname()." ".$redac->getLastname();
                ?>
            </td>
            <th>
                <?php
                if($article["id_user_publisher"] != null) {
                    echo $publi->getFirstname() . " " . $redac->getLastname();
                }
                ?>
            </th>
            <td>
                <button type="button" class="btn btn-primary navbar-btn">
                    <li class="glyphicon glyphicon-edit"></li>
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-danger navbar-btn">
                    <li class="glyphicon glyphicon-trash"></li>
                </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
