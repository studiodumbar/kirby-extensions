# RelatedPages plugin

The RelatedPages plugin for [Kirby CMS](http://getkirby.com) provides an easy, but flexible way of incorporating links (or other data) of related pages to the current page.

The relationship is considered by keywords in an arbitrary field of the content files. Example: If you provide the field `Tags` in your content file which is rendered together with the RelatedPages plugin, all pages in your site will be searched for any of the *tags* (separated by comma) in the field `Tags`.

### Installation

Save the file `relatedpages.php` in a ‘relatedpages’ folder into the plugins folder of Kirby 2.

### Basic usage

```php
<?php
$related_pages = relatedpages($options);

foreach ($related_pages->pages() as $uid => $page) {
  echo $page->title();
}
?>
```

### Methods

- `$related_pages->pages()` outputs an array with all related pages. The key of the array is the uid of the related page and the value is the kirby page object.

- `$related_pages->count()` outputs an integer with the number of related pages found.

- `$related_pages->options()` outputs the options array (see next) in a readable way.

**Note**: If you use the object as string, you will get an array of uids of the pages found in a readable way. Example: `<?php echo $related_pages ?>`

### Options

You can control which pages are searched for and which pages are found by a number of options, which should be supplied as an associative array upon instantiation of a new object:

```php
<?php
$options = array('visibleOnly' => false, 'recursionDepth' => 1);
$related_pages = relatedpages($options);
?>
```

This will find all pages, not only visible pages, and the depth of recursion is 1, which means 1 level down the page hierarchy starting at the root level.

#### Possible options

| Key         | Value   | Default | Description |
|-------------|---------|---------|-------------|
| VisibleOnly | Bool    | true    | If true, searches only visible pages, otherwise all. |
| StartURI    | String  | ''      | Start folder of search. If blank, starts at the root level. Use only folder names without numbers. No trailing slash. Example: '/folder/subfolder' |
| recursionDepth       | Integer | 0       | Depth of recursion into the folder structure. 0 means infinitely. Count starts at StartURI level, this means it is relative to the root level. |
| searchField       | String  | 'Tags'  | The name of the field in your content file which holds the keywords. |
| searchItems       | Array   | array() | A list of keywords which should be searched for. An empty array means that all keywords which are found in the 'Field' will be searched for. |

