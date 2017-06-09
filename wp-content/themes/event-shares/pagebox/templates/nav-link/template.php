<?php
/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Template\FullWidth $this
 */
?>

<ul class="menu nav <?= $this->getClass() ?>">
	<?php if ( $this->hasSection( 'nav' ) ): ?>
		<?= $this->getSection( 'nav' ) ?>
	<?php endif; ?>
</ul>