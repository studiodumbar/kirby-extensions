<?php
/**
 * Figure
 * ----
 * Custom (multi)figure tag in kirbytext
 *
 * What it does:
 * Generates an image in a figure, with a lot of possible options. Multiple images
 * within a figure is one of the possibilities. Use a 'relative' width (i.e. 1of3)
 * for responsive widths.
 *
 * Usage:
 * 1) (figure: myimage.jpg width: 1of3)
 * 2) (figure: myimage.jpg width: 1of3 caption: Nice figure caption!)
 * 3) (figure: myimage.jpg griditem: true caption: Single image in a multifigure grid)
 * 4) (figure: myimage.jpg width: 2of3 height: 200 crop: true caption: Nice figure caption!)
 * 5) (figure: myimage.jpg width: width: 2of3 align: center)
 * 6) (figure: myimage1.jpg | myimage2.jpg | myimage3.jpg width: 1of3 | 1of3 | 1of3 break: medium gutter: percentage)
 */

kirbytext::$tags['figure'] = array(
	'attr' => array(
		// Basics
		'caption',
		// Widths
		'width',
		// Cropping and quality
		'crop',
		'cropratio',
		'upscale',
		'quality',
		// CSS class setting
		'break',
		'gutter',
		'align',
		'griditem',
		// Single figure specific
		'height',
		'alt',
		),
	'html' => function($tag) {

		$images = $tag->attr('figure');

		// check if the figure has multiple images to output, check for pipe character: |
		if(strpos($images,'|') === false) {
			$is_multifigure = false;
			$images = array($images); // set the one images as the first in an images array
		}
		else {
			$is_multifigure = true;
			$images = str::split(str_replace(' ', '', $images), '|'); // set all images to the array
		}

		// check if there images passed to the array
		if(empty($images)) return false;

		// build array of image objects
		foreach($images as $img) {
			$imgObj = $tag->file($img);
			if($imgObj) $imageresult[] = $imgObj;
		}

		// check of array of images has real items (after building objects)
		if(empty($imageresult)) return false;

		// set variables for both single and multi figures
		$upscale    = $tag->attr('upscale');
		$quality    = $tag->attr('quality', c::get('thumb.quality', 100));
		$caption    = $tag->attr('caption');
		$break      = $tag->attr('break', c::get('figureimage.break', 'small'));
		$gutter     = $tag->attr('gutter', c::get('figureimage.gutter', 'default'));
		$offset     = $tag->attr('offset');
		$align      = $tag->attr('align');
		$griditem   = $tag->attr('griditem');
		$alt        = $tag->attr('alt');
		$crop       = $tag->attr('crop');
		$cropratio  = $tag->attr('cropratio');
		$height     = $tag->attr('height');

		// Get width of image(s)
		if($is_multifigure) {
			$widths = str::split(str_replace(' ', '', $tag->attr('width')), '|');
		}
		else {
			$widths = str::split($tag->attr('width'));
			if (empty($widths)) $widths = null;
		}

		// Set classes used in layout grid
		if(count($imageresult) > 1 || $tag->attr('gutter') || isset($griditem)) {
			$gridclass = ' Grid Grid--withGutter' . (($gutter == 'percentage') ? 'Percentage' : '');
			$gridcellclass = 'Grid-cell ';
		}
		else {
			$gridclass = '';
			$gridcellclass = '';
		}

		// Set break class used in layout grid
		if(count($imageresult) > 1) {
			$breakclass = ' Grid--breakFrom'.ucfirst($break);
		}
		else {
			$breakclass = '';
		}

		// Set possible align classes
		if(isset($align)) {
			$alignclass = ' FigureImage--align'.ucfirst($align); // Add capitalized align class (IE: Grid--alignCenter)
		}
		else {
			$alignclass = '';
		}

		// Add figure DOM element with appended classes
		$figure = new Brick('figure');
		$figure->addClass('FigureImage' . $gridclass . $breakclass . $alignclass);

		// If feed/rss page, lazyload is always disable
		if(kirby()->request()->path()->last() == 'feed') {
			$lazyload = false;
		}
		// Else lazyload variable is set in config
		else {
			$lazyload = c::get('lazyload', false);
		}

		// Create markup for every image
		$i = 0;
		foreach($imageresult as $image) {

			// Initialize wrapper divs if lazyloading
			if($lazyload == true) {
				// Only init griddiv when $gridcellclass or one or more width is set
				if($gridcellclass != '' || count($widths) > 0) {
					$griddiv = new Brick('div');
				}
				$lazydiv = new Brick('div');
				$lazydiv->addClass('FigureImage-lazy');
			}

			// set widths of all images
			$width = $widths[$i];

			// If there is one or more width set, use width variable(s)
			if(count($widths) > 0) {
				// the first part (the 1 of 3)
				$classgridpart = str::substr($width, 0, 1);
				// the total (the 3)
				$classgridtot = str::substr($width, 3, 1);
				// Add extra griddiv for lazyload
				if($lazyload == true) {
					// Set the class for the image
					$class = 'FigureImage-item';
					// Set the class on the grid div
					if(isset($griddiv)) {
						$griddiv->addClass($gridcellclass.'u-size' . $width . '--' . $break);
					}
				}
				else {
					$class = 'FigureImage-item ' . $gridcellclass . 'u-size' . $width . '--' . $break;
				}
			}
			else {
				// Add extra griddiv for lazyload
				if($lazyload == true) {
					// Set the class for the image
					$class = 'FigureImage-item';
					// Set the class for the grid div
					if(isset($griddiv)) {
						$griddiv->addClass($gridcellclass);
					}
				}
				else {
					$class = 'FigureImage-item ' . $gridcellclass . 'u-size' . $width . '--' . $break;
				}
			}

			// without resrc, maximize thumb width, for speedier loading of page!
			if(c::get('resrc') == false) {
				$thumbwidth = c::get('thumb.dev.width', 800);
			}
			else {
				// with resrc use maximum (original) image width
				$thumbwidth = null;
			}

			// if the crop variable is explicitly set to 'false' string *and*
			// no cropratio is set, the crop variable is always set to false
			if($crop == 'false' && !isset($cropratio)) {
				$crop = false;
			}

			// when a cropratio is set, calculate the ratio based height
			if(isset($cropratio)) {
				// if resrc is enabled (and therefor $thumbwidth is not set (e.g. `null`),
				// to use max width of image!), set thumbwidth to width of original image
				if(!isset($thumbwidth)) {
					$thumbwidth = $image->width();
				}
				// if cropratio is a fraction string (e.g. 1/2), convert to decimal
				// if(!is_numeric($cropratio)) {
				if(strpos($cropratio, '/') !== false) {
					list($numerator, $denominator) = str::split($cropratio, '/');
					$cropratio = $numerator / $denominator;
				}
				// calculate new thumb height based on cropratio
				$thumbheight = round($thumbwidth * $cropratio);
				// if a cropratio is set, the crop variable is always set to true
				$crop = true;
			}
			else {
				$thumbheight = null; // max height of image
			}

			$thumburl = thumb($image,array(
				'width'   => $thumbwidth,
				'height'  => $thumbheight,
				'quality' => $quality,
				'crop'    => $crop,
			), false);

			// [1] Regular image; resized thumb (thumb.dev.width)
			if($lazyload == false && c::get('resrc') == false) {

				$imagethumb = html::img($thumburl,array(
					// 'width'     => $image->width(),
					// 'height'    => $image->height(),
					'class'     => $class,
					'alt'       => html($alt)
					)
				);

			}

			// [2] Lazyload image; resized thumb (thumb.dev.width)
			if($lazyload == true && c::get('resrc') == false) {

				$imagethumb = html::img('/assets/images/loader.gif',array(
					'data-src'  => $thumburl,
					// 'width'     => $image->width(),
					// 'height'    => $image->height(),
					'class'     => $class,
					'alt'       => html($alt)
					)
				);

			}

			// [3] Resrc image; full size thumb (let resrc resize and optimize the biggest possible thumb!)
			if($lazyload == false && c::get('resrc') == true) {

					$imagethumb = html::img('',array(
						'data-src'  => 'http://' . c::get('resrc.plan') . '/' . c::get('resrc.params') . '/' . $thumburl,
						// 'width'     => $image->width(),
						// 'height'    => $image->height(),
						'class'     => $class . ' resrc',
						'alt'       => html($alt)
						)
					);

			}

			// [4] Lazyload + resrc image; full size thumb (let resrc resize and optimize the biggest possible thumb!)
			if($lazyload == true && c::get('resrc') == true) {

				$imagethumb = html::img('/assets/images/loader.gif',array(
					'data-src'  => 'http://' . c::get('resrc.plan') . '/' . c::get('resrc.params') . '/' . $thumburl,
					// 'width'     => $image->width(),
					// 'height'    => $image->height(),
					'class'     => $class . ' js-resrcIsLazy',
					'alt'       => html($alt)
					)
				);

			}

			// Output different markup, depending on lazyload or not
			if($lazyload == true) {
				$lazydiv->append($imagethumb);
				if(isset($griddiv)) {
					$griddiv->append($lazydiv);
					$figure->append($griddiv);
				}
				else {
					$figure->append($lazydiv);
				}
			}
			else {
				$figure->append($imagethumb);
			}

			$i++;

		}

		// Add caption
		if(!empty($caption)) {
			// Also add break class to figcaption if alignment is set to image
			if(count($widths) > 0 && isset($align)) {
				$figure->append('<figcaption class="FigureImage-caption u-size' . $width . '--' . $break  . '">' . kirbytext($caption) . '</figcaption>');
			}
			else {
				$figure->append('<figcaption class="FigureImage-caption">' . kirbytext($caption) . '</figcaption>');
			}
		}

		return $figure;

	}
);

?>
