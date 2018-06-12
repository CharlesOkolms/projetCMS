<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div id="dismiss">
            <i class="glyphicon glyphicon-arrow-left"></i>
        </div>

        <div class="sidebar-header">
            <h3>CMS TMCB</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="?page=dashboard">Tableau de bord</a>
                <!--<ul class="collapse list-unstyled" id="homeSubmenu">
                    <li><a href="#">Home 1</a></li>
                    <li><a href="#">Home 2</a></li>
                    <li><a href="#">Home 3</a></li>
                </ul>-->
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="?page=pages_list">Les Pages</a></li>
                    <?php
                    if($CURRENT_USER->isWriter() || $CURRENT_USER->isAdmin()){ ?>
                        <li><a href="?page=page_add">Créer une Page</a></li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#articleSubmenu" data-toggle="collapse" aria-expanded="false">Articles</a>
                <ul class="collapse list-unstyled" id="articleSubmenu">
                    <li><a href="?page=articles_list">Les Articles</a></li>
                    <?php
                    if($CURRENT_USER->isWriter() || $CURRENT_USER->isAdmin()){ ?>
                        <li><a href="?page=article_add">Créer un Article</a></li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#gallerySubmenu" data-toggle="collapse" aria-expanded="false">Galerie</a>
                <ul class="collapse list-unstyled" id="gallerySubmenu">
                    <li><a href="?page=gallery">La galerie</a></li>
                    <li><a href="?page=picture_add">Ajouter une photo</a></li>
                </ul>
            </li>

            <?php
            if($CURRENT_USER->isAdmin()){ ?>
                <li>
                    <a href="#utilisateurSubmenu" data-toggle="collapse" aria-expanded="false">Utilisateurs</a>
                    <ul class="collapse list-unstyled" id="utilisateurSubmenu">

                            <li><a href="?page=users_list">Les Utilisateurs</a></li>
                            <li><a href="?page=user_add">Créer un utilisateur</a></li>
                    </ul>
                </li>
            <?php } ?>

            <li>
                <?php
                if($CURRENT_USER->isAdmin()){ ?>
                    <a href="?page=config">Paramètres</a>
                <?php } ?>
            </li>
        </ul>

        <!--<ul class="list-unstyled CTAs">
            <li><a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a></li>
            <li><a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a></li>
        </ul>-->
    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                        <i class="glyphicon glyphicon-align-left"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<h1 id="page_title"><?=title()?></h1>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div id="identite">
                                <a href="?page=user_update"><?php echo $CURRENT_USER->getNickname() ?></a>
                            </div>
                            <div id="deconexion">
                                <a href="?action=logout">Déconnexion <span class="glyphicon glyphicon-off text-danger"></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>



<div class="overlay"></div>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.overlay').fadeOut();
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').addClass('active');
            $('.overlay').fadeIn();
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

<div id="pageContent">
