<?php

/**
 * RelatedPages plugin for Kirby CMS Version 2
 *
 * The RelatedPages plugin provides an easy, but flexible way of
 * incorporating links (or other data) of related pages to the
 * current page. The relationsship is considered by keywords in an
 * arbitrary field of the content file.
 *
 * @author Uwe Gehring <uwe@imap.cc>
 * @copyright 2014 Uwe Gehring
 * @version 2.1
 *
 *
 * Installation:
 * =============
 *
 * Save this file as relatedpages.php into the subfolder relatedpages of the
 * plugins folder of Kirby 2.
 *
 *
 * Basic usage:
 * ============
 *
 * <?php $relpages = relatedpages(); ?>
 *
 * Example:
 *
 * <ul>
 *   <?php foreach(relatedpages() as $relpage): ?>
 *     <li><a href="<?php echo $relpage->url() ?>"><?php echo $relpage->title() ?></a></li>
 *   <?php endforeach ?>
 * </ul>
 *
 *
 * Return Value:
 * =============
 *
 * The return value of relatedpages() is a page collection object with all
 * related pages.
 *
 *
 * Options:
 * ========
 *
 * You can control which pages are searched for and which pages are found by
 * a number of options, which should be supplied as an associative array.
 *
 * <?php $MyRelatedPages = relatedpages($Options); ?>
 *
 * Example: $Options = array('visibleOnly' => false, 'recursionDepth' => 1);
 *
 * This will find all pages, not only visible pages, and the depth of recursion
 * is 1, which means 1 level down the page hyrachie starting at the root level.
 *
 * Possible options (with defaults values in parenthesis):
 * -------------------------------------------------------
 *
 * 'visibleOnly'     (true)     If true, searches only visible pages, otherwise all.
 *
 * 'startURI'        ('')       Start folder of search. If blank, starts at the root
 *                              level. Use only folder names without numbers. No
 *                              trailing slash. Example: '/folder/subfolder'
 *
 * 'recursionDepth'  (0)        Depth of recursion into the folder structure. 0
 *                              means infinitely. Count starts at StartURI level,
 *                              this means it is relative to the root level.
 *
 * 'searchField'     ('Tags')   The name of the field in your content files which
 *                              holds the keywords.
 *
 * 'searchItems'     (array())  A list of keywords which should be searched for. An
 *                              empty array means that all keywords will be searched
 *                              for.
 *
 * For backward compatibility, you can still use the old option names:
 *
 * 'VisibleOnly'
 * 'StartURI'
 * 'Depth'
 * 'Field'
 * 'Items'
 *
 */

function relatedpages($options = array()) {

/**
 * Default options
 */
  $defaults = array(
    'visibleOnly'     => true,
    'startURI'        => '',
    'recursionDepth'  => '0',
    'searchField'     => 'Tags',
    'searchItems'     => array(),
  );

/**
 * Backward compatibility
 */
  if (array_key_exists('VisibleOnly',$options)) { $options['visibleOnly'] = $options['VisibleOnly'];unset($options['VisibleOnly']); }
  if (array_key_exists('StartURI',$options)) { $options['startURI'] = $options['StartURI'];unset($options['StartURI']); }
  if (array_key_exists('Depth',$options)) { $options['recursionDepth'] = $options['Depth'];unset($options['Depth']); }
  if (array_key_exists('Field',$options)) { $options['searchField'] = $options['Field'];unset($options['Field']); }
  if (array_key_exists('Items',$options)) { $options['searchItems'] = $options['Items'];unset($options['Items']); }

/**
 * Merge default and given options
 */
  $options = array_merge($defaults,$options);

/**
 * Get pages from $site->children()->index(), either all or only visible pages
 */
  $allPages = site()->children()->index();
  if ($options['visibleOnly']) { $allPages = $allPages->visible(); }

/**
 * Get the items to search for from the current active page, but only if no items supplied
 * Items are get from the field supplied or from the field 'Tags'
 */
  if (count($options['searchItems']) == 0) { $options['searchItems'] = str::split(site()->activePage()->content()->get(str::lower($options['searchField']))); }

  $pages = new Collection();

/**
 * Main loop #1: Go through all pages from index
 */
    foreach ($allPages as $page) {

/**
 * Skip current active page
 */
      if ($page->isActive()) continue;

/**
 * Skip page if startURI is given and does not match. Instead of $page->uri(), it might be better to look in $page->id()
 * which is the untranslated uri(). Needs to be tested in multilanguage setups.
 */
      if (($options['startURI']) && !stristr('/'.$page->uri(),$options['startURI']) ) continue;

/**
 * Skip page if recursionDepth is given and depth of page is greater than this limit
 */
      if (($options['recursionDepth']) && $page->depth() > substr_count($options['startURI'],'/') + $options['recursionDepth']) continue;

/**
 * Main loop #2: Go through all items to search for
 */
      foreach ($options['searchItems'] as $item) {

/**
 * Save page if the item appears in the corresponding field, from where we have got the items
 */
        if (in_array($item,str::split($page->content()->get(str::lower($options['searchField']))))) { $pages->data[$page->id()] = $page; }
      }
    }

/**
 * Return result collection of page objects
 */
  return $pages;
}

?>
