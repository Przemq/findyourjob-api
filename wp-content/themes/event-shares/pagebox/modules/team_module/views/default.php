<?php
use Nurture\Pagebox\Module\Fields\Api\RepeaterNode;

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\TeamModule $module
 *
 */

$module = $this->getModule();
$isFloutVisible = $this->getInput('flyoutVisible')->getValue();

?>
<?php
$numberOfSections = count($this->getRepeater('tabs'));

// Sort new tab for repeater
$sectionArray = array();
$tempArray = array();
$sectionArrayMobile = array();
$tempArrayMobile = array();
foreach ($this->getRepeater('tabs') as $index => $value) {
    array_push($tempArray, $value);
    array_push($tempArrayMobile, $value);
    if (($index + 1) % 4 === 0 || $index === $numberOfSections - 1) {
        array_push($sectionArray, $tempArray);
        $tempArray = array();
    }

    if (($index + 1) % 2 === 0 || $index === $numberOfSections - 1) {
        array_push($sectionArrayMobile, $tempArrayMobile);
        $tempArrayMobile = array();
    }
}
?>
<div class="<?= $module->getClass() ?>">

    <div class="container">
        <?= createTaskLink('EV-24') ?>

        <div class="top col-12 col-sm-12 col-md-6">
            <div class="row">
                <h3 class="title"><?= $this->getInput('title') ?></h3>
                <?php if ($this->getInput('isDescriptionUnderTitleSwitch')->getValue()): ?>
                    <div class="description">
                        <?= apply_filters('the_content', $this->getEditor('descriptionUnderTitle')->getValue()) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!--        Desktop  -->
        <div class="hidden-sm-down">
            <?php
            for ($i = 0; $i < sizeof($sectionArray); $i++): ?>
                <ul class="team-nav nav nav-tabs row" role="tablist">
                    <?php $uniqeID = uniqid(); ?>
                    <?php foreach ($sectionArray[$i] as $index => $value):
                        /** @var $value RepeaterNode */
                        ?>
                        <?php
                        $startElementClass = "";
                        if ($i == 0 && $index == 0) {
                            $startElementClass = "active";
                        }
                        ?>
                        <li class="nav-item col-3">
                            <a data-index="<?= $index ?>" class="nav-link <?= $startElementClass ?>" data-toggle="tab"
                               href="#tab-<?= $uniqeID . '' . $index ?>"
                               role="tab"><?= $value->getInput('teamTitle'); ?>
                                <span><?= $value->getInput('jobTitle'); ?></span>
                            </a>
                        </li>


                    <?php endforeach; ?>
                </ul>
                <?php if ($isFloutVisible): ?>
                    <div class="tab-content">
                        <?php foreach ($sectionArray[$i] as $index => $value):
                            ?>
                            <?php
                            $startElementClass = "";
                            if ($i == 0 && $index == 0) {
                                $startElementClass = "active show";
                            }
                            ?>
                            <div class="tab-pane fade <?= $startElementClass ?> " id="tab-<?= $uniqeID . '' . $index ?>"
                                 role="tabpanel">
                                <div class="quote">
                                    <?= $value->getEditor('quote')->getValue(); ?>

                                </div>
                                <div class="row">
                                    <?php $enableImage = $value->getInput("imageSwitch")->getValue(); ?>
                                    <?php if ($enableImage): ?>
                                        <div class="col-lg-4">
                                            <img src="<?= $value->getMedia('image')->getImage()->getUrl() ?>"
                                                 alt="member photo"/>
                                        </div>
                                    <?php endif ?>
                                    <div class="col-12 <?php if ($enableImage) echo 'col-lg-4'; else echo 'col-lg-6' ?>">
                                        <?= $value->getEditor('leftDescriptionPanel')->getValue(); ?>
                                    </div>
                                    <div class="col-12 <?php if ($enableImage) echo 'col-lg-4'; else echo 'col-lg-6' ?> column">
                                        <?= $value->getEditor('rightDescriptionPanel')->getValue(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                        ?>
                    </div>
                <?php endif; ?>
            <?php endfor ?>
        </div>
        <div class="hidden-md-up">
            <?php
            for ($i = 0; $i < sizeof($sectionArrayMobile); $i++): ?>
                <ul class="team-nav nav nav-tabs row" role="tablist">
                    <?php $uniqeID = uniqid(); ?>
                    <?php foreach ($sectionArrayMobile[$i] as $index => $value): ?>
                        <?php
                        $startElementClass = "";
                        if ($i == 0 && $index == 0) {
                            $startElementClass = "active";
                        }
                        ?>
                        <li class="nav-item col-6">
                            <a data-index="<?= $index ?>" class="nav-link <?= $startElementClass ?>" data-toggle="tab"
                               href="#tab-<?= $uniqeID . '' . $index ?>"
                               role="tab"><?= $value->getInput('teamTitle'); ?>
                                <span><?= $value->getInput('jobTitle'); ?></span></a>
                        </li>


                    <?php endforeach;
                    ?>

                </ul>

                <div class="tab-content">
                    <?php foreach ($sectionArrayMobile[$i] as $index => $value):
                        /** @var $value RepeaterNode */ ?>
                        <?php
                        $startElementClass = "";
                        if ($i == 0 && $index == 0) {
                            $startElementClass = "active show";
                        }
                        ?>
                        <div class="tab-pane fade <?= $startElementClass ?> " id="tab-<?= $uniqeID . '' . $index ?>"
                             role="tabpanel">
                            <div class="quote">
                                <?= $value->getEditor('quote')->getValue(); ?>
                            </div>
                            <div class="row">
                                <?php $enableImage = $value->getInput("imageSwitch")->getValue(); ?>
                                <?php if ($enableImage): ?>
                                    <div class="col-lg-4">
                                        <img src="<?= $value->getMedia('image')->getImage()->getUrl() ?>"
                                             alt="member photo"/>
                                    </div>
                                <?php endif ?>
                                <div class="col-12 col-lg-4">
                                    <?= $value->getEditor('leftDescriptionPanel')->getValue(); ?>
                                </div>
                                <div class="col-12 col-lg-4 column">
                                    <?= $value->getEditor('rightDescriptionPanel')->getValue(); ?>
                                </div>
                            </div>
                        </div>


                    <?php endforeach;
                    ?>

                </div>
            <?php endfor ?>
        </div>

    </div>

</div>
