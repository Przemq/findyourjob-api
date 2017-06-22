<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\TeamModule_Version2 $module
 */

$module = $this->getModule();

?>
<?php

$sectionArray = array();
// Sort tabs in arrays first array (2 elements),rest 4 items in array
if ( $this->getRepeater( 'tabs' )->count() === 1 ) {
	array_push( $sectionArray, $this->getRepeater( 'tabs' )[0] );
} else {
	$array = array( $this->getRepeater( 'tabs' )[0], $this->getRepeater( 'tabs' )[1] );
	array_push( $sectionArray, $array );
	$tempArray = array();
	$counter   = 0;

	for ( $i = 2; $i < sizeof( $this->getRepeater( 'tabs' ) ); $i ++ ) {
		array_push( $tempArray, $this->getRepeater( 'tabs' )[ $i ] );
		$counter ++;
		if ( $counter === 4 ) {
			array_push( $sectionArray, $tempArray );
			$tempArray = array();
			$counter   = 0;
		} elseif ( $i === sizeof( $this->getRepeater( 'tabs' ) ) - 1 ) {
			array_push( $sectionArray, $tempArray );
			$tempArray = array();
		}
	}
}


?>
<div class="<?= $module->getClass() ?>">

    <div class="container">
        <div class="row relative">
			<?= createTaskLink( 'EV-24' ) ?>

            <div class="top main-description col-6">
                <div class="row ">
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
			for ( $index = 0; $index < sizeof($sectionArray); $index ++ ):

				?>

				<?php for ( $i = 0; $i < sizeof( $sectionArray[ $index ] ); $i ++ ):
				$tab = $sectionArray[ $index ][$i];
				$uniqeID = uniqid();
//				?>


                <div data-size="<?= $index ?>" class="col-lg-3 col-md-3 col-sm-12 team-member">
                    <a class="nav-link" data-toggle="team-tab"
                       href="#tab-<?= $uniqeID ?>"><?= $tab->getInput( 'teamTitle' ) ?>
                        <span><?= $tab->getInput( 'jobTitle' ) ?></span></a>

                    <div class="tab-team-panel fade " id="tab-<?= $uniqeID ?>"
                         role="tabpanel">
                        <div class="quote">
							<?= $tab->getEditor( 'quote' )->getValue(); ?>
                        </div>
                        <div class="row">
                            <div class="col-6">
								<?= $tab->getEditor( 'leftDescriptionPanel' )->getValue(); ?>
                            </div>
                            <div class="col-6">
								<?= $tab->getEditor( 'rightDescriptionPanel' )->getValue(); ?>
                            </div>
                        </div>
                    </div>

                </div>
			<?php endfor; ?>
			<?php endfor; ?>

        </div>
    </div>
</div>
