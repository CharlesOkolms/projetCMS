<?php
$articles = Article::getAll($idPage, false);
?>

<div class="articles_list">
	<div class="title">Liste des Articles</div>

	<?php
	foreach($articles as $article){
		?>
		<article><?=$article['title']?></article>

		<?php
	} ?>

</div>
