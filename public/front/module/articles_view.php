<?php
$articles = Article::getAll($idPage, true);

?>

<div class="articles_view">

		<?php
		foreach($articles as $article){

			?>
			<article><?=$article['content']?></article>

		<?php
		} ?>

</div>
