<?php // [1] Regular src only image; resized thumb (thumb.dev.width) ?>
<?php if($bgimage == false && c::get('resrc') == false): ?>
	src="<?php echo $thumburl; ?>"
<?php endif; ?>

<?php // [2] Regular background image; resized thumb (thumb.dev.width) ?>
<?php if($bgimage == true && c::get('resrc') == false): ?>
	style="background-image:url(<?php echo $thumburl; ?>);"<?php if($class): echo ' class="' . $class . '"'; endif; ?>
<?php endif; ?>

<?php // [3] Resrc background image; full size thumb (let resrc resize and optimize the biggest possible thumb!) ?>
<?php if($bgimage == true && c::get('resrc') == true): ?>
	data-src="<?php echo 'http://' . c::get('resrc.plan') . '/' . c::get('resrc.params') . '/' . $thumburl; ?>" class="<?php if($class): echo $class . ' '; endif; ?>resrc"
<?php endif; ?>
