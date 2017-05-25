<footer>
    <?php include_once('pageContent.php');?>
    <div class="container">
        <div class="row" id="footer">
            <div class="col-md-3 col-sm-10" id="left-column"><?php echo $pageContent['footer_left_text']; ?></div>
            <div class="col-md-6 col-sm-10" id="right-column"><?php echo $pageContent['footer_right_text']; ?></div>
        </div>
        <div class="row" id="footer-nav">
            <div class="col-md-3 col-sm-4 col-6" id="social-wrapper">
                <img src="<?= THEME_IMAGES_URI; ?>/Facebook%20Green%20Icon-01-01.svg">
                <img src="<?= THEME_IMAGES_URI; ?>/Twitter%20Green%20Icon-01-01.svg">
                <img src="<?= THEME_IMAGES_URI; ?>/Linkedin%20Green%20Icon-01-01.svg">
            </div>
            <div class="col-md-9 col-sm-6 col-6" id="menu-items">
                <ul>
                    <li id="about-us">
                        <a href="#"><?php echo $pageContent['footer_menu_item1']; ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $pageContent['footer_menu_item2']; ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $pageContent['footer_menu_item3']; ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $pageContent['footer_menu_item4']; ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $pageContent['footer_menu_item5']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3" id="copyright"><?php echo $pageContent['copyright']; ?></div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?></body></html>