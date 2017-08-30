<?php get_header(); ?>

    <div class="container page404">
        <div class="row">
            <div class="col-12">
                <h2 class="page404__heading">404</h2>
                <h3 class="page404__subHeading"> PAGE NOT FOUND</h3>
                <br>
                <p class="page404__paragraph">We’re sorry, the page you were looking for doesn’t exist or another
                    error occured.</p>
                <p class="page404__paragraph list">This could be because:
                <br>
                <br>
                <ul>
                    <li>1. There is a error in the URL you have entered into your browser. Please check the spelling and
                        try again
                    </li>
                    <li>2. The page has been deleted or moved.</li>
                </ul>

                </p>
                <p class="page404__paragraph">You can either <a style="text-decoration: underline;" href="javascript:history.back()">go back</a> or
                    head over to the <a style="text-decoration: underline;" href="<?php HOME_URL ?>/">homepage</a> to choose a new
                    direction. <br>
                    Alternatively please <a style="text-decoration: underline;" href="<?php HOME_URL ?>/get-in-touch/">contact us</a>.</p>
            </div>
        </div>
    </div>

<?php get_footer();