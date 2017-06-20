<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\InsightsFilters $module
 */

$module = $this->getModule();

$module = $this->getModule();
$hash = $module->getHash();
$uniqID = uniqid(rand(1, 999));
?>
<div class="<?= $module->getClass() ?>">
    <div class="container" id="sub-nav">
        <?= createTaskLink('EV-32') ?>
        <a href="#" class="nav-tabs-dropdown <?= $module->changeNav() ?>">Dropdown-nav</a>
        <ul class="nav-tabs-wrapper nav-tabs nav-tabs-horizontal list-inline row no-gutters <?= $module->changeNavTabs() ?>"
            role="tablist">
            <?php for ($i = 0; $i < 6; $i++) : ?>
                <li class="nav-item custom-nav-item list-inline-item <?= $module->colsTabs() ?>">

                    <a <?php echo ($i == 0) ? 'class="active"' : '' ?>
                            href="#htab-<?= $i ?>-<?= $uniqID ?>" data-toggle="tab" aria-expanded="true">In the media <?= $i ?></a></li>
            <?php endfor ?>
        </ul>
        <div class="tab-content">
            <?php for ($i = 0; $i < 6; $i++) : ?>
                <div role="tabpanel"
                     class="tab-pane<?php echo ($i == 0) ? ' active' : '' ?> <?= $module->paddingControl() ?>"
                     id="htab-<?= $i ?>-<?= $uniqID ?>">
                    <div class="text-content justify-content-center">
                        <p><?= $i ?></p>
                    </div>
                </div>
            <?php endfor ?>
        </div>
        <div class="row filter">
            <div class="filter-by col-5 col-lg-3">filter by</div>
            <div class="buttons col-7 col-lg-9">
                <div class="custom-dropdown dropdown">
                    <a class="dropdown-button " data-toggle="dropdown">
                        Category
                    </a>
                    <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Category 1</a>
                        <a class="dropdown-item" href="#">Category 2</a>
                        <a class="dropdown-item" href="#">Category 3</a>
                    </div>
                </div>
                <div class="custom-dropdown dropdown">
                    <a class="dropdown-button " data-toggle="dropdown">
                        Topic
                    </a>
                    <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Topic 1</a>
                        <a class="dropdown-item" href="#">Topic 2</a>
                        <a class="dropdown-item" href="#">Topic 3</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>