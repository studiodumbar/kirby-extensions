<figure class="FigureImage">

	<?php // [1] Regular image; resized thumb (thumb.dev.width) ?>
	<?php if($lazyload == false && c::get('resrc') == false): ?>
		<img src="<?php echo $thumburl; ?>" width="<?php echo $image->width(); ?>" height="<?php echo $image->height(); ?>" class="FigureImage-item<?php if($class): echo ' ' . $class; endif; ?>" alt="<?php if($alt): echo $alt; endif; ?>" />
	<?php endif; ?>

	<?php // [2] Lazyload image; resized thumb (thumb.dev.width)  ?>
	<?php if($lazyload == true && c::get('resrc') == false): ?>
		<div class="FigureImage-lazy">
			<img data-src="<?php echo $thumburl; ?>" src="/assets/images/loader.gif" class="FigureImage-item<?php if($class): echo ' ' . $class; endif; ?>" alt="<?php if($alt): echo $alt; endif; ?>" />
		</div>
	<?php endif; ?>

	<?php // [3] Resrc image; full size thumb (let resrc resize and optimize the biggest possible thumb!) ?>
	<?php if($lazyload == false && c::get('resrc') == true): ?>
		<img data-src="<?php echo 'http://' . c::get('resrc.plan') . '/' . c::get('resrc.params') . '/' . $thumburl; ?>" width="<?php echo $image->width(); ?>" height="<?php echo $image->height(); ?>" class="FigureImage-item resrc<?php if($class): echo ' ' . $class; endif; ?>" alt="<?php if($alt): echo $alt; endif; ?>" />
	<?php endif; ?>

	<?php // [4] Lazyload + resrc image; full size thumb (let resrc resize and optimize the biggest possible thumb!) ?>
	<?php if($lazyload == true && c::get('resrc') == true): ?>
		<div class="FigureImage-lazy">
			<img data-src="<?php echo 'http://' . c::get('resrc.plan') . '/' . c::get('resrc.params') . '/' . $thumburl; ?>" src="/assets/images/loader.gif" class="FigureImage-item js-resrcIsLazy<?php if($class): echo ' ' . $class; endif; ?>" alt="<?php if($alt): echo $alt; endif; ?>" />
		</div>
	<?php endif; ?>

	<?php if($caption): ?>
		<figcaption class="FigureImage-caption">
			<?php echo kirbytext($caption); ?>
		</figcaption>
	<?php endif; ?>

</figure>
