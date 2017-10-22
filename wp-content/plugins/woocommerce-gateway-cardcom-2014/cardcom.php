<?php
/*
Plugin Name: WooCommerce CardCom Payment Gateway
Plugin URI: http://www.cardcom.co.il
Description: CardCom Payment gateway for woocommerce
Version: 2.0.0.0
Author: CardCom inc
Author URI: http://www.cardcom.co.il
*/

add_action('plugins_loaded', 'woocommerce_cardcom_init', 0);


function woocommerce_cardcom_init() {
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) { return; }
	/**
 	* Gateway class
 	**/
 	class WC_Gateway_Cardcom extends WC_Payment_Gateway {
 		var $terminalnumber;
 		var $username;
 		var $operation;
 		var $isML;
 		static $trm;
 		static $user;
 		static $CoinID;
 		static $language;
 		static $InvVATFREE;
 		static $IsActivateInvoiceForPaypal;

 		function __construct() { 

 			$this->id = 'cardcom';
 			$this->method_title = __('CardCom', 'woothemes');
			//$this->icon 			= WP_PLUGIN_URL . "/" . plugin_basename( dirname(__FILE__)) . '/images/sc_logo.png';
 			$this->has_fields 		= false;

 			$this->url = "https://secure.cardcom.co.il/external/LowProfileClearing2.aspx";

			// Load the form fields
 			$this->init_form_fields();

			// Load the settings.
 			$this->init_settings();

			//Load Language by Define if WPML ACTIVE //https://wpml.org/forums/topic/how-to-check-if-wpml-is-installed-and-active/ 
 			global $sitepress;

			// $out = '<script>console.log("'.ICL_LANGUAGE_CODE.' ->def:'.$sitepress->get_default_language().'")</script>';
			// echo $out;

			// https://wpml.org/forums/topic/get-current-language-in-functions-php/
			//https://wpml.org/forums/topic/how-to-define-redirect-url-that-automatically-represent-current-language/
 			if(function_exists('icl_object_id') && defined('ICL_LANGUAGE_CODE') && $sitepress->get_default_language() != ICL_LANGUAGE_CODE) {
 				$this->lang =ICL_LANGUAGE_CODE;
 				$this->isML = true;
 			}else{		 		
 				$this->lang = $this->settings['lang'];
 				$this->isML = false;
 			}

			// Get setting values
 			$this->title 			= $this->settings['title'];
 			$this->description 		= $this->settings['description'];
 			$this->enabled 			= $this->settings['enabled'];
 			$this->terminalnumber		= $this->settings['terminalnumber'];
 			$this->adminEmail		= $this->settings['adminEmail'];

 			$this->username	= $this->settings['username'];
 			$this->currency = $this->settings['currency'];

 			$this->operation = $this->settings['operation'];
 			$this->invoice = $this->settings['invoice'];
 			$this->maxpayment = $this->settings['maxpayment'];

 			$this->UseIframe = $this->settings['UseIframe'];
 			$this->OrderStatus = $this->settings['OrderStatus'];
 			$this->InvoiceVATFREE = $this->settings['InvoiceVATFREE'];
 			$this->failedUrl = $this->settings['failedUrl'];
 			$this->successUrl = $this->settings['successUrl'];

			//init static vars
 			self::$trm = $this->settings['terminalnumber'];
 			self::$user = $this->settings['username'];
 			self::$CoinID = $this->settings['currency'];
 			self::$language = $this->lang;
 			self::$InvVATFREE = $this->settings['InvoiceVATFREE'];
 			self::$IsActivateInvoiceForPaypal = $this->settings['IsActivateInvoiceForPaypal'];
 			
 			add_action( 'woocommerce_api_wc_gateway_cardcom', array( $this, 'check_ipn_response' ) );
 			add_action('valid-cardcom-ipn-request', array(&$this, 'ipn_request') );
 			add_action('valid-cardcom-successful-request', array(&$this, 'successful_request') );
 			add_action('valid-cardcom-cancel-request', array(&$this, 'cancel_request') );
 			add_action('valid-cardcom-failed-request', array(&$this, 'failed_request') );
 			add_action('woocommerce_receipt_cardcom', array(&$this, 'receipt_page'));
			// Hooks
 			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
 		}

 		public static function init() {
 			add_action( 'woocommerce_order_status_completed', array( get_called_class(), 'CreateinvoiceForPayPal' ) );
 		// 	add_action( 'valid-paypal-standard-ipn-request', array(  get_called_class(), 'CreateinvoiceForPayPal' )); // For "PayPal Standard" gateway
			// add_action( 'woocommerce_paypal_express_checkout_valid_ipn_request', array(  get_called_class(), 'CreateinvoiceForPayPal' )  ); // For "Paypal Express Checkout" gateway
 		}


 		public static function CreateinvoiceForPayPal($order_id){
 			error_log( "Payment has been received for order $order_id ->> is active:".self::$IsActivateInvoiceForPaypal );
			$order = new WC_Order( $order_id );
			
			// Web service 
			// https://secure.cardcom.co.il/Interface/CreateInvoice.aspx
 			if ( 'paypal' === $order->get_payment_method() && self::$IsActivateInvoiceForPaypal == '1') {
				//Paypal Case
 				error_log( "Payment has been received from". $order->get_payment_method() );
 				$initParams = self::initInvoice($order_id);
 				$initParams["InvoiceType"] = "1";

 				$key_1_value = get_post_meta( (int)$order->id, 'InvoiceNumber', true );
 				$key_2_value = get_post_meta( (int)$order->id, 'InvoiceType', true );
 				if ( ! empty( $key_1_value ) && ! empty( $key_2_value )) {
 					error_log("Order has invoice: ".$key_1_value);
 					return;
 				}
 				wc_add_order_item_meta((int)$order->id, 'InvoiceNumber', 0 );
 				wc_add_order_item_meta((int)$order->id, 'InvoiceType', 0 );
 				$initParams["CustomPay.TransactionID"] = '32';
 				$initParams["CustomPay.TranDate"] = date('d/m/Y');
 				$initParams["CustomPay.Description"] =  'PayPal Payments';
 				$initParams["CustomPay.Asmacta"] = $order->get_transaction_id();
 				$initParams["CustomPay.Sum"]=number_format($order->get_total(), 2, '.', '') ;

 				$urlencoded = http_build_query($initParams);			
 				error_log( $urlencoded);

 				$curl = curl_init();
 				curl_setopt($curl, CURLOPT_URL, 'https://secure.cardcom.co.il/Interface/CreateInvoice.aspx');
 				curl_setopt($curl, CURLOPT_POST, 1);
 				curl_setopt($curl, CURLOPT_FAILONERROR, true);
 				curl_setopt($curl, CURLOPT_POSTFIELDS, $urlencoded );
 				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
 				curl_setopt($curl, CURLOPT_FAILONERROR,true);

 				$result = curl_exec($curl);
 				error_log($result);
 				curl_close( $curl );
 				$responseArray =  array(); 
 				parse_str($result,$responseArray);
 				if (isset($responseArray['ResponseCode'])){
 					if($responseArray['ResponseCode'] == 0){
 						if (isset($responseArray['InvoiceNumber'])){
 							$invNumber = $responseArray['InvoiceNumber'];
 							$invType = $responseArray['InvoiceType'];
 							update_post_meta( (int)$order->id, 'InvoiceNumber',$invNumber);
 							update_post_meta( (int)$order->id, 'InvoiceType',$invType);
 						}
 					}
 				} 				
 			}
 		}



 		public static function initInvoice($order_id){

 			$order = new WC_Order( $order_id );
 			$params = array();
			
			$SumToBill = number_format($order->get_total(), 2, '.', '') ;
 			$params["terminalnumber"] = self::$trm ;
 			$params["username"] = self::$user;
 			$params["CodePage"] = "65001";

 			$params["SumToBill"] = $SumToBill ;

 			$coin = self::GetCurrency($order,self::$CoinID);

 			$params["Languge"] = self::$language;
 			$params["CoinID"] = $coin;
 			$params['InvoiceHead.CustName']			= $order->billing_first_name." ".$order->billing_last_name;
 			$params['InvoiceHead.CustAddresLine1']	= $order->billing_address_1;
 			$params['InvoiceHead.CustCity']	= $order->billing_city;
 			$params['InvoiceHead.CustAddresLine2']	= (isset($order->billing_address_2) ? $order->billing_address_2 : '');
 			$params['InvoiceHead.CustLinePH']= $order->billing_phone;
 			if(strtolower(self::$language) =='he' || strtolower(self::$language) =='en'){
 				$params['InvoiceHead.Language']	= self::$language;
 			}else{
 				$params['InvoiceHead.Language']	= 'en';
 			}
 			$params['InvoiceHead.Email'] = $order->billing_email;
 			$params['InvoiceHead.SendByEmail']= 'true';
 			$params['InvoiceHead.CoinID']= $coin;
 			$params['InvoiceHead.ExtIsVatFree'] = self::$InvVATFREE;
 			$params['InvoiceHead.Comments'] = $order->id;

 			$ItemsCount = 0;
 			$AddToString  = "";
 			$TotalLineCost = 0;
 			$ItemShipping = number_format($order->get_shipping_total() + $order->get_shipping_tax(), 2, '.', '');

 			if ( version_compare( WOOCOMMERCE_VERSION, '2.7', '<' ) ) {
 				foreach ($order->get_items() as $item) 
 				{
 					$ItemTotal =number_format( $order->get_item_total( $item, false ,false) + $order->get_item_tax( $item, false ,false) , 2, '.', '');
 					$itmdesk=substr(strip_tags( preg_replace("/&#\d*;/", " ", $item['name']) ), 0, 200);

 					$params['InvoiceLines'.$AddToString.'.Description']=$itmdesk;
 					$params['InvoiceLines'.$AddToString.'.Price']=  $ItemTotal;
 					$params['InvoiceLines'.$AddToString.'.Quantity']=  $item['qty'];
 					$params['InvoiceLines'.$AddToString.'.ProductID']= $item["product_id"];
 					$TotalLineCost +=($ItemTotal*$item['qty']);
 					$ItemsCount++;
 					$AddToString = $ItemsCount;
 				}

 				if ($ItemShipping !=0)
 				{
 					$ShippingDesk = substr(strip_tags( preg_replace("/&#\d*;/", " ", ucwords( self::get_shipping_method_fixed($order) )) ), 0, 200);
 				}

 				$order_discount = number_format( $order->get_order_discount(), 2, '.', '');
 			}else{
 				foreach ( $order->get_items() as $item_id => $item ) {
 					$ItemPrice = wc_format_decimal( $order->get_item_total( $item ), 2 );
 					$product          = $order->get_product_from_item( $item );
 					$item_line_total  = $order->get_item_subtotal( $item, false );
 					//$ItemTotal =number_format( $order->get_line_subtotal($item),2,'.','');
 					$itmdesk=substr(strip_tags( preg_replace("/&#\d*;/", " ", $item->get_name()) ), 0, 200);
 					$params['InvoiceLines'.$AddToString.'.Description']= $itmdesk;
 					$params['InvoiceLines'.$AddToString.'.Price']=$item_line_total;
 					$params['InvoiceLines'.$AddToString.'.Quantity']=  $item->get_quantity();
 					$params['InvoiceLines'.$AddToString.'.ProductID']= $item_id;
 					$TotalLineCost +=($item_line_total*$item->get_quantity());
 					$ItemsCount++;
 					$AddToString = $ItemsCount;
 				}

 				if ($ItemShipping !=0)
 				{
 					$ShippingDesk =$order->get_shipping_method();
 				}

 				$order_discount = number_format( $order->get_discount_total(), 2, '.', '');
 			}

 			if ($ItemShipping !=0)
 			{
 				$params['InvoiceLines'.$AddToString.'.Description']= $ShippingDesk;
 				$params['InvoiceLines'.$AddToString.'.Price']= $ItemShipping;
 				$params['InvoiceLines'.$AddToString.'.Quantity']=  1;
 				$params['InvoiceLines'.$AddToString.'.ProductID']= "Shipping";
 				$TotalLineCost +=$ItemShipping;
 				$ItemsCount++;
 				$AddToString = $ItemsCount;
 			}

 			if ($order_discount>0)
 			{
 				$coupon_codes = $order->get_used_coupons();
 				if(!empty($coupon_codes))
				{
					$params['InvoiceLines'.$AddToString.'.Description']= __("Coupon code", "woocommerce").": ".implode(", ", $coupon_codes);	
				}else{
					$params['InvoiceLines'.$AddToString.'.Description']="Discount";
				}
 				
 				$params['InvoiceLines'.$AddToString.'.Price']= -1*$order_discount;
 				$params['InvoiceLines'.$AddToString.'.Quantity']= 1;
 				$params['InvoiceLines'.$AddToString.'.ProductID']='Discount';
 				$TotalLineCost -=$order_discount;
 				$ItemsCount++;
 				$AddToString = $ItemsCount;
 			}

			


 			if (($SumToBill-$TotalLineCost) !=0)
 			{
 				if(strtolower(self::$language) =='he'){
 					$params['InvoiceLines'.$AddToString.'.Description']= "שורת איזון עבור חשבונית בלבד";	
 				}else{
 					$params['InvoiceLines'.$AddToString.'.Description']= "Balance row for invoice";	
 				}
 				$params['InvoiceLines'.$AddToString.'.Price']=  number_format( $SumToBill-$TotalLineCost, 2, '.', '');
 				$params['InvoiceLines'.$AddToString.'.Quantity']= '1';
 				$params['InvoiceLines'.$AddToString.'.ProductID']= 'Diff';
 				$ItemsCount++;
 				$AddToString = $ItemsCount;
 			}
 			return $params;
 		}


		//fix shipping by Or
 		public static function get_shipping_method_fixed($order) 
 		{

 			$labels = array();

			// Backwards compat < 2.1 - get shipping title stored in meta
 			if ( $order->shipping_method_title ) {

 				$labels[] = $order->shipping_method_title;
 			} else {

			  // 2.1+ get line items for shipping
 				$shipping_methods = $order->get_shipping_methods();

 				foreach ( $shipping_methods as $shipping ) {
 					$labels[] = $shipping['name'];
 				}
 			}

 			return implode(',', $labels);
 		}


		/**
		* Initialize Gateway Settings Form Fields
		*/
		function init_form_fields() {

			$this->form_fields = array(
				'title' => array(
					'title' => __( 'Title', 'woothemes' ),
					'type' => 'text', 
					'description' => __( 'The title which the user sees during the checkout.', 'woothemes'), 
					'default' => __( 'Cardcom', 'woothemes' )
					), 
				'enabled' => array(
					'title' => __( 'Enable/Disable', 'woothemes' ), 
					'label' => __( 'Enable Cardcom', 'woothemes' ), 
					'type' => 'select',
					'options'=>array('yes'=>'Yes','no'=>'No'),
					'description' => '', 
					'default' => 'yes'
					), 
				'description' => array(
					'title' => __( 'Description', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'The description which the user sees during the checkout.', 'woothemes'), 
					'default' => 'Pay with Cardcom.'
					), 
				'operation' => array(
					'title' => __( 'Operation', 'woothemes' ), 
					'label' => __( 'Operation', 'woothemes' ), 
					'type' => 'select',
					'options'=>array('1'=>'Charge Only','4'=>'Suspended Deal'),
					'description' => '', 
					'default' => '1'
					), 

				'invoice' => array(
					'title' => __( 'Invoice', 'woothemes' ), 
					'label' => __( 'Invoice', 'woothemes' ), 
					'type' => 'select',
					'options'=>array('1'=>'Yes','2'=>'Display only'),
					'description' => 'Select Yes only if accout have docuemnts module', 
					'default' => '1'
					), 
				'terminalnumber' => array(
					'title' => __( 'Terminal Number', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'the company Terminal Number', 'woothemes'), 
					'default' => '1000'
					), 
				'username' => array(
					'title' => __( 'API User Name', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'the company API User Name', 'woothemes'), 
					'default' => 'yael29'
					),

				'maxpayment' => array(
					'title' => __( 'Max Payment', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'Max Payment', 'woothemes'), 
					'default' => '1'
					),
				'currency' => array(
					'title' => __( 'Currency', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'Currency: 0- Auto Detect,  1 - NIS , 2 - USD , else ISO Currency', 'woothemes'), 
					'default' => '1'
					),
				'lang' => array(
					'title' => __( 'Lang', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'Lang', 'woothemes'), 
					'default' => 'en'
					),
				'adminEmail' => array(
					'title' => __( 'Admin Email', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'Admin Email', 'woothemes'), 
					'default' => ''
					),
				'UseIframe' => array(
					'title' => __( 'Use Iframe', 'woothemes' ), 
					'label' => __( 'Use Iframe', 'woothemes' ), 
					'type' => 'select',
					'options'=>array('1'=>'Yes','0'=>'No'),
					'description' => '', 
					'default' => '0'
					) ,
				'InvoiceVATFREE' => array(
					'title' => __( 'invoice VAT free', 'woothemes' ), 
					'label' => __( 'invoice VAT free', 'woothemes' ), 
					'type' => 'select',
					'options'=>array('true'=>'VAT free','false'=>'REQ Vat'),
					'description' => '', 
					'default' => 'false'
					) ,
				'OrderStatus' => array(
					'title' => __( 'Order Status', 'woothemes' ), 
					'label' => __( 'Order Status', 'woothemes' ), 
					'type' => 'select',
					'options'=>array('processing'=>'processing','completed'=>'completed','on-hold'=>'on-hold'),
					'description' => 'what will the order status will be', 
					'default' => 'completed'
					) ,

				'failedUrl' => array(
					'title' => __( 'failed Url', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'failed Url', 'woothemes'), 
					'default' => ''
					),
				'successUrl' => array(
					'title' => __( 'success Url', 'woothemes' ), 
					'type' => 'text', 
					'description' => __( 'success Url', 'woothemes'), 
					'default' => ''
					),
				'IsActivateInvoiceForPaypal' => array(
					'title' => __( 'Invoice for Paypal', 'woothemes' ), 
					'label' => __( 'Invoice for Paypal', 'woothemes' ), 
					'type' => 'select',
					'description' => __( 'Activate invoice creation for Paypal', 'woothemes'), 
					'options'=>array('1'=>'Yes','2'=>'No'),
					'default' => '2'
					),
				);
		}

		/**
		* Admin Panel Options 
		* - Options for bits like 'title' and availability on a country-by-country basis
		*/

		function admin_options() {
			?>
			<h3><?php _e( 'CardCom', 'woothemes' ); ?></h3>
			<table class="form-table">
				<?php $this->generate_settings_html(); ?>
			</table><!--/.form-table-->
			<?php
		}
		
		/**
		* Check if this gateway is enabled and available in the user's country
		*/
		function is_available() {
			if ($this->enabled=="yes") :
				return true;
			endif;	
			
			return false;
		}
		
		/**
		* Payment form on checkout page
		*/
		function payment_fields() {
			
			?>

			<?php if ($this->description) : ?><p><?php echo $this->description; ?></p><?php endif; ?>
			<?php
		}
		
		/**
		* Process the payment
		*/
		function process_payment($order_id) {
			global $woocommerce;
			
			$order = new WC_Order( $order_id );
			
			if ($this->UseIframe==1)	
			{
				if(  version_compare( WOOCOMMERCE_VERSION, '2.2', '<')){
					return array(
						'result' 	=> 'success',
						'redirect'	=> add_query_arg('order', $order->id, add_query_arg('key', $order->order_key, get_permalink(woocommerce_get_page_id('pay')))));
				}
				else{
					return array(
						'result' 	=> 'success',
						'redirect'	=> add_query_arg('order-pay', $order->id, add_query_arg('key', $order->order_key, $order->get_checkout_payment_url(true))));
				}
			}
			
			else
			{
				return array(
					'result' 	=> 'success',
					'redirect'	=> $this->GetRedirectURL($order_id)

					);
			}
		}
		
		public static function GetCurrency($order,$currency)
		{

			if($currency!=0)
				return $currency;
			
			// if woo graeter then 3.0 use get_currency
			if(version_compare(WOOCOMMERCE_VERSION, '3.0', '<')){
				$cur = $order->get_order_currency(); 	
			}else{
				$cur = $order->get_currency(); 	
			}

			if($cur=="ILS")
				return 1;
			else if($cur=="NIS")
				return 1;
			else if($cur=="AUD")
				return 36;
			else if($cur=="USD")
				return 2;
			else if($cur=="CAD")
				return 124;
			else if($cur=="DKK")
				return 208;
			else if($cur=="JPY")
				return 392;
			else if($cur=="CHF")
				return 756;
			else if($cur=="GBP")
				return 826;
			else if($cur=="USD")
				return 2;
			else if($cur=="EUR")
				return 978;
			return $cur;
		}

		function GetRedirectURL( $order_id ) {
			global $woocommerce;
			$order = new WC_Order( $order_id );
			//$SumToBill = number_format($order->get_total(), 2, '.', '') ;
			$params = array();
			
			$params = self::initInvoice($order_id);
			
			//$params["SumToBill"] = $SumToBill;

			$params["APILevel"] = "9";
			$params["Operation"] = $this->operation;
			// https://github.com/UnifiedPaymentSolutions/woocommerce-payment-gateway-everypay/blob/master/includes/class-wc-gateway-everypay.php

			
			
			// Redirect
			// if($this->isML == 'TRUE'){
			if(strpos(home_url(),'?') !== false){
				
				$params["ErrorRedirectUrl"] = untrailingslashit(home_url()).'&wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_failed&order_id='.$order->id);
				$params["IndicatorUrl"]=untrailingslashit(home_url()).'&wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_IPN&order_id='.$order->id);
				$params["SuccessRedirectUrl"] = untrailingslashit(home_url()).'&wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_successful&order_id='.$order->id);
				$params["CancelUrl"] = untrailingslashit(home_url()).'&wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_cancel&order_id='.$order->id);

			}else{
				$params["ErrorRedirectUrl"] = untrailingslashit(home_url()).'?wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_failed&order_id='.$order->id);
				$params["IndicatorUrl"]=untrailingslashit(home_url()).'?wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_IPN&order_id='.$order->id);
				$params["SuccessRedirectUrl"] = untrailingslashit(home_url()).'?wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_successful&order_id='.$order->id);
				$params["CancelUrl"] = untrailingslashit(home_url()).'?wc-api=WC_Gateway_Cardcom&'.('cardcomListener=cardcom_cancel&order_id='.$order->id);
			}

			if ($this->UseIframe==1){
				if($this->successUrl!=''){
					$params["SuccessRedirectUrl"] = trailingslashit(home_url())."pop.php?url=".$this->successUrl;
				}else{
					$params["ErrorRedirectUrl"] = trailingslashit(home_url())."pop.php?url=".urlencode($params["ErrorRedirectUrl"]);
					$params["SuccessRedirectUrl"] = trailingslashit(home_url())."pop.php?url=".urlencode($params["SuccessRedirectUrl"]);
					$params["CancelUrl"] = trailingslashit(home_url())."pop.php?url=".urlencode($params["CancelUrl"]);
				}
			}

			//IF WPML USE siteurl/en/ format
			// if ($this->UseIframe==1){
			// 	if($this->successUrl!=''){
			// 		$params["SuccessRedirectUrl"] = trailingslashit(get_site_url())."pop.php?url=".$this->successUrl;
			// 	}
			// 	else{
			// 		$params["ErrorRedirectUrl"] = trailingslashit(get_site_url())."pop.php?url=".urlencode($params["ErrorRedirectUrl"]);
			// 		$params["SuccessRedirectUrl"] = trailingslashit(get_site_url())."pop.php?url=".urlencode($params["SuccessRedirectUrl"]);
			// 		$params["CancelUrl"] = trailingslashit(get_site_url())."pop.php?url=".urlencode($params["CancelUrl"]);
			// 	}
			// }

			$params["CancelType"] = "2";
			$params["ProductName"] = "Order Id:".$order->id;
			$params["ReturnValue"] = $order->id;

			if ($this->operation == '4') // Req Params for Suspend Deal
			{
				if ($this->terminalnumber==1000)
				{
					$params['SuspendedDealJValidateType'] = "2";
				}
				else
				{
					$params['SuspendedDealJValidateType'] = "5";
				}

				$params['SuspendedDealGroup'] = "1";

			}

			if(!empty($this->maxpayment)&& $this->maxpayment>="1")
			{
				$params['MaxNumOfPayments']	= $this->maxpayment;
			}

			

			if($this->invoice == '1')
			{
 				$params['InvoiceHeadOperation']			= "1"; // Create Invoice
 			}else{
 				$params['InvoiceHeadOperation']			= "2"; // Show Only
 			}
 			
 			$urlencoded = http_build_query($params);			

 			$curl = curl_init();
 			curl_setopt($curl, CURLOPT_URL, 'https://secure.cardcom.co.il/BillGoldLowProfile.aspx');
 			curl_setopt($curl, CURLOPT_POST, 1);
 			curl_setopt($curl, CURLOPT_FAILONERROR, true);
 			curl_setopt($curl, CURLOPT_POSTFIELDS, $urlencoded );
 			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
 			curl_setopt($curl, CURLOPT_FAILONERROR,true);

 			$result = curl_exec($curl);

 			$exp = explode(';',$result);

 			$data = array();


 			$IsOk = true;

 			if($exp[0] == "0")
 			{
 				$IsOk = true;
 				$data['profile'] =$exp[1];
 				//wc_add_order_item_meta((int)$order->id, 'Profile', 0 );
 				update_post_meta( (int)$order->id, 'Profile',$data['profile']);

 			}else
 			{
 				$IsOk = false;
 				if ($this->adminEmail!='')
 				{
 					wp_mail($this->adminEmail, 'Bill Gold: Transaction Faild (Bill Gold retrun an error)',
 						"Wordpress Transcation Faild!\n
 						==== XML Response ====\n
 						Terminal Number:".$this->terminalnumber."\n
 						Error Code:			  ".$exp[0]."\n
 						==== Transaction Details ====\n
 						Full Response :  ".$result."
 						Info:		  ".$urlencoded."\n
 						curl_error:		  ".curl_error ( $curl )."\n"
 						);
 				}
 			}

 			$requestVars = array();
 			$requestVars["terminalnumber"] = self::$trm;
 			$requestVars["Rcode"] = $exp[0] ;
 			$requestVars["lowprofilecode"] = $exp[1] ;

 			if ($IsOk){
 				return $this->url."?". http_build_query($requestVars);	
 			}else{

 			}

 		}

 		function generate_cardcom_form( $order_id ) {


 			$URL = $this->GetRedirectURL( $order_id);

 			$formstring = '<iframe width="100%" height="1000" frameborder="0" src="'.$URL.'" ></iframe>';


 			return $formstring;		
 		}


 		function receipt_page( $order ) {
			//echo '<p>'.__('Thank you for your order, please click the button below to pay with Cardcom.', 'woocommerce').'</p>';
 			echo $this->generate_cardcom_form( $order );
 		}


 		function check_ipn_response() {


 			if (isset($_GET['cardcomListener']) && $_GET['cardcomListener'] == 'cardcom_IPN'):
 				@ob_clean();
 			$_POST = stripslashes_deep($_REQUEST);
 			header('HTTP/1.1 200 OK');
 			header('User-Agent: Cardcom');
 			do_action("valid-cardcom-ipn-request", $_REQUEST);
 			endif;

 			if (isset($_GET['cardcomListener']) && $_GET['cardcomListener'] == 'cardcom_successful'):
 				@ob_clean();
 			$_POST = stripslashes_deep($_REQUEST);
 			header('HTTP/1.1 200 OK');
 			header('User-Agent: Cardcom');
 			do_action("valid-cardcom-successful-request", $_REQUEST);
 			endif;

 			if (isset($_GET['cardcomListener']) && $_GET['cardcomListener'] == 'cardcom_cancel'):
 				@ob_clean();
 			$_GET= stripslashes_deep($_REQUEST);
 			header('HTTP/1.1 200 OK');
 			header('User-Agent: Cardcom');
 			do_action("valid-cardcom-cancel-request", $_REQUEST);
 			endif;


 			if (isset($_GET['cardcomListener']) && $_GET['cardcomListener'] == 'cardcom_failed'):
 				@ob_clean();
 			$_GET= stripslashes_deep($_REQUEST);
 			header('HTTP/1.1 200 OK');
 			header('User-Agent: Cardcom');
 			do_action("valid-cardcom-failed-request", $_REQUEST);
 			endif;
 		}

 		function cancel_request( $get) {

 			$order_id = intval($get["order_id"]);
 			global $woocommerce;

 			$order = new WC_Order( $order_id );

 			if(!empty($order->id))
 			{

 				wp_redirect($order->get_cancel_order_url());
 				die();
 			}

 		}

 		function failed_request( $get) {
 			if($this->failedUrl!='')
 				wp_redirect($this->failedUrl);
 			else
 				$this->cancel_request($get);

 		}
 		function ipn_request( $posted ) {

			//if($posted["DealRespone"] == 0)
			//{

 			$lowprofilecode = $posted["lowprofilecode"];
 			$orderid = htmlentities($posted["order_id"]);

 			return $this->updateOrder($lowprofilecode,$orderid);
 			return true;
			//}
 		}

 		function updateOrder($lowprofilecode,$orderid)
 		{
 			$order = new WC_Order( $orderid );
 			if ($this->IsLowProfileCodeDealOneOK($lowprofilecode ,$this->terminalnumber,$this->username,$orderid)== '0')
 			{

 				if(!empty($order->id))
 				{
 					wc_add_order_item_meta((int)$order->id, 'CardcomInternalDealNumber', 0 );
 					update_post_meta( (int)$orderid , 'CardcomInternalDealNumber', $this->InternalDealNumberPro );

 					$order->add_order_note( __('IPN payment completed OK! Deal Number:'.$this->InternalDealNumberPro, 'woocommerce') );
						//$order->update_status("processing");
						//OR 
						//$order->update_status("completed");

 					$order->update_status($this->OrderStatus);
 					$order->reduce_order_stock();
 					if($this->OrderStatus!='on-hold'){
 						$order->payment_complete();
 					}
 					return true;
 				}
 			}
 			else
 			{

 				if(!empty($order->id))
 				{
 					if ($order->get_status()=="completed"||
 						$order->get_status()=="on-hold" ||
 						$order->get_status()=="processing")
 					{
 						return true;
 					}
 					$order->add_order_note( __('IPN payment completed Not OK', 'woocommerce') );
 					$order->update_status("failed");
 					return true;
 				}
 			}
 		}

 		function successful_request( $posted ) {

 			$orderid = htmlentities($posted["order_id"]);
			//$lowprofilecode = $posted["lowprofilecode"];

			// $this->updateOrder($lowprofilecode,$orderid);

 			$order = new WC_Order( $orderid);

 			if(!empty($order->id))
 			{
 				if($this->successUrl!=''){
 					wp_redirect($this->successUrl);
 				}
 				else{
 					$return_url = $this->get_return_url( $order );
 					wp_redirect($return_url);
 				}
 				return true;
 			}
 			wp_redirect("/");
 			return false;
 		}

 		protected $InternalDealNumberPro;
 		protected $DealResponePro;
 		function IsLowProfileCodeDealOneOK($lpc,$terminal,$username,$orderid)
 		{
 			$vars = array( 
 				'TerminalNumber'=>$terminal, 
 				'LowProfileCode'=>$lpc, 
 				'UserName'=>$username 
 				);

        # encode information
 			$urlencoded = http_build_query($vars);
 			$CR = curl_init();
 			curl_setopt($CR, CURLOPT_URL, 'https://secure.cardcom.co.il/Interface/BillGoldGetLowProfileIndicator.aspx');
 			curl_setopt($CR, CURLOPT_POST, 1);
 			curl_setopt($CR, CURLOPT_FAILONERROR, true);
 			curl_setopt($CR, CURLOPT_POSTFIELDS, $urlencoded );
 			curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
 			curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);
 			curl_setopt($CR, CURLOPT_FAILONERROR,true);
 			$result = curl_exec( $CR );
 			curl_close( $CR );
 			$responseArray =  array(); 
 			$returnvalue = '1';
 			parse_str($result,$responseArray);

 			$this->InternalDealNumberPro = 0;
 			$this->DealResponePro = -1;

 			if (isset($responseArray['InternalDealNumber'])){
 				$this->InternalDealNumberPro = $responseArray['InternalDealNumber'];
 			}

		if (isset($responseArray['DealResponse'])) #  OK!
		{
			$this->DealResponePro = $responseArray['DealResponse'];
		}
		else if (isset($responseArray['SuspendedDealResponseCode'])) #  Suspend Deal
		{
			$this->DealResponePro = $responseArray['SuspendedDealResponseCode'];
		}


		if (isset($responseArray['DealResponse'])
			&& $responseArray['DealResponse'] == '0' 
	    && $responseArray['ReturnValue']==$orderid) #  Normal Deal
		{
			$returnvalue = '0';
		}
        else if (isset($responseArray['SuspendedDealResponseCode'])&& $responseArray['SuspendedDealResponseCode']== '0' && $responseArray['ReturnValue']==$orderid) #  Suspend Deal
        {
        	$returnvalue = '0';
        }

        if ($returnvalue =='0'){
			// http://kb.cardcom.co.il/article/AA-00241/0
        	add_post_meta( $orderid, 'Payment Gateway','CardCom'); 
        	add_post_meta( $orderid, 'cc_number',$responseArray['ExtShvaParams_CardNumber5']); 
        	add_post_meta( $orderid, 'cc_holdername',$responseArray['ExtShvaParams_CardOwnerName']); 

        	add_post_meta( $orderid, 'cc_numofpayments',1+$responseArray['ExtShvaParams_NumberOfPayments94']); 
        	if (1+$responseArray['ExtShvaParams_NumberOfPayments94']==1)
        	{
        		add_post_meta( $orderid, 'cc_firstpayment',$responseArray['ExtShvaParams_Sum36']); 			
        		add_post_meta( $orderid, 'cc_paymenttype','1'); 
        	}
        	else
        	{
        		add_post_meta( $orderid, 'cc_firstpayment',$responseArray['ExtShvaParams_FirstPaymentSum78']); 	
        		add_post_meta( $orderid, 'cc_paymenttype','2'); 
        	}

        	add_post_meta( $orderid, 'cc_total',$responseArray['ExtShvaParams_Sum36']); 
        	add_post_meta( $orderid, 'cc_cardtype',$responseArray['ExtShvaParams_Sulac25']); 
        }
        
        return $returnvalue;
    } 

	} // end woocommerce_sc
	/**
 	* Add the Gateway to WooCommerce
 	**/
 	function add_cardcom_gateway($methods) {
 		$methods[] = 'WC_Gateway_Cardcom';
 		return $methods;
 	}	
 	add_filter('woocommerce_payment_gateways', 'add_cardcom_gateway' );
 	WC_Gateway_Cardcom::init(); // add listner to paypal payments
 } 