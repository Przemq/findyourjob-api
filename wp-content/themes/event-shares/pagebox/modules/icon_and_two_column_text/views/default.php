<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconWithTwoColumnText $module
 */

$module      = $this->getModule();
$title       = $this->getInput( 'title' );
$description = $this->getEditor( 'description' )->getContent();
$table       = $this->getEditor( 'description' )->getContent();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container"><?php include_once( 'pageContent.php' ); ?> <a class="task-number" target="_blank"
                                                                          href="https://nurture.atlassian.net/browse/EV-18">EV-18</a>
        <div class="row" id="home-page-our-etfs">
            <div class="col-lg-2 offset-lg-1 col-sm-12 offset-sm-0 col-12 offset-0 svg-image">
                <!-- Generator: Adobe Illustrator 21.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     viewBox="-578 384.3 141.6 233.7" style="enable-background:new -578 384.3 141.6 233.7;"
                     xml:space="preserve">
                    <path class="st0" d="M-437.5,602.4l-54.2-102.9l53.9-102.4c3.2-6-2-12.8-9.6-12.8H-567c-7.7,0-12.8,6.8-9.6,12.8l53.9,101.6
                        l-54.2,103.8c-3.8,7.3,2.4,15.6,11.6,15.6h116.1C-439.9,618-433.7,609.7-437.5,602.4z M-547.7,593.3l40.3-77.2l40.7,77.2H-547.7z"></path>
                    </svg>
            </div>
            <div class="col-lg-4" id="left-column">
                <h4><?= $title ?></h4>
				<?= $description ?>
            </div>
            <div class="col-lg-4">
                <table class="table">
                    <tbody>
					<?php
					foreach ( $this->getRepeater( 'rows' ) as $index => $repeater ) : ?>
                        <tr>
                            <th><?= $repeater->getInput( 'rowBoldText' ); ?></th>
                            <td><?= $repeater->getInput( 'rowText' ); ?></td>
                        </tr>

						<?php
					endforeach;
					?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>