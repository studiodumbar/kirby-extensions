<?php
/*
  Example: Using pagesByDate with some custom options
*/

  // Let's build a list of events planned in 2014
  $myOptions = array(
    'max' => '2012-12-31',
    'min' => '2012-01-01',
    'order' => 'asc',
  );

  // If we want all pages with dates in the site, we can do:
  $eventUris = pagesByDate($pages, $myOptions);

  // If instead we want to limit ourselves to content in a "content/events" folder…
  // (We can't just use $pages->find('events') because it doesn't return a set of pages)
  // $src = $pages->find('events')->children();
  // $events = pagesByDate($src, $myOptions);
  // );
?>

<?php if (!$eventUris): ?>

<p>Sorry, no event planned yet.</p>

<?php else: ?>

<ul>
<?php foreach($eventUris as $uri): ?>
<?php $event = $pages->find($uri); ?>
  <li>
    <a href="<?php echo $event->url(); ?>"><?php echo $event->title(); ?></a><br>
    <?php echo $event->date('j F Y'); ?> - <?php echo $event->location(); ?> 
  </li>
<?php endforeach; ?>
</ul>

<?php endif; ?>
