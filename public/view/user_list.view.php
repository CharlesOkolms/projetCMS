<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21/05/2018
 * Time: 17:29
 */
$liste = User::getAll();


?>

<div id="user_list">
    <table id="user_table" class="table">
        <thead>
        <tr>
            <th scope="col">Utilisateur</th>
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
            <td><?php echo $user->getFirstname()." ".$user->getLastname(); ?></td>
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
