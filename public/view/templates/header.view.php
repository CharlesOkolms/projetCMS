<!--<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
        </ul>
    </div>
</nav>-->

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <!--<div id="dismiss">
            <i class="glyphicon glyphicon-align-left"></i>
        </div>-->

        <div class="sidebar-header">
            <h3>CMS TMCB</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu">Tableau de bord</a>
                <!--<ul class="collapse list-unstyled" id="homeSubmenu">
                    <li><a href="#">Home 1</a></li>
                    <li><a href="#">Home 2</a></li>
                    <li><a href="#">Home 3</a></li>
                </ul>-->
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="#">Les Pages</a></li>
                    <li><a href="#">Créer une Page</a></li>
                </ul>
            </li>
            <li>
                <a href="#articleSubmenu" data-toggle="collapse" aria-expanded="false">Article</a>
                <ul class="collapse list-unstyled" id="articleSubmenu">
                    <li><a href="#">Les Articles</a></li>
                    <li><a href="#">Créer un Article</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Médias</a>
            </li>
            <li>
                <a href="#">Utilisateurs</a>
            </li>
            <li>
                <a href="#">Paramètres</a>
            </li>
        </ul>

        <!--<ul class="list-unstyled CTAs">
            <li><a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a></li>
            <li><a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a></li>
        </ul>-->
    </nav>

    <div id="content">
        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                        </button>
                        CMS TMCB
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="style/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
