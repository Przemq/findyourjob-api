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
            <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-33">EV-33</a>
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs hidden-sm-down" role="tablist" style="border-bottom-color: black">
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
                <div class="col-md-6 ">
                    <p>FILTER</p>
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle filter"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">Category 1</a>
                                <a class="dropdown-item" href="#">Category 2</a>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle filter"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Topic
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#">Topic 1</a>
                            <a class="dropdown-item" href="#">Topic 2</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>