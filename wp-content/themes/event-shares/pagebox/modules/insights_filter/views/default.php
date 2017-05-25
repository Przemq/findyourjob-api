<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\InsightsFilters $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container-fluid">
        <div class="container" id="insights-filter">
            <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-32">EV-32</a>
            <div class="row border-bottom">
                <div class="col-lg-6 col-md-12">
                    <ul class="nav nav-tabs hidden-sm-down no-border" role="tablist" style="border-bottom-color: black">
                        <li class="nav-item single-li-item">
                            <a class="nav-link active single-link" data-toggle="tab" href="#" role="tab">Board of
                                Advisors</a>
                            <div class="line">
                            </div>
                        </li>
                        <li class="nav-item single-li-item">
                            <a class="nav-link single-link" data-toggle="tab" href="" role="tab">In the Media</a>
                            <div class="line hidden">
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-sm-6 col-6 col-md-12"><p id="filter-by">filter by</p></div>
                <div class="col-lg-2 col-sm-6 col-6">
                    <div class="custom-dropdown dropdown">
                        <a class="dropdown-button" data-toggle="dropdown">
                            Category
                        </a>
                        <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Category 1</a>
                            <a class="dropdown-item" href="#">Category 2</a>
                            <a class="dropdown-item" href="#">Category 3</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 offset-sm-6 col-6 offset-md-0 offset-6">
                    <div class="custom-dropdown dropdown">
                        <a class="dropdown-button" data-toggle="dropdown">
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
</div>