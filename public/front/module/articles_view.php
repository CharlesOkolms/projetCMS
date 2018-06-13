<?php
$articles = Article::getAll($idPage, true);

?>

<div class="articles_view">
    <div class="card-header">
	    <div class="title">Articles</div>
    <br/>
    </div>
		<?php
		foreach($articles as $article)
		{
			?>
            <div class="well">
			    <article><h4></h4><?=$article['title'];?><br/><?=$article['content'];?></article>
            </div>
		    <?php
		}
		?>
</div>
