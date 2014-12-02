# Fieldsuger plugin

‘Syntaxic’ sugar for getting values from [Kirby CMS](http://getkirby.com) page fields.

<https://gist.github.com/fvsch/372c47227fa0f36e92fa>

## Installation

Put the `fieldsugar` folder in `/site/plugins`.

## Example usage

Example usage with the custom field method on a first line,
and the corresponding logic (aka what you could write without
the syntactic sugar methods) on the second line.

```php
<?php

// Use a fallback field if the first one is empty
$title = $page->shorttitle()->or($page->title());
$title = $page->shorttitle()->empty() ? $page->title() : $page->shorttitle();
 
// Use a fallback value if the first one is empty
$category = $page->category()->or('misc');
$category = $page->category()->empty() ? 'misc' : $page->category();
 
// Parse a field value as a number (with default value)
$number = $page->mynumber()->int(50);
$number = $page->mynumber()->empty() ? 50 : intval($page->mynumber()->value);

// Parse a field value as a boolean (with default value)
$showSidebar = $page->sidebar()->bool(false);
$showSidebar = $page->sidebar()->empty() ? false : filter_var($page->sidebar()->value, FILTER_VALIDATE_BOOLEAN);

?>
```

## Author

Florent Verschelde
<http://fvsch.com>
<https://github.com/fvsch>
<https://twitter.com/fvsch>
