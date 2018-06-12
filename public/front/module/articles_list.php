<?php
$articles = Article::getAll($idPage, false);
?>

<div class="articles_list">

	<?php
	foreach($articles as $article){
		?>
		<article><?=$article['title']?></article>

		<?php
	} ?>

</div>
