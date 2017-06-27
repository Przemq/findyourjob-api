<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\TeamModule $module
 */

$module = $this->getModule();

?>
<?php
$numberOfSections = count( $this->getRepeater( 'tabs' ) );

// Sort new tab for repeater
$sectionArray = array();
$tempArray    = array();
foreach ( $this->getRepeater( 'tabs' ) as $index => $value ) {
	array_push( $tempArray, $value );
	if ( ( $index + 1 ) % 3 === 0 || $index === $numberOfSections - 1 ) {

		array_push( $sectionArray, $tempArray );
		$tempArray = array();
	}
}
?>
<div class="<?= $module->getClass() ?>">

    <div class="container">
		<?= createTaskLink( 'EV-24' ) ?>

        <div class="top col-6">
            <div class="row">
                <h3 class="title"><?= $this->getInput( 'title' ) ?></h3>
				<?php if ( $this->getInput( 'isDescriptionUnderTitleSwitch' )->getValue() ): ?>
                    <div class="description">
						<?= $this->getEditor( 'descriptionUnderTitle' )->getValue() ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>

        <!--        First Loop to dispaly first row-->
		<?php
		for ( $i = 0; $i < sizeof( $sectionArray ); $i ++ ): ?>
            <ul class="team-nav nav nav-tabs row" role="tablist">
				<?php $uniqeID = uniqid(); ?>
				<?php foreach ( $sectionArray[ $i ] as $index => $value ): ?>
					<?php
					$startElementClass = "";
					if ( $i == 0 && $index == 0 ) {
						$startElementClass = "active";
					}
					?>
                    <li class="nav-item col-6 col-lg-4">
                        <a class="nav-link <?= $startElementClass ?>" data-toggle="tab"
                           href="#tab-<?= $uniqeID . '' . $index ?>"
                           role="tab"><?= $value->getInput( 'teamTitle' ); ?>
                            <span><?= $value->getInput( 'jobTitle' ); ?></span></a>
                    </li>


				<?php endforeach;
				?>

            </ul>

            <div class="tab-content">
				<?php foreach ( $sectionArray[ $i ] as $index => $value ): ?>
					<?php
					$startElementClass = "";
					if ( $i == 0 && $index == 0 ) {
						$startElementClass = "active show";
					}
					?>
                    <div class="tab-pane fade <?= $startElementClass ?> " id="tab-<?= $uniqeID . '' . $index ?>"
                         role="tabpanel">
                        <div class="quote">
							<?= $value->getEditor( 'quote' )->getValue(); ?>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
								<?= $value->getEditor( 'leftDescriptionPanel' )->getValue(); ?>
                            </div>
                            <div class="col-12 col-lg-6 column">
								<?= $value->getEditor( 'rightDescriptionPanel' )->getValue(); ?>
                            </div>
                        </div>
                    </div>


				<?php endforeach;
				?>

            </div>
		<?php endfor ?>

    </div>

</div>
