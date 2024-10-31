<?php
// Included required files.
require_once('paypal.nvp.class.php');

// Setup PayPal object
$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature);
$PayPal = new PayPal($PayPalConfig);

// Populate data arrays with order data.
$DPFields = array(
					'paymentaction' => 'Sale', 						// How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
					'ipaddress' => $_SERVER['REMOTE_ADDR'], 		// Required.  IP address of the payer's browser.
					'returnfmfdetails' => '1' 						// Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
				);
				
$CCDetails = array(
					'creditcardtype' => $_REQUEST['cc_type'], 				// Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
					'acct' => $_REQUEST['cc_number'], 					// Required.  Credit card number.  No spaces or punctuation.  
					'expdate' => $_REQUEST['cc_exp_month'].$_REQUEST['cc_exp_year'], // Required.  Credit card expiration date.  Format is MMYYYY
					'cvv2' => $_REQUEST['cvv_number'], 								// Requirements determined by your PayPal account settings.  Security digits for credit card.
					/*'startdate' => '', 								// Month and year that Maestro or Solo card was issued.  MMYYYY
					'issuenumber' => ''								// Issue number of Maestro or Solo card.  Two numeric digits max.*/
				);
				
$PayerInfo = array(
					'email' => $_REQUEST['payment_emailadd'], 				// Email address of payer.
					/*'payerid' => '', 								// Unique PayPal customer ID for payer.
					'payerstatus' => '', 							// Status of payer.  Values are verified or unverified*/
					'business' => $_REQUEST['fname'].$_REQUEST['lname'] // Payer's business name.
				);
				
$PayerName = array(
					/*'salutation' => '', 							// Payer's salutation.  20 char max.*/
					'firstname' => $_REQUEST['fname'], 						// Payer's first name.  25 char max.
					/*'middlename' => '', 							// Payer's middle name.  25 char max.*/
					'lastname' => $_REQUEST['lname'] 						// Payer's last name.  25 char max.
					/*'suffix' => ''								// Payer's suffix.  12 char max.*/
				);
				
$BillingAddress = array(
						'street' => $_REQUEST['payment_add'], 				// Required.  First street address.
						'street2' => $_REQUEST['payment_add'], 							// Second street address.
						'city' => $_REQUEST['payment_camp_city'], 					// Required.  Name of City.
						'state' => $payment_state_name, 							// Required. Name of State or Province.
						'countrycode' => 'US', 							// Required.  Country code.
						'zip' => $_REQUEST['payment_zip'], 							// Required.  Postal code of payer.
						'phonenum' => $_REQUEST['cc_phone'] 				// Phone Number of payer.  20 char max.
					);
					
$ShippingAddress = array(
						'shiptoname' => '', 		// Required if shipping is included.  Person's name associated with this address.  32 char max.
						'shiptostreet' => '', 			// Required if shipping is included.  First street address.  100 char max.
						'shiptostreet2' => '', 						// Second street address.  100 char max.
						'shiptocity' => '', 				// Required if shipping is included.  Name of city.  40 char max.
						'shiptostate' => '', 						// Required if shipping is included.  Name of state or province.  40 char max.
						'shiptozip' => '', 					// Required if shipping is included.  Postal code of shipping address.  20 char max.
						'shiptocountrycode' => '', 				// Required if shipping is included.  Country code of shipping address.  2 char max.
						'shiptophonenum' => ''			// Phone number for shipping address.  20 char max.
						);
					
$PaymentDetails = array(
						'amt' => ($p_price*$no_seat), 							// Required.  Total amount of order, including shipping, handling, and tax.  
						'currencycode' => 'USD', 					// Required.  Three-letter currency code.  Default is USD.
						'itemamt' => ($p_price*$no_seat), 						// Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
						/*'shippingamt' => '0.00', 					// Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
						'handlingamt' => '0.00', 					// Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
						'taxamt' => '0.00', 						// Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. */
						'desc' => 'Join:'.substr($p_title,0,120) 			// Description of the order the customer is purchasing.  127 char max.
						/*'custom' => '', 							// Free-form field for your own use.  256 char max.
						'invnum' => '', 							// Your own invoice or tracking number
						'notifyurl' => ''							// URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.*/
					);

$OrderItems = array();		
$Item	 = array(
						'l_name' => substr($p_title,0,120) , 				// Item Name.  127 char max.
						'l_desc' => substr($p_title,0,120) , 			// Item description.  127 char max.
						'l_amt' => $p_price, 				// Cost of individual item.
						/*'l_number' => 'ABC123', 					// Item Number.  127 char max.*/
						'l_qty' => $no_seat 			// Item quantity.  Must be any positive integer.  
						/*'l_taxamt' => '', 						// Item's sales tax amount.
						'l_ebayitemnumber' => '', 					// eBay auction number of item.
						'l_ebayitemauctiontxnid' => '', 			// eBay transaction ID of purchased item.
						'l_ebayitemorderid' => '' 					// eBay order ID for the item.*/
				);
array_push($OrderItems, $Item);

/*$Item	 = array(
						'l_name' => 'Widget 456', 					// Item Name.  127 char max.
						'l_desc' => 'Test widget 456.', 			// Item description.  127 char max.
						'l_amt' => '35.00', 						// Cost of individual item.
						'l_number' => 'CBA456', 					// Item Number.  127 char max.
						'l_qty' => '1', 							// Item quantity.  Must be any positive integer.  
						'l_taxamt' => '', 							// Item's sales tax amount.
						'l_ebayitemnumber' => '', 					// eBay auction number of item.
						'l_ebayitemauctiontxnid' => '', 			// eBay transaction ID of purchased item.
						'l_ebayitemorderid' => '' 					// eBay order ID for the item.
				);
array_push($OrderItems, $Item);*/

// Wrap all data arrays into a single, "master" array which will be passed into the class function.
$PayPalRequestData = array(
						   'DPFields' => $DPFields, 
						   'CCDetails' => $CCDetails, 
						   'PayerName' => $PayerName, 
						   //'BillingAddress' => $BillingAddress, 
						   'PaymentDetails' => $PaymentDetails, 
						   'OrderItems' => $OrderItems
						   );

// Pass the master array into the PayPal class function
 
$PayPalResult = $PayPal->DoDirectPayment($PayPalRequestData);
 
// Display results
?>