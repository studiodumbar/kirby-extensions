# Tweets plugin

A little plugin for [Kirby CMS](http://getkirby.com) to display the latest Tweets from any public Twitter account.

## Installation

* Copy the `tweets` folder to the `/site/plugins` folder.
* Enable caching (if not enabled the plugin will call the Twitter API on every page refresh/view, with a possible blocked by Twitter as a result):
	* Enable the cache in `/site/config/config.php` (e.g. `c::set('cache', true);`)
	* Make sure that `/site/cache` directory is writable (folder permissions set to `0755`)

## How to use it?

Add it to your templates:

```
<?php $tweets = tweets('getkirby') ?>

<ul class="tweets">
	<?php foreach($tweets as $tweet): ?>
		<li>
			<a class="user" href="<?php echo $tweet->user()->url() ?>">
				<img src="<?php echo $tweet->user()->image() ?>" /> 
				<strong><?php echo $tweet->user()->name() ?></strong>
				<small>@<?php echo $tweet->user()->username() ?></small>
			</a>    
			<p><?php echo $tweet->text(true) ?></p>
			<a class="date" href="<?php echo $tweet->url() ?>"><?php echo $tweet->date('h:i A - d M y') ?></a>
		</li>
	<?php endforeach ?>
</ul>
```


## Available Options

Set options like this:

```php
<?php 
	$tweets = tweets('getkirby', array(
		'limit'   => 5,
		'refresh' => 60*60*5
	)); 
?>
```

### limit (default: 10)

Sets the number of returned tweets. 

### cache (default: true)

Disable or enable the cache. Caching the results is highly recommended. Otherwise the plugin will be super slow. You must make sure that `site/cache` is writable (change permissions to 0755) You must also set c::set('cache', true); in site/config/config.php to enable the cache. 

### hiderep (default: false)

Show or hide replies you've tweeted, e.g. for users with a large number of replies that aren't interesting for the general public. 

### refresh (default: 20 minutes)

Set the cache expiry in seconds. By default it will be set to 20 minutes. After 20 minutes the plugin will fetch fresh data from the Twitter API. 


## Attributes for the tweet-object

* `$tweet->url()` The URL to the Tweet page on Twitter
* `$tweet->text()` The text of the Tweet
* `$tweet->date()` The timestamp when the Tweet has been posted
* `$tweet->source()` The source, from which the Tweet has been posted
* `$tweet->user()` The user object (see object attributes)

## Attributes for the user-object

* `$tweet->user()->name()` The full name of the user
* `$tweet->user()->username()` The Twitter username
* `$tweet->user()->bio()` The Twitter bio
* `$tweet->user()->url()` The URL to the user's Twitter page 
* `$tweet->user()->image()` The user avatar pic
* `$tweet->user()->following()` The number of accounts the user is following
* `$tweet->user()->followers()` The number of followers


## Author
Bastian Allgeier
<http://getkirby.com>

## Changelog

* **1.0.0** Initial release
