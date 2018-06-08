<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21/05/2018
 * Time: 17:29
 */
$liste = User::getAll();


?>
<div>
    <h1>Nos Utilisateurs</h1>
</div>

<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Rédacteur</th>
            <th scope="col">Publicateur</th>
            <th scope="col">Administrateur</th>
            <th scope="col">Modifier</th>
        </tr>
        </thead>
        <?php
            foreach ($liste as $user){
                //var_dump((bool) $user->isWritter());

        ?>
        <tbody>
        <tr>
            <th scope="row"><?php echo $user->getFirstname(); ?></th>
            <td><?php echo $user->getLastname(); ?></td>
            <td>
                <input type="checkbox"
                       <?php if($user->isWriter()){ ?>
                           checked
                       <?php }?>/>
            </td>
            <td>
                <input type="checkbox"
                    <?php if($user->isPublisher()){ ?>
                        checked
                    <?php }?>/>
            </td>
            <td>
                <input type="checkbox"
                    <?php if($user->isAdmin()){ ?>
                        checked
                    <?php } ?> />
            </td>
            <td>

            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>
<script>

</script>
