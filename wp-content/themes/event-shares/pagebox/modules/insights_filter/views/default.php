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
                            <a class="nav-link active single-link" data-toggle="tab" href="#" role="tab" >Board of Advisors</a>
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
                <div class="col-md-4 btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Category
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">HTML</a></li>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">JavaScript</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Category
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">HTML</a></li>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">JavaScript</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>