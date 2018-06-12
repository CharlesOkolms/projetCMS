<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21/05/2018
 * Time: 17:29
 */

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
        <tbody>
        <?php
            foreach ($liste as $user){
                //var_dump((bool) $user->isWritter());

        ?>
        <tr>
            <form method="post">
                <td><?=$user->getFirstname()." ".$user->getLastname()?></td>
                <input type="hidden" value="<?=$user->getId(); ?>" name="id_user"/>
                <td>
                    <input type="checkbox" class="writer" id="<?="w".$user->getId()?>" value="writer" name="rights[]"
                           <?php if($user->isWriter()){ ?>
                               checked
                           <?php }?>/>
                </td>
                <td>
                    <input type="checkbox" class="publisher" id="<?="p".$user->getId()?>" value="publisher" name="rights[]"
                        <?php if($user->isPublisher()){ ?>
                            checked
                        <?php }?>/>
                </td>
                <td>
                    <input type="checkbox" class="admin" id="<?="a".$user->getId()?>" value="admin" name="rights[]"
                        <?php if($user->isAdmin() && $user->isSuperAdmin()){ ?>
                            checked
                        <?php } if (!$CURRENT_USER->isSuperAdmin()){?>
                            disabled readonly
                        <?php } ?>/>
                </td>
                <td>
                    <button type="submit" name="user_update" class="btn btn-success ModifDroit" value="Modifier"><i class="glyphicon glyphicon-check"></i></button>
                </td>
            </form>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>

<script>
    /*$(document).ready(function() {
        $('.ModifDroit').click(function () {
            var id = $(this).data('id');
            var admin = $('#'+'a'+id).prop('checked');
            var writer = $('#'+'w'+id).prop('checked');
            var publisher = $('#'+'p'+id).prop('checked');
            var url = '/user_list.controller.php';
            $.post(url, function(data){
            });
            alert('Success'+writer+publisher+admin);
            return false;
        })
    })*/
</script>