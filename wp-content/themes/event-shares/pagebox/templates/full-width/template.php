<?php
/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Template\FullWidth $this
 */
?>

<div class="<?= $this->getClass() ?>">
	<?php if ( $this->hasSection( 'full' ) ): ?>
		<?= $this->getSection( 'full' ) ?>
	<?php endif; ?>
</div>