/**
 * Country & Investor modal cookies
 * Create cookies based on selected options (data-country/profile) from Country & Investor modal
 * Save cookie called 'country' & 'profile' with selected country and investor type
 * Reload page to use script in header and redirect to selected country
 * See country-investor.php to set it correctly
 * Requires js-cookie - check if this is added into bower.json, vendor-config.json and register_vendors.php
 */
var investorModal = $('#investor-modal');
investorModal.find('input.btn').click(function () {

    /**
     * Get selected values from data-country/profile
     * See Country & Investor PHP file for more details
     */
    var country = investorModal.find('.select-country a.active').data('country');
    var profile = investorModal.find('.select-profile a.active').data('profile');

    /**
     * Set cookies based on selected data-country/profile
     * Set expiration date to 30 days
     */
    Cookies.set('country', country, {expires: 30});
    Cookies.set('profile', profile, {expires: 30});

    /**
     * Reload page and use Vanilla script from Header to redirect to correct site
     */
    location.reload();
});

/**
 * Country & Investor modal functions to show & hide
 * triggerClass - this is a class for button which opens modal (in this example it is a '.top-header .container a.investor-modal-trigger')
 * modalClass - this is a class for modal (in this example it is a '.country-investor') - see Country & Investor modal PHP file
 */
function showModal(triggerClass, modalClass) {
    $(triggerClass).click(function (event) {
        event.preventDefault();
        $(modalClass).fadeIn();
    });
}

function closeModal(modal) {
    $(modal).on('click', function (e) {
        if (e.target !== e.currentTarget) return;
        $('.modal-container-overlay').fadeOut();
    });
}

/**
 * Take Country & Investor cookies
 * Set default value for modal trigger button
 */
var cookieCountry = Cookies.get('country'),
    cookieProfile = Cookies.get('profile'),
    country = 'Select country and ',
    investor = 'investor';

/**
 * Take correct text based on country cookie
 * Please see Country & Investor modal PHP file and take data-country (add it to 'case')
 * Save new country value
 */
switch (cookieCountry) {
    case 'uk':
        country = 'United Kingdom ';
        break;
    case 'ie':
        country = 'Ireland ';
        break;
    case 'je':
        country = 'Jersey ';
        break;
    case 'rw':
        country = 'Rest of World ';
        break;
}

/**
 * Take correct text based on profile cookie
 * Please see Country & Investor modal PHP file and take data-profile (add it to 'case')
 * Save new profile value
 */
switch (cookieProfile) {
    case 'private-client':
        investor = 'Private Client';
        break;
    case 'financial-adviser':
        investor = 'Financial Adviser';
        break;
    case 'charities':
        investor = 'Charities';
        break;
    case 'professional-advisers':
        investor = 'Professional Advisers';
        break;
}

/**
 * Set modal trigger text button
 * Change modal trigger text button into that from cookies
 * It will take values from previous two switch'es
 * Change class to correct one (.top-header .container a.investor-modal-trigger)
 */
$('.top-header .container a.investor-modal-trigger').text(country + investor);

showModal('.investor-modal-trigger', '.country-investor');

if (cookieCountry != undefined) {

    /**  Modal triggers in */
    showModal('.modal-investor-trigger-overlay', '.country-investor');
    showModal('.contact-modal-trigger', '.contact-modal');

    /** Modal triggers out */
    closeModal('.modal-container');
    closeModal('.close');
}

/**
 * Open country & investor modal function
 */
function openModal() {
    if (cookieCountry == undefined) {
        $('.country-investor').fadeIn();
    }
}

/**
 * Open country & investor modal after 10 seconds when on homepage
 * Open country & investor modal after 2 seconds when not on homepage
 */
if (window.location.pathname == '/') {
    setTimeout(openModal, 10000);
} else {
    setTimeout(openModal, 2000);
}

/**
 *  Open country & investor modal after click on any link except admin bar
 */
if (cookieCountry == undefined) {
    $('a').on('click', function (event) {
        if (($(this).parents('#wpadminbar').length < 1) && ($(this).parents('.country-investor').length < 1)) {
            event.preventDefault();
            $('.country-investor').fadeIn();
        }
    });
}