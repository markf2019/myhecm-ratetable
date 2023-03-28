<?php
/*
Plugin Name: MyHECM Rate Table Plugin
Plugin URI:  https://www.myhecm.com
Description: MyHECM.com rate tables.
Version:     1.0
Author:      MRF
Author URI:  https://www.myhecm.com
*/

add_action( 'admin_menu', 'myhecm_rate_table_admin_menu' );
add_action( 'init', 'myh_rate_table_register_dependencies' );

/**
* @author     MRF
* @datetime   03/21/2023
* @purpose    Function to register scripts needed by the functions that output rate able admin functions HTML to the UI. The scripts are only enqueued when needed.
* @input      No inputs
* @output     No outputs
*
**/
function myh_rate_table_register_dependencies() {

	// Enqueuing style here instead of page where it's used so there's no style flicker when the calculator pages load.
    wp_enqueue_style('myh-rate-table-style', plugin_dir_url( __FILE__ ) . 'style.css' ); 

    // Registering admin page script here. It will enqueue only when the admin page is accessed to save resources.
    // wp_register_script( "myh-rate-table-admin-script", plugin_dir_url( __FILE__ ) . 'myhecm-ratetable.js', array('jquery') );
    // wp_localize_script( 'myh-rate-table-admin-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));   
}

// add_shortcode('date-today','myh_date_today');

add_shortcode('generate-home-page-rate-table-links','myh_home_page_rate_table_links');  

/**
* @author     MRF
* @datetime   03/23/2023
* @purpose    Rate table links for the home page.
*
**/
function myh_home_page_rate_table_links () {
	
	$html = '';

	$html .= "<div id ='myh_homepageratetablelinkswrapper'>";	

	// $html .= "<h3>Check Today's Interest Rates</h3>";
	$html .= "<div id ='myh_homepageratetablelinks'>";
	$html .= "<h3>Current Interest Rates</h3>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-refinance-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Refinance Mortgage Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-purchase-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Purchase Mortgage Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-home-equity-lines-of-credit-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Equity Line of Credit (HELOC) Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-equity-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Equity Loan Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/personal-loans/current-personal-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Personal Loan Rates</a></div>";
	$html .= "</div>";	

	$html .= "<div id ='myh_homepageratetableresources'>";
	$html .= "<h3>Calculators</h3>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/calculators/hecm-calculator-reverse-mortgage-calculator-2-0-page-1/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'>&nbsp;</span>HECM Reverse Mortgage Calculator</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/calculators/hecm-reverse-mortgage-purchase-calculator-2-0-page-1/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'>&nbsp;</span>HECM Reverse Mortgage for Purchase Calculator</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/calculators/download-a-free-excel-reverse-mortgage-calculator/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'><i class='fa fa-cloud-download'></i></span>Downloadable HECM Reverse Mortgage Calculator</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/reverse-mortgage-101/free-reverse-amortization-calculator/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'>&nbsp;</span>Reverse Amortization Calculator</a></div>";
	$html .= "</div>";	

	$html .= "</div>";		

	return $html;	
}


/**
*
*   Output date to front end.
* 
* 	@atts 	Format value to format the date.
*				
*/
function myh_date_today() {

	$date_time .= date('F j, Y'); 
	return $date_time;
} 

add_shortcode('generate-rate-table-links','myh_generate_rate_table_links');  

/**
* @author     MRF
* @datetime   03/23/2023
* @purpose    Rate table links for the rate table pages. Includes descriptive text.
*
**/
function myh_generate_rate_table_links ($atts, $content = null) {

	if ($atts['product'] == '') {
		$product = " mortgage interest rates ";
	}  else if ($atts['product'] == 'mortgage') { 
		$product = " mortgage interest rates ";
	}  else if ($atts['product'] == 'personal') { 
		$product = " personal loan interest rates ";
	}  else if ($atts['product'] == 'heloc') { 	
		$product = " HELOC interest rates ";			
	}  else if ($atts['product'] == 'homeequity') { 	
		$product = " home equity loan interest rates ";			
	} 

	$html = '';

	$html .= '<p><b>See below for ' . $product . ' available as of ' . myh_date_today() . '. </b>';
	$html .= 'You can use the links below to navigate to our other interest rate pages. Note that interest rates are generally subject to market conditions and can change at any time.</p>';

	// $html .= "<h3>Check Today's Interest Rates</h3>";
	$html .= "<div id ='myh_pageratetablelinks'>";

	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-refinance-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Refinance Mortgage Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-purchase-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Purchase Mortgage Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-home-equity-lines-of-credit-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Equity Line of Credit (HELOC) Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-equity-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Equity Loan Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/personal-loans/current-personal-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Personal Loan Rates</a></div>";
	$html .= "</div>";	

	return $html;	

}

add_shortcode('generate-rate-table','myh_generate_rate_table');  

/**
* @author     MRF
* @datetime   03/22/2023
* @purpose    Function to generate rate table.
* @input      No inputs
* @output     No outputs
*
**/
function myh_generate_rate_table ($atts) {

	extract( shortcode_atts( array(
			'product' => '', 'loantype' => ''
		), $atts ) ); 
	
	if ($atts['loantype'] == 'refi') { 
		$loan_type = '&loan_type=REFI';
	}  else if ($atts['product'] == 'purchase') { 
		$loan_type = '&loan_type=PURCH';
	}

	if ($atts['product'] == '') {
		$url = 'https://widgets.icanbuy.com/c/standard/us/en/mortgage/tables/Mortgage.aspx?siteid=af8cb55bb139fc6c&hideheader=1&&redirect_no_results=1&redirect_to_mortgage_funnel=1&fha=1&va=1' . $loan_type;
	}  else if ($atts['product'] == 'mortgage') { 
		$url = 'https://widgets.icanbuy.com/c/standard/us/en/mortgage/tables/Mortgage.aspx?siteid=af8cb55bb139fc6c&hideheader=1&&redirect_no_results=1&redirect_to_mortgage_funnel=1&fha=1&va=1' . $loan_type;
	}  else if ($atts['product'] == 'personal') { 
		$url = 'https://widgets.icanbuy.com/c/standard/us/en/personalloan/tables/ms/PersonalLoans.aspx?disable_paging=1&siteid=af8cb55bb139fc6c&hideheader=1';
	}  else if ($atts['product'] == 'heloc') { 	
		$url = 'https://widgets.icanbuy.com/c/standard/us/en/homeequity/tables/HomeEquityCurrent.aspx?siteid=af8cb55bb139fc6c&hideheader=1&property_value=500000&mortgage_balance=100000&loan_amount=50000&loan_product=HELOC';		
	}  else if ($atts['product'] == 'homeequity') { 	
		$url = 'https://widgets.icanbuy.com/c/standard/us/en/homeequity/tables/HomeEquityCurrent.aspx?siteid=af8cb55bb139fc6c&hideheader=1&property_value=500000&mortgage_balance=100000&loan_amount=75000&loan_product=HELOAN_FIXED_10YEARS,HELOAN_FIXED_15YEARS,HELOAN_FIXED_20YEARS,HELOAN_FIXED_30YEARS';		
	}

	$html = '';

	$html .= '<div id="icbratetable"><iframe id="icb_widget" src="' . $url . '" width="100%" height="100%" frameborder="0" scrolling="no" > </iframe>';
	$html .= '<script src="https://widgets.icanbuy.com/js/iframehack/iframeResizer.min.js" type="text/javascript"></script>';
	$html .= '<script type="text/javascript"> iFrameResize({ log: false, checkOrigin: false }, "#icb_widget") </script></div>';

	return $html;

}

/**
 * Gets the request parameter.
 *
 * @param      string  $key      The query parameter
 * @param      string  $default  The default value to return if not found
 *
 * @return     string  The request parameter.
 */
function get_request_parameter( $key, $default = '' ) {

    // If not request set
    if ( ! isset( $_REQUEST[ $key ] ) || empty( $_REQUEST[ $key ] ) ) {
        return $default;
    }
 
    // Set so process it
    return strip_tags( (string) wp_unslash( $_REQUEST[ $key ] ) );
}



add_shortcode('myh-display-sidebar-rate-table-links', 'myh_display_sidebar_ratetablelinks');

/**
* @author     MRF
* @datetime   03/23/2023
* @purpose    Rate table links for sidebar.
*
**/
function myh_display_sidebar_ratetablelinks () {
	$html = '';

	$html .= "<div id ='sidebarratetablelinks'>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-refinance-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Refinance Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-purchase-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Purchase Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-home-equity-lines-of-credit-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>HELOC Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-equity-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Equity Loan Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/personal-loans/current-personal-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Personal Loan Rates</a></div>";
	$html .= "</div>";

	return $html;
}

add_shortcode('myh-display-page-rate-table-links', 'myh_display_page_ratetablelinks');

/**
* @author     MRF
* @datetime   03/23/2023
* @purpose    Rate table links for bottom of posts and pages.
*
**/
function myh_display_page_ratetablelinks () {
	$html = '';
	$html .= "<h3>Check Today's Interest Rates</h3>";
	$html .= "<div id ='myh_pageratetablelinks'>";

	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-refinance-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Refinance Mortgage Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-purchase-mortgage-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Purchase Mortgage Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/mortgage-101/current-home-equity-lines-of-credit-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Equity Line of Credit (HELOC) Rates</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/mortgage-101/current-home-equity-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Home Equity Loan Rates</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/personal-loans/current-personal-loan-rates/\"><span class='icons'><i class='fas fa-caret-up'></i><i class='fas fa-caret-down'></i></span><span class='date'>" . date("d-M") . "</span>Personal Loan Rates</a></div>";
	$html .= "</div>";

	$html .= "<h3>Calculators</h3>";
	$html .= "<div id ='myh_pageratetablelinks'>";	
	$html .= "<div class='myh_pagerate gray'><a href=\"/calculators/hecm-calculator-reverse-mortgage-calculator-2-0-page-1/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'>&nbsp;</span>Reverse Mortgage Calculator</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/calculators/hecm-reverse-mortgage-purchase-calculator-2-0-page-1/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'>&nbsp;</span>Reverse Mortgage for Purchase Calculator</a></div>";
	$html .= "<div class='myh_pagerate gray'><a href=\"/calculators/download-a-free-excel-reverse-mortgage-calculator/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'><i class='fa fa-cloud-download'></i></span>Download Reverse Mortgage Calculator</a></div>";
	$html .= "<div class='myh_pagerate'><a href=\"/reverse-mortgage-101/free-reverse-amortization-calculator/\"><span class='icons'><i class='fas fa-calculator'></i></span><span class='date'>&nbsp;</span>Reverse Amortization Calculator</a></div>";
	$html .= "</div>";

	return $html;
}

/**
* @author     MRF
* @datetime   03/20/2023
* @purpose    Add menu link to Wordpress admin menu.
**/
function myhecm_rate_table_admin_menu(){
    add_menu_page( 'MyHECM Rate Table', 'MyHECM Rate Table', 'manage_options', 'myhecm-ratetable.php', 'myhecm_rate_table_admin_page' );
}

/**
* @author     MRF
* @datetime   03/20/2023
* @purpose    Output settings HTML for admin page. Not using right now. May build out later as needed.
**/
function myhecm_rate_table_admin_page () {

	// wp_enqueue_script( 'myh-rate-table-admin-script', '', array(), false, true );    

?>

	<div class="wrap">

		<h1>MyHECM Rate Table</h1>

		<h2>Rate Table Link Generator</h2>
		Refinance</br>
		<input type="text" class="ratetableinputs" value ="<?php echo get_site_url() . '/mortgage-101/current-refinance-mortgage-rates/?loan_type=REFI'; ?>">
		<p>Select the product:&nbsp;&nbsp;
		<select id="ratetableproduct">
			<option value="0" <?php if($selectedItem === 1 ) { echo 'selected="selected"'; }  ?> >Home Purchase</option>
			<option value="1" <?php if($selectedItem === 0 ) { echo 'selected="selected"'; }  ?> >Home Refinance</option>
			<option value="2" <?php if($selectedItem === 0 ) { echo 'selected="selected"'; }  ?> >Home Equity Loan</option>
			<option value="3" <?php if($selectedItem === 0 ) { echo 'selected="selected"'; }  ?> >Personal Loan</option>
		</select></p>

	</div>

<?php


}

?>