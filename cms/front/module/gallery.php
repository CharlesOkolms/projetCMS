<?php

$pictures_list = Picture::getAll();

?>
<div class="gallery">
    <div class="title">Galerie d'images</div>
    <div id="gallery_carousel">

        <div class="connected-carousels">
            <div class="stage">
                <div class="carousel carousel-stage">
                    <ul>
                        <?php

                        foreach($pictures_list as $picture) {	// $picture est un array, pas l'objet
                            echo '<li>'.
                                '<img class="picture" src="'.PATH_PICTURE.$picture->getId().'.'.$picture->getExtension().'" width="600" height="400" alt=""/>'.
                                '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
                <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
            </div>

            <div class="navigation">
                <a href="#" class="prev prev-navigation">&lsaquo;</a>
                <a href="#" class="next next-navigation">&rsaquo;</a>
                <div class="carousel carousel-navigation">
                    <ul>
                        <?php

                        foreach($pictures_list as $picture) {	// $picture est un array, pas l'objet
                            echo '<li>'.
                                '<img class="picture" src="'.PATH_PICTURE.$picture->getId().'.'.$picture->getExtension().'" width="50" height="50" alt=""/>'.
                                '<span class="picture_title">'.$picture->getTitle().'</span>'.
                                '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>
