<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\Fund $module
 */

$module      = $this->getModule();
$isin        = $this->getInput( 'isin' );
$environment = "development";
$env         = "dev";
$culture     = "en-GB";
switch ( WP_ENVIRONMENT ) {
	case "DEV" | "dev":
		$environment = "development";
		$env         = "dev";
		break;
	case "STG":
		$environment = "staging";
		$env         = "api-uk18";
		break;
	case "PROD":
		$environment = "production";
		$env         = "api-uk18";
		break;
}
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <link rel="stylesheet" type="text/css"
              href="https://<?= $env; ?>.kurtosys.io/tools/ksys407/static/ksys407_style_<?= $environment; ?>.css">
        <div class="ksys-wrapper">
            <div class="ksys407_tools_fund_page" isin="<?= $isin; ?>" culture="en"
                 baseurl="https://api-uk18.kurtosys.io/tools/ksys407/">
            </div>
        </div>
        <script src="https://api-uk18.kurtosys.io/tools/ksys407/static/ksys407_tools_<?= $environment; ?>.js"></script>
    </div>
</div>