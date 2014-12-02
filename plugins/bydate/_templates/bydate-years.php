<?php
/*
  Example: Using pagesByDate with results grouped by year
*/
  $postUris = pagesByDate($pages, array('group'=>'year'));
?>

<?php if (!$postUris): ?>

<p>Sorry, nothing to show.</p>

<?php else: ?>

<?php foreach($postUris as $year => $uris): ?>
<h2><?php echo $year ?></h2>
<ul>
<?php foreach($uris as $uri): ?>
<?php $post = $pages->find($uri); ?>
  <li><a href="<?php echo $post->url() ?>"><?php echo $post->title() ?></a></li>
<?php endforeach; ?>
</ul>

<?php endforeach; ?>

<?php endif; ?>
