<?php
$articles = Article::getAll($idPage, true);
var_dump($articles);
?>

<div class="articles_list">

		<?php
		foreach($articles as $article){

			?>
			<article><?=$article['content']?></article>

		<?php
		} ?>

</div>
