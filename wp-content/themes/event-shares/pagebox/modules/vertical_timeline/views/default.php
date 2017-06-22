<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\VerticalTimeLine $module
 */

$module = $this->getModule();
$headerText = $this->getInput('headerText')->getValue();
$description = $this->getEditor('description')->getValue();
$isImageBackground = $this->getInput('isImageBackground')->getValue();
$imageBackground = $this->getMedia('imageBackground')->getImage()->getUrl();

?>
<div class="<?= $module->getClass() ?>">
    <div class="container"<?php if ($isImageBackground) echo 'style="background-image:url(' . $imageBackground . ');background-size:cover"' ?>>
        <?= createTaskLink('EV-63') ?>
        <div class="row">
            <div class="col-12 header"><h4><?= $headerText ?></h4></div>
            <div class="col-6 mx-auto description"><?= $description ?></div>
        </div>

        <!-- timeline -->
        <div class="row">
            <div class="timeline">
                <ul class="days">
                    <?php foreach ($this->getRepeater('eventRepeater') as $key => $single):
                        /* @var \Nurture\Pagebox\Module\Scope $single */
                        $eventHeader = $single->getInput('eventHeader')->getValue();
                        $eventDescription = $single->getEditor('eventDescription')->getValue();
                        $enableInternalLink = $single->getInput('enableInternalLink')->getValue();
                        $internalUrl = $single->getSelect('internalUrl')->getValue()['permalink'];
                        $externalUrl = $single->getInput('externalUrl')->getValue();
                        $enableButton = $single->getInput('enableButton')->getValue();
                        $buttonText = $single->getInput('buttonText')->getValue();
                        ?>
                        <li class="day">
                            <div class="events">
                                <h4><?= $eventHeader ?></h4>
                                <div class="col-12"><?= $eventDescription ?></div>
                                <a href="<?= $enableInternalLink ? $internalUrl : $externalUrl; ?>"
                                   class="button" <?php if (!$enableButton) echo 'style="display:none;"' ?>><?= $buttonText ?></a>
                            </div>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- end timeline -->

    </div>
</div>