<?php
/*
  Example: Using pagesByDate with default settings
*/
  $postUris = pagesByDate($pages);
?>

<?php if (!$postUris): ?>

<p>Sorry, nothing to show.</p>

<?php else: ?>

<ul>
<?php foreach($postUris as $uri): ?>
<?php $post = $pages->find($uri) ?>
  <li>
    <a href="<?php echo $post->url() ?>"><?php echo $post->title() ?></a>
    - <?php echo $post->date('j F Y') ?> 
  </li>
<?php endforeach; ?>
</ul>

<?php endif; ?>
