<?php
$articles = Article::getAll($idPage, true);

?>

<div class="articles_view">
    <div class="card-header">
	    <div class="title">Articles</div>
    </div>
		<?php
		foreach($articles as $article){

			?>
			<article><?=$article['content']?></article>

		<?php
		} ?>

</div>
