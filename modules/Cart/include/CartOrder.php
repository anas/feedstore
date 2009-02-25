<?

/**
 * CartOrder
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @version 2.0
 */

/**
 * DETAILED CLASS TITLE
 * 
 * DETAILED DESCRIPTION OF THE CLASS
 * @package CMS
 * @subpackage Core
 */
class CartOrder {

	/**
	 * Variable associated with `orders_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `customers_id` column in table.
	 *
	 * @var string
	 */
	protected $customer = null;
	
	/**
	 * Variable associated with `customers_name` column in table.
	 *
	 * @var string
	 */
	protected $customerName = null;
	
	/**
	 * Variable associated with `customers_company` column in table.
	 *
	 * @var string
	 */
	protected $customerCompany = null;
	
	/**
	 * Variable associated with `customers_street_address` column in table.
	 *
	 * @var string
	 */
	protected $customerAddress = null;
	
	/**
	 * Variable associated with `customers_suburb` column in table.
	 *
	 * @var string
	 */
	protected $customers_suburb = null;
	
	/**
	 * Variable associated with `customers_city` column in table.
	 *
	 * @var string
	 */
	protected $customers_city = null;
	
	/**
	 * Variable associated with `customers_postcode` column in table.
	 *
	 * @var string
	 */
	protected $customers_postcode = null;
	
	/**
	 * Variable associated with `customers_state` column in table.
	 *
	 * @var string
	 */
	protected $customers_state = null;
	
	/**
	 * Variable associated with `customers_country` column in table.
	 *
	 * @var string
	 */
	protected $customers_country = null;
	
	/**
	 * Variable associated with `customers_telephone` column in table.
	 *
	 * @var string
	 */
	protected $customerTelephone = null;
	
	/**
	 * Variable associated with `customers_email_address` column in table.
	 *
	 * @var string
	 */
	protected $customerEmail = null;
	
	/**
	 * Variable associated with `customers_address_format_id` column in table.
	 *
	 * @var string
	 */
	protected $customers_address_format_id = null;
	
	/**
	 * Variable associated with `delivery_name` column in table.
	 *
	 * @var string
	 */
	protected $deliveryName = null;
	
	/**
	 * Variable associated with `delivery_company` column in table.
	 *
	 * @var string
	 */
	protected $deliveryCompany = null;
	
	/**
	 * Variable associated with `delivery_street_address` column in table.
	 *
	 * @var string
	 */
	protected $deliveryAddress = null;
	
	/**
	 * Variable associated with `delivery_suburb` column in table.
	 *
	 * @var string
	 */
	protected $delivery_suburb = null;
	
	/**
	 * Variable associated with `delivery_city` column in table.
	 *
	 * @var string
	 */
	protected $delivery_city = null;
	
	/**
	 * Variable associated with `delivery_postcode` column in table.
	 *
	 * @var string
	 */
	protected $delivery_postcode = null;
	
	/**
	 * Variable associated with `delivery_state` column in table.
	 *
	 * @var string
	 */
	protected $delivery_state = null;
	
	/**
	 * Variable associated with `delivery_country` column in table.
	 *
	 * @var string
	 */
	protected $delivery_country = null;
	
	/**
	 * Variable associated with `delivery_address_format_id` column in table.
	 *
	 * @var string
	 */
	protected $delivery_address_format_id = null;
	
	/**
	 * Variable associated with `billing_name` column in table.
	 *
	 * @var string
	 */
	protected $billingName = null;
	
	/**
	 * Variable associated with `billing_company` column in table.
	 *
	 * @var string
	 */
	protected $billingCompany = null;
	
	/**
	 * Variable associated with `billing_street_address` column in table.
	 *
	 * @var string
	 */
	protected $billingAddress = null;
	
	/**
	 * Variable associated with `billing_suburb` column in table.
	 *
	 * @var string
	 */
	protected $billing_suburb = null;
	
	/**
	 * Variable associated with `billing_city` column in table.
	 *
	 * @var string
	 */
	protected $billing_city = null;
	
	/**
	 * Variable associated with `billing_postcode` column in table.
	 *
	 * @var string
	 */
	protected $billing_postcode = null;
	
	/**
	 * Variable associated with `billing_state` column in table.
	 *
	 * @var string
	 */
	protected $billing_state = null;
	
	/**
	 * Variable associated with `billing_country` column in table.
	 *
	 * @var string
	 */
	protected $billing_country = null;
	
	/**
	 * Variable associated with `billing_address_format_id` column in table.
	 *
	 * @var string
	 */
	protected $billing_address_format_id = null;
	
	/**
	 * Variable associated with `payment_method` column in table.
	 *
	 * @var string
	 */
	protected $paymentMethod = null;
	
	/**
	 * Variable associated with `payment_module_code` column in table.
	 *
	 * @var string
	 */
	protected $paymentModuleCode = null;
	
	/**
	 * Variable associated with `shipping_method` column in table.
	 *
	 * @var string
	 */
	protected $shippingMethod = null;
	
	/**
	 * Variable associated with `shipping_module_code` column in table.
	 *
	 * @var string
	 */
	protected $shippingModuleCode = null;
	
	/**
	 * Variable associated with `coupon_code` column in table.
	 *
	 * @var string
	 */
	protected $couponCode = null;
	
	/**
	 * Variable associated with `cc_type` column in table.
	 *
	 * @var string
	 */
	protected $cc_type = null;
	
	/**
	 * Variable associated with `cc_owner` column in table.
	 *
	 * @var string
	 */
	protected $cc_owner = null;
	
	/**
	 * Variable associated with `cc_number` column in table.
	 *
	 * @var string
	 */
	protected $cc_number = null;
	
	/**
	 * Variable associated with `cc_expires` column in table.
	 *
	 * @var string
	 */
	protected $cc_expires = null;
	
	/**
	 * Variable associated with `cc_cvv` column in table.
	 *
	 * @var string
	 */
	protected $cc_cvv = null;
	
	/**
	 * Variable associated with `last_modified` column in table.
	 *
	 * @var string
	 */
	protected $last_modified = null;
	
	/**
	 * Variable associated with `date_purchased` column in table.
	 *
	 * @var string
	 */
	protected $date_purchased = null;
	
	/**
	 * Variable associated with `orders_status` column in table.
	 *
	 * @var string
	 */
	protected $status = null;
	
	/**
	 * Variable associated with `orders_date_finished` column in table.
	 *
	 * @var string
	 */
	protected $date_finished = null;
	
	/**
	 * Variable associated with `currency` column in table.
	 *
	 * @var string
	 */
	protected $currency = null;
	
	/**
	 * Variable associated with `currency_value` column in table.
	 *
	 * @var string
	 */
	protected $currencyValue = null;
	
	/**
	 * Variable associated with `order_total` column in table.
	 *
	 * @var string
	 */
	protected $total = null;
	
	/**
	 * Variable associated with `order_tax` column in table.
	 *
	 * @var string
	 */
	protected $tax = null;
	
	/**
	 * Variable associated with `paypal_ipn_id` column in table.
	 *
	 * @var string
	 */
	protected $paypal_ipn_id = null;
	
	/**
	 * Variable associated with `ip_address` column in table.
	 *
	 * @var string
	 */
	protected $ip_address = null;
	
	protected $subtotal = null;
	
	protected $shipping_cost = null; 
	
	protected $delivery_directions = null; 
	
	/**
	 * Create an instance of the CartOrder class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartOrder object is returned.
	 *
	 * @param int $orders_id
	 * @return CartOrder object
	 */
	public function __construct( $orders_id = null ) {
		if (!is_null($orders_id)) {
			$sql = 'select * from cart_orders where orders_id=' . $orders_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}
			$this->setId($result['orders_id']);
			$this->setCustomer($result['customers_id']);
			$this->setCustomerName($result['customers_name']);
			$this->setCustomerCompany($result['customers_company']);
			$this->setCustomerAddress($result['customers_street_address']);
			$this->setCustomers_suburb($result['customers_suburb']);
			$this->setCustomers_city($result['customers_city']);
			$this->setCustomers_postcode($result['customers_postcode']);
			$this->setCustomers_state($result['customers_state']);
			$this->setCustomers_country($result['customers_country']);
			$this->setCustomerTelephone($result['customers_telephone']);
			$this->setCustomerEmail($result['customers_email_address']);
			$this->setCustomers_address_format_id($result['customers_address_format_id']);
			$this->setDeliveryName($result['delivery_name']);
			$this->setDeliveryCompany($result['delivery_company']);
			$this->setDeliveryAddress($result['delivery_street_address']);
			$this->setDelivery_suburb($result['delivery_suburb']);
			$this->setDelivery_city($result['delivery_city']);
			$this->setDelivery_postcode($result['delivery_postcode']);
			$this->setDelivery_state($result['delivery_state']);
			$this->setDelivery_country($result['delivery_country']);
			$this->setDelivery_address_format_id($result['delivery_address_format_id']);
			$this->setBillingName($result['billing_name']);
			$this->setBillingCompany($result['billing_company']);
			$this->setBillingAddress($result['billing_street_address']);
			$this->setBilling_suburb($result['billing_suburb']);
			$this->setBilling_city($result['billing_city']);
			$this->setBilling_postcode($result['billing_postcode']);
			$this->setBilling_state($result['billing_state']);
			$this->setBilling_country($result['billing_country']);
			$this->setBilling_address_format_id($result['billing_address_format_id']);
			$this->setPaymentMethod($result['payment_method']);
			$this->setPaymentModuleCode($result['payment_module_code']);
			$this->setShippingMethod($result['shipping_method']);
			$this->setShippingModuleCode($result['shipping_module_code']);
			$this->setCouponCode($result['coupon_code']);
			$this->setCc_type($result['cc_type']);
			$this->setCc_owner($result['cc_owner']);
			$this->setCc_number($result['cc_number']);
			$this->setCc_expires($result['cc_expires']);
			$this->setCc_cvv($result['cc_cvv']);
			$this->setLast_modified($result['last_modified']);
			$this->setDate_purchased($result['date_purchased']);
			$this->setStatus($result['orders_status']);
			$this->setDate_finished($result['orders_date_finished']);
			$this->setCurrency($result['currency']);
			$this->setCurrencyValue($result['currency_value']);
			$this->setTotal($result['order_total']);
			$this->setTax($result['order_tax']);
			$this->setPaypal_ipn_id($result['paypal_ipn_id']);
			$this->setIp_address($result['ip_address']);
			$this->setDeliveryDirections($result['delivery_directions']);
		}
	}

	/**
	 * Returns the object's Id
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the object's Customer
	 *
	 * @return string
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * Returns the object's CustomerName
	 *
	 * @return string
	 */
	public function getCustomerName() {
		return $this->customerName;
	}

	/**
	 * Returns the object's CustomerCompany
	 *
	 * @return string
	 */
	public function getCustomerCompany() {
		return $this->customerCompany;
	}

	/**
	 * Returns the object's CustomerAddress
	 *
	 * @return string
	 */
	public function getCustomerAddress() {
		return $this->customerAddress;
	}

	/**
	 * Returns the object's Customers_suburb
	 *
	 * @return string
	 */
	public function getCustomers_suburb() {
		return $this->customers_suburb;
	}

	/**
	 * Returns the object's Customers_city
	 *
	 * @return string
	 */
	public function getCustomers_city() {
		return $this->customers_city;
	}

	/**
	 * Returns the object's Customers_postcode
	 *
	 * @return string
	 */
	public function getCustomers_postcode() {
		return $this->customers_postcode;
	}

	/**
	 * Returns the object's Customers_state
	 *
	 * @return string
	 */
	public function getCustomers_state() {
		return $this->customers_state;
	}

	/**
	 * Returns the object's Customers_country
	 *
	 * @return string
	 */
	public function getCustomers_country() {
		return $this->customers_country;
	}

	/**
	 * Returns the object's CustomerTelephone
	 *
	 * @return string
	 */
	public function getCustomerTelephone() {
		return $this->customerTelephone;
	}

	/**
	 * Returns the object's CustomerEmail
	 *
	 * @return string
	 */
	public function getCustomerEmail() {
		return $this->customerEmail;
	}

	/**
	 * Returns the object's Customers_address_format_id
	 *
	 * @return string
	 */
	public function getCustomers_address_format_id() {
		return $this->customers_address_format_id;
	}

	/**
	 * Returns the object's DeliveryName
	 *
	 * @return string
	 */
	public function getDeliveryName() {
		return $this->deliveryName;
	}

	/**
	 * Returns the object's DeliveryCompany
	 *
	 * @return string
	 */
	public function getDeliveryCompany() {
		return $this->deliveryCompany;
	}

	/**
	 * Returns the object's DeliveryAddress
	 *
	 * @return string
	 */
	public function getDeliveryAddress() {
		return $this->deliveryAddress;
	}

	/**
	 * Returns the object's Delivery_suburb
	 *
	 * @return string
	 */
	public function getDelivery_suburb() {
		return $this->delivery_suburb;
	}

	/**
	 * Returns the object's Delivery_city
	 *
	 * @return string
	 */
	public function getDelivery_city() {
		return $this->delivery_city;
	}

	/**
	 * Returns the object's Delivery_postcode
	 *
	 * @return string
	 */
	public function getDelivery_postcode() {
		return $this->delivery_postcode;
	}

	/**
	 * Returns the object's Delivery_state
	 *
	 * @return string
	 */
	public function getDelivery_state() {
		return $this->delivery_state;
	}

	/**
	 * Returns the object's Delivery_country
	 *
	 * @return string
	 */
	public function getDelivery_country() {
		return $this->delivery_country;
	}

	/**
	 * Returns the object's Delivery_address_format_id
	 *
	 * @return string
	 */
	public function getDelivery_address_format_id() {
		return $this->delivery_address_format_id;
	}

	/**
	 * Returns the object's BillingName
	 *
	 * @return string
	 */
	public function getBillingName() {
		return $this->billingName;
	}

	/**
	 * Returns the object's BillingCompany
	 *
	 * @return string
	 */
	public function getBillingCompany() {
		return $this->billingCompany;
	}

	/**
	 * Returns the object's BillingAddress
	 *
	 * @return string
	 */
	public function getBillingAddress() {
		return $this->billingAddress;
	}

	/**
	 * Returns the object's Billing_suburb
	 *
	 * @return string
	 */
	public function getBilling_suburb() {
		return $this->billing_suburb;
	}

	/**
	 * Returns the object's Billing_city
	 *
	 * @return string
	 */
	public function getBilling_city() {
		return $this->billing_city;
	}

	/**
	 * Returns the object's Billing_postcode
	 *
	 * @return string
	 */
	public function getBilling_postcode() {
		return $this->billing_postcode;
	}

	/**
	 * Returns the object's Billing_state
	 *
	 * @return string
	 */
	public function getBilling_state() {
		return $this->billing_state;
	}

	/**
	 * Returns the object's Billing_country
	 *
	 * @return string
	 */
	public function getBilling_country() {
		return $this->billing_country;
	}

	/**
	 * Returns the object's Billing_address_format_id
	 *
	 * @return string
	 */
	public function getBilling_address_format_id() {
		return $this->billing_address_format_id;
	}

	/**
	 * Returns the object's PaymentMethod
	 *
	 * @return string
	 */
	public function getPaymentMethod() {
		return $this->paymentMethod;
	}

	/**
	 * Returns the object's PaymentModuleCode
	 *
	 * @return string
	 */
	public function getPaymentModuleCode() {
		return $this->paymentModuleCode;
	}

	/**
	 * Returns the object's ShippingMethod
	 *
	 * @return string
	 */
	public function getShippingMethod() {
		return $this->shippingMethod;
	}

	/**
	 * Returns the object's ShippingModuleCode
	 *
	 * @return string
	 */
	public function getShippingModuleCode() {
		return $this->shippingModuleCode;
	}

	/**
	 * Returns the object's CouponCode
	 *
	 * @return string
	 */
	public function getCouponCode() {
		return $this->couponCode;
	}

	/**
	 * Returns the object's Cc_type
	 *
	 * @return string
	 */
	public function getCc_type() {
		return $this->cc_type;
	}

	/**
	 * Returns the object's Cc_owner
	 *
	 * @return string
	 */
	public function getCc_owner() {
		return $this->cc_owner;
	}

	/**
	 * Returns the object's Cc_number
	 *
	 * @return string
	 */
	public function getCc_number() {
		return $this->cc_number;
	}

	/**
	 * Returns the object's Cc_expires
	 *
	 * @return string
	 */
	public function getCc_expires() {
		return $this->cc_expires;
	}

	/**
	 * Returns the object's Cc_cvv
	 *
	 * @return string
	 */
	public function getCc_cvv() {
		return $this->cc_cvv;
	}

	/**
	 * Returns the object's Last_modified
	 *
	 * @return string
	 */
	public function getLast_modified() {
		return $this->last_modified;
	}

	/**
	 * Returns the object's Date_purchased
	 *
	 * @return string
	 */
	public function getDate_purchased() {
		return $this->date_purchased;
	}

	/**
	 * Returns the object's Status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}
	
	public function getStatusName() {
		$sql = 'select * from cart_orders_status where orders_status_id=' . $this->status;
		$r = Database::singleton()->query_fetch($sql);
		return $r['orders_status_name'];
	}
	
	public static function getStatusArray() {
		$sql = 'select `orders_status_id` as `key`, `orders_status_name` as `value` from cart_orders_status';
		$r = Database::singleton()->query_fetch_all($sql);
		
		$array = array();
		foreach ($r as &$status) {
			$array[$status['key']] = $status['value'];
		}
		return $array;
		
	}

	/**
	 * Returns the object's Date_finished
	 *
	 * @return string
	 */
	public function getDate_finished() {
		return $this->date_finished;
	}

	/**
	 * Returns the object's Currency
	 *
	 * @return string
	 */
	public function getCurrency() {
		return $this->currency;
	}

	public function getDeliveryDirections() {
		return $this->delivery_directions;
	}
	
	/**
	 * Returns the object's CurrencyValue
	 *
	 * @return string
	 */
	public function getCurrencyValue() {
		return $this->currencyValue;
	}

	/**
	 * Returns the object's Total
	 *
	 * @return string
	 */
	public function getTotal() {
		return $this->total;
	}

	/**
	 * Returns the object's Tax
	 *
	 * @return string
	 */
	public function getTax() {
		return $this->tax;
	}

	/**
	 * Returns the object's Paypal_ipn_id
	 *
	 * @return string
	 */
	public function getPaypal_ipn_id() {
		return $this->paypal_ipn_id;
	}

	/**
	 * Returns the object's Ip_address
	 *
	 * @return string
	 */
	public function getIp_address() {
		return $this->ip_address;
	}
	
	public function getOrderHistory() {
		$sql = 'select `orders_status_history_id` from cart_orders_status_history where `orders_id`=' . $this->getId() . ' order by date_added asc';
		$r = Database::singleton()->query_fetch_all($sql);
		
		foreach ($r as &$status) {
			$status = new CartOrderStatusHistory($status['orders_status_history_id']);
		}
		
		return $r;
	}

	/**
	 * Sets the object's Id
	 *
	 * @param string $id New $this->id value
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * Sets the object's Customer
	 *
	 * @param string $customer New $this->customer value
	 */
	public function setCustomer( $customer ) {
		$this->customer = new User($customer);
	}

	/**
	 * Sets the object's CustomerName
	 *
	 * @param string $customerName New $this->customerName value
	 */
	public function setCustomerName( $customerName ) {
		$this->customerName = $customerName;
	}

	/**
	 * Sets the object's CustomerCompany
	 *
	 * @param string $customerCompany New $this->customerCompany value
	 */
	public function setCustomerCompany( $customerCompany ) {
		$this->customerCompany = $customerCompany;
	}

	/**
	 * Sets the object's CustomerAddress
	 *
	 * @param string $customerAddress New $this->customerAddress value
	 */
	public function setCustomerAddress( $customerAddress ) {
		$this->customerAddress = new Address($customerAddress);
	}

	/**
	 * Sets the object's Customers_suburb
	 *
	 * @param string $customers_suburb New $this->customers_suburb value
	 */
	public function setCustomers_suburb( $customers_suburb ) {
		$this->customers_suburb = $customers_suburb;
	}

	/**
	 * Sets the object's Customers_city
	 *
	 * @param string $customers_city New $this->customers_city value
	 */
	public function setCustomers_city( $customers_city ) {
		$this->customers_city = $customers_city;
	}

	/**
	 * Sets the object's Customers_postcode
	 *
	 * @param string $customers_postcode New $this->customers_postcode value
	 */
	public function setCustomers_postcode( $customers_postcode ) {
		$this->customers_postcode = $customers_postcode;
	}

	/**
	 * Sets the object's Customers_state
	 *
	 * @param string $customers_state New $this->customers_state value
	 */
	public function setCustomers_state( $customers_state ) {
		$this->customers_state = $customers_state;
	}

	/**
	 * Sets the object's Customers_country
	 *
	 * @param string $customers_country New $this->customers_country value
	 */
	public function setCustomers_country( $customers_country ) {
		$this->customers_country = $customers_country;
	}

	/**
	 * Sets the object's CustomerTelephone
	 *
	 * @param string $customerTelephone New $this->customerTelephone value
	 */
	public function setCustomerTelephone( $customerTelephone ) {
		$this->customerTelephone = $customerTelephone;
	}

	/**
	 * Sets the object's CustomerEmail
	 *
	 * @param string $customerEmail New $this->customerEmail value
	 */
	public function setCustomerEmail( $customerEmail ) {
		$this->customerEmail = $customerEmail;
	}

	/**
	 * Sets the object's Customers_address_format_id
	 *
	 * @param string $customers_address_format_id New $this->customers_address_format_id value
	 */
	public function setCustomers_address_format_id( $customers_address_format_id ) {
		$this->customers_address_format_id = $customers_address_format_id;
	}

	/**
	 * Sets the object's DeliveryName
	 *
	 * @param string $deliveryName New $this->deliveryName value
	 */
	public function setDeliveryName( $deliveryName ) {
		$this->deliveryName = $deliveryName;
	}

	/**
	 * Sets the object's DeliveryCompany
	 *
	 * @param string $deliveryCompany New $this->deliveryCompany value
	 */
	public function setDeliveryCompany( $deliveryCompany ) {
		$this->deliveryCompany = $deliveryCompany;
	}

	/**
	 * Sets the object's DeliveryAddress
	 *
	 * @param string $deliveryAddress New $this->deliveryAddress value
	 */
	public function setDeliveryAddress( $deliveryAddress ) {
		$this->deliveryAddress = new Address($deliveryAddress);
	}

	/**
	 * Sets the object's Delivery_suburb
	 *
	 * @param string $delivery_suburb New $this->delivery_suburb value
	 */
	public function setDelivery_suburb( $delivery_suburb ) {
		$this->delivery_suburb = $delivery_suburb;
	}

	/**
	 * Sets the object's Delivery_city
	 *
	 * @param string $delivery_city New $this->delivery_city value
	 */
	public function setDelivery_city( $delivery_city ) {
		$this->delivery_city = $delivery_city;
	}

	/**
	 * Sets the object's Delivery_postcode
	 *
	 * @param string $delivery_postcode New $this->delivery_postcode value
	 */
	public function setDelivery_postcode( $delivery_postcode ) {
		$this->delivery_postcode = $delivery_postcode;
	}

	/**
	 * Sets the object's Delivery_state
	 *
	 * @param string $delivery_state New $this->delivery_state value
	 */
	public function setDelivery_state( $delivery_state ) {
		$this->delivery_state = $delivery_state;
	}

	/**
	 * Sets the object's Delivery_country
	 *
	 * @param string $delivery_country New $this->delivery_country value
	 */
	public function setDelivery_country( $delivery_country ) {
		$this->delivery_country = $delivery_country;
	}

	/**
	 * Sets the object's Delivery_address_format_id
	 *
	 * @param string $delivery_address_format_id New $this->delivery_address_format_id value
	 */
	public function setDelivery_address_format_id( $delivery_address_format_id ) {
		$this->delivery_address_format_id = $delivery_address_format_id;
	}

	/**
	 * Sets the object's BillingName
	 *
	 * @param string $billingName New $this->billingName value
	 */
	public function setBillingName( $billingName ) {
		$this->billingName = $billingName;
	}

	/**
	 * Sets the object's BillingCompany
	 *
	 * @param string $billingCompany New $this->billingCompany value
	 */
	public function setBillingCompany( $billingCompany ) {
		$this->billingCompany = $billingCompany;
	}

	/**
	 * Sets the object's BillingAddress
	 *
	 * @param string $billingAddress New $this->billingAddress value
	 */
	public function setBillingAddress( $billingAddress ) {
		$this->billingAddress = new Address($billingAddress);
	}

	/**
	 * Sets the object's Billing_suburb
	 *
	 * @param string $billing_suburb New $this->billing_suburb value
	 */
	public function setBilling_suburb( $billing_suburb ) {
		$this->billing_suburb = $billing_suburb;
	}

	/**
	 * Sets the object's Billing_city
	 *
	 * @param string $billing_city New $this->billing_city value
	 */
	public function setBilling_city( $billing_city ) {
		$this->billing_city = $billing_city;
	}

	/**
	 * Sets the object's Billing_postcode
	 *
	 * @param string $billing_postcode New $this->billing_postcode value
	 */
	public function setBilling_postcode( $billing_postcode ) {
		$this->billing_postcode = $billing_postcode;
	}

	/**
	 * Sets the object's Billing_state
	 *
	 * @param string $billing_state New $this->billing_state value
	 */
	public function setBilling_state( $billing_state ) {
		$this->billing_state = $billing_state;
	}

	/**
	 * Sets the object's Billing_country
	 *
	 * @param string $billing_country New $this->billing_country value
	 */
	public function setBilling_country( $billing_country ) {
		$this->billing_country = $billing_country;
	}

	/**
	 * Sets the object's Billing_address_format_id
	 *
	 * @param string $billing_address_format_id New $this->billing_address_format_id value
	 */
	public function setBilling_address_format_id( $billing_address_format_id ) {
		$this->billing_address_format_id = $billing_address_format_id;
	}

	/**
	 * Sets the object's PaymentMethod
	 *
	 * @param string $paymentMethod New $this->paymentMethod value
	 */
	public function setPaymentMethod( $paymentMethod ) {
		$this->paymentMethod = $paymentMethod;
	}

	/**
	 * Sets the object's PaymentModuleCode
	 *
	 * @param string $paymentModuleCode New $this->paymentModuleCode value
	 */
	public function setPaymentModuleCode( $paymentModuleCode ) {
		$this->paymentModuleCode = $paymentModuleCode;
	}

	/**
	 * Sets the object's ShippingMethod
	 *
	 * @param string $shippingMethod New $this->shippingMethod value
	 */
	public function setShippingMethod( $shippingMethod ) {
		$this->shippingMethod = $shippingMethod;
	}

	/**
	 * Sets the object's ShippingModuleCode
	 *
	 * @param string $shippingModuleCode New $this->shippingModuleCode value
	 */
	public function setShippingModuleCode( $shippingModuleCode ) {
		$this->shippingModuleCode = $shippingModuleCode;
	}

	/**
	 * Sets the object's CouponCode
	 *
	 * @param string $couponCode New $this->couponCode value
	 */
	public function setCouponCode( $couponCode ) {
		$this->couponCode = $couponCode;
	}

	/**
	 * Sets the object's Cc_type
	 *
	 * @param string $cc_type New $this->cc_type value
	 */
	public function setCc_type( $cc_type ) {
		$this->cc_type = $cc_type;
	}

	/**
	 * Sets the object's Cc_owner
	 *
	 * @param string $cc_owner New $this->cc_owner value
	 */
	public function setCc_owner( $cc_owner ) {
		$this->cc_owner = $cc_owner;
	}

	/**
	 * Sets the object's Cc_number
	 *
	 * @param string $cc_number New $this->cc_number value
	 */
	public function setCc_number( $cc_number ) {
		$this->cc_number = $cc_number;
	}

	/**
	 * Sets the object's Cc_expires
	 *
	 * @param string $cc_expires New $this->cc_expires value
	 */
	public function setCc_expires( $cc_expires ) {
		$this->cc_expires = $cc_expires;
	}

	/**
	 * Sets the object's Cc_cvv
	 *
	 * @param string $cc_cvv New $this->cc_cvv value
	 */
	public function setCc_cvv( $cc_cvv ) {
		$this->cc_cvv = $cc_cvv;
	}

	/**
	 * Sets the object's Last_modified
	 *
	 * @param string $last_modified New $this->last_modified value
	 */
	public function setLast_modified( $last_modified ) {
		$this->last_modified = $last_modified;
	}

	/**
	 * Sets the object's Date_purchased
	 *
	 * @param string $date_purchased New $this->date_purchased value
	 */
	public function setDate_purchased( $date_purchased ) {
		$this->date_purchased = $date_purchased;
	}

	/**
	 * Sets the object's Status
	 *
	 * @param string $status New $this->status value
	 */
	public function setStatus( $status ) {
		$this->status = new CartOrderStatus($status);
	}

	/**
	 * Sets the object's Date_finished
	 *
	 * @param string $date_finished New $this->date_finished value
	 */
	public function setDate_finished( $date_finished ) {
		$this->date_finished = $date_finished;
	}

	/**
	 * Sets the object's Currency
	 *
	 * @param string $currency New $this->currency value
	 */
	public function setCurrency( $currency ) {
		$this->currency = $currency;
	}

	/**
	 * Sets the object's CurrencyValue
	 *
	 * @param string $currencyValue New $this->currencyValue value
	 */
	public function setCurrencyValue( $currencyValue ) {
		$this->currencyValue = $currencyValue;
	}

	/**
	 * Sets the object's Total
	 *
	 * @param string $total New $this->total value
	 */
	public function setTotal( $total ) {
		$this->total = $total;
	}

	/**
	 * Sets the object's Tax
	 *
	 * @param string $tax New $this->tax value
	 */
	public function setTax( $tax ) {
		$this->tax = $tax;
	}

	/**
	 * Sets the object's Paypal_ipn_id
	 *
	 * @param string $paypal_ipn_id New $this->paypal_ipn_id value
	 */
	public function setPaypal_ipn_id( $paypal_ipn_id ) {
		$this->paypal_ipn_id = $paypal_ipn_id;
	}

	/**
	 * Sets the object's Ip_address
	 *
	 * @param string $ip_address New $this->ip_address value
	 */
	public function setIp_address( $ip_address ) {
		$this->ip_address = $ip_address;
	}

	public function setSubTotal($subtotal) {
		$this->subtotal = $subtotal;
	}

	public function setDeliveryDirections($delivery_directions) {
		$this->delivery_directions = $delivery_directions;
	}
	
	public function setShippingCost($cost) {
		$this->shipping_cost = $cost;
	}

	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_orders set ';
		} else {
			$sql = 'insert into cart_orders set ';
		}
		if (!is_null($this->getCustomer())) {
			$sql .= '`customers_id`="' . e($this->getCustomer()->getId()) . '", ';
		}
		if (!is_null($this->getCustomerName())) {
			$sql .= '`customers_name`="' . e($this->getCustomerName()) . '", ';
		}
		if (!is_null($this->getCustomerCompany())) {
			$sql .= '`customers_company`="' . e($this->getCustomerCompany()) . '", ';
		}
		if (!is_null($this->getCustomerAddress())) {
			$sql .= '`customers_street_address`="' . e($this->getCustomerAddress()->getId()) . '", ';
		}
		if (!is_null($this->getCustomers_suburb())) {
			$sql .= '`customers_suburb`="' . e($this->getCustomers_suburb()) . '", ';
		}
		if (!is_null($this->getCustomers_city())) {
			$sql .= '`customers_city`="' . e($this->getCustomers_city()) . '", ';
		}
		if (!is_null($this->getCustomers_postcode())) {
			$sql .= '`customers_postcode`="' . e($this->getCustomers_postcode()) . '", ';
		}
		if (!is_null($this->getCustomers_state())) {
			$sql .= '`customers_state`="' . e($this->getCustomers_state()) . '", ';
		}
		if (!is_null($this->getCustomers_country())) {
			$sql .= '`customers_country`="' . e($this->getCustomers_country()) . '", ';
		}
		if (!is_null($this->getCustomerTelephone())) {
			$sql .= '`customers_telephone`="' . e($this->getCustomerTelephone()) . '", ';
		}
		if (!is_null($this->getCustomerEmail())) {
			$sql .= '`customers_email_address`="' . e($this->getCustomerEmail()) . '", ';
		}
		if (!is_null($this->getCustomers_address_format_id())) {
			$sql .= '`customers_address_format_id`="' . e($this->getCustomers_address_format_id()) . '", ';
		}
		if (!is_null($this->getDeliveryName())) {
			$sql .= '`delivery_name`="' . e($this->getDeliveryName()) . '", ';
		}
		if (!is_null($this->getDeliveryCompany())) {
			$sql .= '`delivery_company`="' . e($this->getDeliveryCompany()) . '", ';
		}
		if (!is_null($this->getDeliveryAddress())) {
			$sql .= '`delivery_street_address`="' . e($this->getDeliveryAddress()->getId()) . '", ';
		}
		if (!is_null($this->getDelivery_suburb())) {
			$sql .= '`delivery_suburb`="' . e($this->getDelivery_suburb()) . '", ';
		}
		if (!is_null($this->getDelivery_city())) {
			$sql .= '`delivery_city`="' . e($this->getDelivery_city()) . '", ';
		}
		if (!is_null($this->getDelivery_postcode())) {
			$sql .= '`delivery_postcode`="' . e($this->getDelivery_postcode()) . '", ';
		}
		if (!is_null($this->getDelivery_state())) {
			$sql .= '`delivery_state`="' . e($this->getDelivery_state()) . '", ';
		}
		if (!is_null($this->getDelivery_country())) {
			$sql .= '`delivery_country`="' . e($this->getDelivery_country()) . '", ';
		}
		if (!is_null($this->getDelivery_address_format_id())) {
			$sql .= '`delivery_address_format_id`="' . e($this->getDelivery_address_format_id()) . '", ';
		}
		if (!is_null($this->getBillingName())) {
			$sql .= '`billing_name`="' . e($this->getBillingName()) . '", ';
		}
		if (!is_null($this->getBillingCompany())) {
			$sql .= '`billing_company`="' . e($this->getBillingCompany()) . '", ';
		}
		if (!is_null($this->getBillingAddress())) {
			$sql .= '`billing_street_address`="' . e($this->getBillingAddress()->getId()) . '", ';
		}
		if (!is_null($this->getBilling_suburb())) {
			$sql .= '`billing_suburb`="' . e($this->getBilling_suburb()) . '", ';
		}
		if (!is_null($this->getBilling_city())) {
			$sql .= '`billing_city`="' . e($this->getBilling_city()) . '", ';
		}
		if (!is_null($this->getBilling_postcode())) {
			$sql .= '`billing_postcode`="' . e($this->getBilling_postcode()) . '", ';
		}
		if (!is_null($this->getBilling_state())) {
			$sql .= '`billing_state`="' . e($this->getBilling_state()) . '", ';
		}
		if (!is_null($this->getBilling_country())) {
			$sql .= '`billing_country`="' . e($this->getBilling_country()) . '", ';
		}
		if (!is_null($this->getBilling_address_format_id())) {
			$sql .= '`billing_address_format_id`="' . e($this->getBilling_address_format_id()) . '", ';
		}
		if (!is_null($this->getPaymentMethod())) {
			$sql .= '`payment_method`="' . e($this->getPaymentMethod()) . '", ';
		}
		if (!is_null($this->getPaymentModuleCode())) {
			$sql .= '`payment_module_code`="' . e($this->getPaymentModuleCode()) . '", ';
		}
		if (!is_null($this->getShippingMethod())) {
			$sql .= '`shipping_method`="' . e($this->getShippingMethod()) . '", ';
		}
		if (!is_null($this->getShippingModuleCode())) {
			$sql .= '`shipping_module_code`="' . e($this->getShippingModuleCode()) . '", ';
		}
		if (!is_null($this->getCouponCode())) {
			$sql .= '`coupon_code`="' . e($this->getCouponCode()) . '", ';
		}
		if (!is_null($this->getCc_type())) {
			$sql .= '`cc_type`="' . e($this->getCc_type()) . '", ';
		}
		if (!is_null($this->getCc_owner())) {
			$sql .= '`cc_owner`="' . e($this->getCc_owner()) . '", ';
		}
		if (!is_null($this->getCc_number())) {
			$sql .= '`cc_number`="' . e($this->getCc_number()) . '", ';
		}
		if (!is_null($this->getCc_expires())) {
			$sql .= '`cc_expires`="' . e($this->getCc_expires()) . '", ';
		}
		if (!is_null($this->getCc_cvv())) {
			$sql .= '`cc_cvv`="' . e($this->getCc_cvv()) . '", ';
		}
		if (!is_null($this->getLast_modified())) {
			$sql .= '`last_modified`="' . e($this->getLast_modified()) . '", ';
		}
		if (!is_null($this->getDate_purchased())) {
			$sql .= '`date_purchased`="' . e($this->getDate_purchased()) . '", ';
		}
		if (!is_null($this->getStatus())) {
			$sql .= '`orders_status`="' . e($this->getStatus()->getId()) . '", ';
		}
		if (!is_null($this->getDate_finished())) {
			$sql .= '`orders_date_finished`="' . e($this->getDate_finished()) . '", ';
		}
		if (!is_null($this->getCurrency())) {
			$sql .= '`currency`="' . e($this->getCurrency()) . '", ';
		}
		if (!is_null($this->getCurrencyValue())) {
			$sql .= '`currency_value`="' . e($this->getCurrencyValue()) . '", ';
		}
		if (!is_null($this->getTotal())) {
			$sql .= '`order_total`="' . e($this->getTotal()) . '", ';
		}
		if (!is_null($this->getTax())) {
			$sql .= '`order_tax`="' . e($this->getTax()) . '", ';
		}
		if (!is_null($this->getPaypal_ipn_id())) {
			$sql .= '`paypal_ipn_id`="' . e($this->getPaypal_ipn_id()) . '", ';
		}
		if (!is_null($this->getIp_address())) {
			$sql .= '`ip_address`="' . e($this->getIp_address()) . '", ';
		}
		if (!is_null($this->getDeliveryDirections())) {
			$sql .= '`delivery_directions`="' . e($this->getDeliveryDirections()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'orders_id="' . e($this->getId()) . '" where orders_id="' . e($this->getId()) . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->getId())) {
			$this->setId(Database::singleton()->lastInsertedID());
			
			$sql = 'insert into `cart_orders_total` set orders_id=' . $this->getId() . ', ';
			$sql .= '`title`="Sub-Total:", ';
			$sql .= '`text`="$' . $this->subtotal . '", ';
			$sql .= '`value`="' . $this->subtotal . '", ';
			$sql .= '`class`="ot_subtotal", ';
			$sql .= '`sort_order`="100"';
			Database::singleton()->query($sql);
			
			$sql = 'insert into `cart_orders_total` set orders_id=' . $this->getId() . ', ';
			$sql .= '`title`="Tax:", ';
			$sql .= '`text`="$' . number_format($this->getTax(), 2) . '", ';
			$sql .= '`value`="' . $this->getTax() . '", ';
			$sql .= '`class`="ot_tax", ';
			$sql .= '`sort_order`="300"';
			Database::singleton()->query($sql);
			
			$sql = 'insert into `cart_orders_total` set orders_id=' . $this->getId() . ', ';
			$sql .= '`title`="Shipping:", ';
			$sql .= '`text`="$' . number_format($this->shipping_cost, 2) . '", ';
			$sql .= '`value`="' . $this->shipping_cost . '", ';
			$sql .= '`class`="ot_shipping", ';
			$sql .= '`sort_order`="200"';
			Database::singleton()->query($sql);
			
			$sql = 'insert into `cart_orders_total` set orders_id=' . $this->getId() . ', ';
			$sql .= '`title`="Total:", ';
			$sql .= '`text`="$' . number_format($this->getTotal(), 2) . '", ';
			$sql .= '`value`="' . $this->getTotal() . '", ';
			$sql .= '`class`="ot_total", ';
			$sql .= '`sort_order`="999"';
			Database::singleton()->query($sql);
			
			self::__construct($this->getId());
		}
		
	}

	/**
	 * Delete the object from the database
	 */
	public function delete() {
		$sql = 'delete from cart_orders where orders_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartOrder_addedit', 'post', $target);
		
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		$form->setConstants( array ( 'section' => 'orders' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartorder_orders_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartorder_orders_id' );
			
			$defaultValues ['cartorder_customer'] = $this->getCustomer()->getId();
			$defaultValues ['cartorder_customerName'] = $this->getCustomerName();
			$defaultValues ['cartorder_customerCompany'] = $this->getCustomerCompany();
			$defaultValues ['cartorder_customerAddress'] = $this->getCustomerAddress()->getId();
			$defaultValues ['cartorder_customers_suburb'] = $this->getCustomers_suburb();
			$defaultValues ['cartorder_customers_city'] = $this->getCustomers_city();
			$defaultValues ['cartorder_customers_postcode'] = $this->getCustomers_postcode();
			$defaultValues ['cartorder_customers_state'] = $this->getCustomers_state();
			$defaultValues ['cartorder_customers_country'] = $this->getCustomers_country();
			$defaultValues ['cartorder_customerTelephone'] = $this->getCustomerTelephone();
			$defaultValues ['cartorder_customerEmail'] = $this->getCustomerEmail();
			$defaultValues ['cartorder_customers_address_format_id'] = $this->getCustomers_address_format_id();
			$defaultValues ['cartorder_deliveryName'] = $this->getDeliveryName();
			$defaultValues ['cartorder_deliveryCompany'] = $this->getDeliveryCompany();
			$defaultValues ['cartorder_deliveryAddress'] = $this->getDeliveryAddress()->getId();
			$defaultValues ['cartorder_delivery_suburb'] = $this->getDelivery_suburb();
			$defaultValues ['cartorder_delivery_city'] = $this->getDelivery_city();
			$defaultValues ['cartorder_delivery_postcode'] = $this->getDelivery_postcode();
			$defaultValues ['cartorder_delivery_state'] = $this->getDelivery_state();
			$defaultValues ['cartorder_delivery_country'] = $this->getDelivery_country();
			$defaultValues ['cartorder_delivery_address_format_id'] = $this->getDelivery_address_format_id();
			$defaultValues ['cartorder_billingName'] = $this->getBillingName();
			$defaultValues ['cartorder_billingCompany'] = $this->getBillingCompany();
			$defaultValues ['cartorder_billingAddress'] = $this->getBillingAddress()->getId();
			$defaultValues ['cartorder_billing_suburb'] = $this->getBilling_suburb();
			$defaultValues ['cartorder_billing_city'] = $this->getBilling_city();
			$defaultValues ['cartorder_billing_postcode'] = $this->getBilling_postcode();
			$defaultValues ['cartorder_billing_state'] = $this->getBilling_state();
			$defaultValues ['cartorder_billing_country'] = $this->getBilling_country();
			$defaultValues ['cartorder_billing_address_format_id'] = $this->getBilling_address_format_id();
			$defaultValues ['cartorder_paymentMethod'] = $this->getPaymentMethod();
			$defaultValues ['cartorder_paymentModuleCode'] = $this->getPaymentModuleCode();
			$defaultValues ['cartorder_shippingMethod'] = $this->getShippingMethod();
			$defaultValues ['cartorder_shippingModuleCode'] = $this->getShippingModuleCode();
			$defaultValues ['cartorder_couponCode'] = $this->getCouponCode();
			$defaultValues ['cartorder_cc_type'] = $this->getCc_type();
			$defaultValues ['cartorder_cc_owner'] = $this->getCc_owner();
			$defaultValues ['cartorder_cc_number'] = $this->getCc_number();
			$defaultValues ['cartorder_cc_expires'] = $this->getCc_expires();
			$defaultValues ['cartorder_cc_cvv'] = $this->getCc_cvv();
			$defaultValues ['cartorder_last_modified'] = $this->getLast_modified();
			$defaultValues ['cartorder_date_purchased'] = $this->getDate_purchased();
			$defaultValues ['cartorder_status'] = $this->getStatus()->getId();
			$defaultValues ['cartorder_date_finished'] = $this->getDate_finished();
			$defaultValues ['cartorder_currency'] = $this->getCurrency();
			$defaultValues ['cartorder_currencyValue'] = $this->getCurrencyValue();
			$defaultValues ['cartorder_total'] = $this->getTotal();
			$defaultValues ['cartorder_tax'] = $this->getTax();
			$defaultValues ['cartorder_paypal_ipn_id'] = $this->getPaypal_ipn_id();
			$defaultValues ['cartorder_ip_address'] = $this->getIp_address();
			$defaultValues ['cartorder_delivery_directions'] = $this->getDeliveryDirections();
			
			$form->setDefaults( $defaultValues );
		}

		/*
		$form->addElement('text', 'cartorder_customer', 'customer');
		$form->addElement('text', 'cartorder_customerName', 'customerName');
		$form->addElement('text', 'cartorder_customerCompany', 'customerCompany');
		$form->addElement('text', 'cartorder_customerAddress', 'customerAddress');
		$form->addElement('text', 'cartorder_customers_suburb', 'customers_suburb');
		$form->addElement('text', 'cartorder_customers_city', 'customers_city');
		$form->addElement('text', 'cartorder_customers_postcode', 'customers_postcode');
		$form->addElement('text', 'cartorder_customers_state', 'customers_state');
		$form->addElement('text', 'cartorder_customers_country', 'customers_country');
		$form->addElement('text', 'cartorder_customerTelephone', 'customerTelephone');
		$form->addElement('text', 'cartorder_customerEmail', 'customerEmail');
		$form->addElement('text', 'cartorder_customers_address_format_id', 'customers_address_format_id');
		$form->addElement('text', 'cartorder_deliveryName', 'deliveryName');
		$form->addElement('text', 'cartorder_deliveryCompany', 'deliveryCompany');
		$form->addElement('text', 'cartorder_deliveryAddress', 'deliveryAddress');
		$form->addElement('text', 'cartorder_delivery_suburb', 'delivery_suburb');
		$form->addElement('text', 'cartorder_delivery_city', 'delivery_city');
		$form->addElement('text', 'cartorder_delivery_postcode', 'delivery_postcode');
		$form->addElement('text', 'cartorder_delivery_state', 'delivery_state');
		$form->addElement('text', 'cartorder_delivery_country', 'delivery_country');
		$form->addElement('text', 'cartorder_delivery_address_format_id', 'delivery_address_format_id');
		$form->addElement('text', 'cartorder_billingName', 'billingName');
		$form->addElement('text', 'cartorder_billingCompany', 'billingCompany');
		$form->addElement('text', 'cartorder_billingAddress', 'billingAddress');
		$form->addElement('text', 'cartorder_billing_suburb', 'billing_suburb');
		$form->addElement('text', 'cartorder_billing_city', 'billing_city');
		$form->addElement('text', 'cartorder_billing_postcode', 'billing_postcode');
		$form->addElement('text', 'cartorder_billing_state', 'billing_state');
		$form->addElement('text', 'cartorder_billing_country', 'billing_country');
		$form->addElement('text', 'cartorder_billing_address_format_id', 'billing_address_format_id');
		$form->addElement('text', 'cartorder_paymentMethod', 'paymentMethod');
		$form->addElement('text', 'cartorder_paymentModuleCode', 'paymentModuleCode');
		$form->addElement('text', 'cartorder_shippingMethod', 'shippingMethod');
		$form->addElement('text', 'cartorder_shippingModuleCode', 'shippingModuleCode');
		$form->addElement('text', 'cartorder_couponCode', 'couponCode');
		$form->addElement('text', 'cartorder_cc_type', 'cc_type');
		$form->addElement('text', 'cartorder_cc_owner', 'cc_owner');
		$form->addElement('text', 'cartorder_cc_number', 'cc_number');
		$form->addElement('text', 'cartorder_cc_expires', 'cc_expires');
		$form->addElement('text', 'cartorder_cc_cvv', 'cc_cvv');
		$form->addElement('text', 'cartorder_last_modified', 'last_modified');
		$form->addElement('text', 'cartorder_date_purchased', 'date_purchased');
		*/
		$form->addElement('select', 'cartorder_status', 'Order Status', self::getStatusArray());
		$form->addElement('textarea', 'cartorder_statuscomment', 'Comment');
		/*
		$form->addElement('text', 'cartorder_date_finished', 'date_finished');
		$form->addElement('text', 'cartorder_currency', 'currency');
		$form->addElement('text', 'cartorder_currencyValue', 'currencyValue');
		$form->addElement('text', 'cartorder_total', 'total');
		$form->addElement('text', 'cartorder_tax', 'tax');
		$form->addElement('text', 'cartorder_paypal_ipn_id', 'paypal_ipn_id');
		$form->addElement('text', 'cartorder_ip_address', 'ip_address'); */
		$form->addElement('submit', 'cartorder_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['cartorder_submit'])) {
			/*
			$this->setCustomer($form->exportValue('cartorder_customer'));
			$this->setCustomerName($form->exportValue('cartorder_customerName'));
			$this->setCustomerCompany($form->exportValue('cartorder_customerCompany'));
			$this->setCustomerAddress($form->exportValue('cartorder_customerAddress'));
			$this->setCustomers_suburb($form->exportValue('cartorder_customers_suburb'));
			$this->setCustomers_city($form->exportValue('cartorder_customers_city'));
			$this->setCustomers_postcode($form->exportValue('cartorder_customers_postcode'));
			$this->setCustomers_state($form->exportValue('cartorder_customers_state'));
			$this->setCustomers_country($form->exportValue('cartorder_customers_country'));
			$this->setCustomerTelephone($form->exportValue('cartorder_customerTelephone'));
			$this->setCustomerEmail($form->exportValue('cartorder_customerEmail'));
			$this->setCustomers_address_format_id($form->exportValue('cartorder_customers_address_format_id'));
			$this->setDeliveryName($form->exportValue('cartorder_deliveryName'));
			$this->setDeliveryCompany($form->exportValue('cartorder_deliveryCompany'));
			$this->setDeliveryAddress($form->exportValue('cartorder_deliveryAddress'));
			$this->setDelivery_suburb($form->exportValue('cartorder_delivery_suburb'));
			$this->setDelivery_city($form->exportValue('cartorder_delivery_city'));
			$this->setDelivery_postcode($form->exportValue('cartorder_delivery_postcode'));
			$this->setDelivery_state($form->exportValue('cartorder_delivery_state'));
			$this->setDelivery_country($form->exportValue('cartorder_delivery_country'));
			$this->setDelivery_address_format_id($form->exportValue('cartorder_delivery_address_format_id'));
			$this->setBillingName($form->exportValue('cartorder_billingName'));
			$this->setBillingCompany($form->exportValue('cartorder_billingCompany'));
			$this->setBillingAddress($form->exportValue('cartorder_billingAddress'));
			$this->setBilling_suburb($form->exportValue('cartorder_billing_suburb'));
			$this->setBilling_city($form->exportValue('cartorder_billing_city'));
			$this->setBilling_postcode($form->exportValue('cartorder_billing_postcode'));
			$this->setBilling_state($form->exportValue('cartorder_billing_state'));
			$this->setBilling_country($form->exportValue('cartorder_billing_country'));
			$this->setBilling_address_format_id($form->exportValue('cartorder_billing_address_format_id'));
			$this->setPaymentMethod($form->exportValue('cartorder_paymentMethod'));
			$this->setPaymentModuleCode($form->exportValue('cartorder_paymentModuleCode'));
			$this->setShippingMethod($form->exportValue('cartorder_shippingMethod'));
			$this->setShippingModuleCode($form->exportValue('cartorder_shippingModuleCode'));
			$this->setCouponCode($form->exportValue('cartorder_couponCode'));
			$this->setCc_type($form->exportValue('cartorder_cc_type'));
			$this->setCc_owner($form->exportValue('cartorder_cc_owner'));
			$this->setCc_number($form->exportValue('cartorder_cc_number'));
			$this->setCc_expires($form->exportValue('cartorder_cc_expires'));
			$this->setCc_cvv($form->exportValue('cartorder_cc_cvv'));
			$this->setLast_modified($form->exportValue('cartorder_last_modified'));
			$this->setDate_purchased($form->exportValue('cartorder_date_purchased'));*/
			$this->setStatus($form->exportValue('cartorder_status'));
			$status_history = new CartOrderStatusHistory();
			$status_history->setCustomer_notified(1);
			$status_history->setDate_added(date('Y-m-d H:i:s'));
			$status_history->setOrderId($this->getId());
			$status_history->setStatus($form->exportValue('cartorder_status'));
			$status_history->setComments($form->exportValue('cartorder_statuscomment'));
			$status_history->save();
			/*
			$this->setDate_finished($form->exportValue('cartorder_date_finished'));
			$this->setCurrency($form->exportValue('cartorder_currency'));
			$this->setCurrencyValue($form->exportValue('cartorder_currencyValue'));
			$this->setTotal($form->exportValue('cartorder_total'));
			$this->setTax($form->exportValue('cartorder_tax'));
			$this->setPaypal_ipn_id($form->exportValue('cartorder_paypal_ipn_id'));
			$this->setIp_address($form->exportValue('cartorder_ip_address')); */
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartOrders($customerId = null) {
		$sql = 'select `orders_id` from cart_orders';
		if (@$customerId){//Get the orders that belong only to this customer
			$sql .= " where customers_id = " . (int)$customerId;
		}
		$sql .= " order by orders_id desc";
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartOrder($result['orders_id']);
		}
		
		return $results;
	}
	
	public function getOrderProducts() {
		require_once('CartOrderProduct.php');
		$sql = 'select orders_products_id from cart_orders_products where orders_id=' . e($this->getId());
		$results = Database::singleton()->query_fetch_all($sql);
		foreach ($results as &$result) {
			$result = new CartOrderProduct($result['orders_products_id']);
		}
		return $results;
	}
	
	public function getOrderTotals() {
		$sql = 'select `text`, `title` from cart_orders_total where orders_id=' . $this->getId() . ' order by sort_order ASC';
		$r = Database::singleton()->query_fetch_all($sql);
		return $r;
	}
	
}

?>