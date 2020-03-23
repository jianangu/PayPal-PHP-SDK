<?php


namespace PayPal\Api;


use PayPal\Common\PayPalResourceModel;
use PayPal\Rest\ApiContext;
use PayPal\Validation\ArgumentValidator;

/**
 * Class Reporting
 *
 * Lets you create, process and manage payments.
 *
 * @package PayPal\Api
 * @property \PayPal\Common\PayPalModel[] transaction_details
 * @property string account_number
 * @property string start_date
 * @property string end_date
 * @property string last_refreshed_datetime
 * @property integer page
 * @property integer total_items
 * @property integer total_pages
 *
 * @property \PayPal\Api\Links[] links
 * @property \PayPal\Api\Error[] errors
 */
class Reporting extends PayPalResourceModel
{
    /**
     * search transactions that were made to the merchant who issues the request. Payments can be in any state.
     *
     * @param array $params
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return PaymentHistory
     */
    public function transactionSearch($params, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $allowedParams = array(
            'transaction_id' => 1,
            'transaction_type' => 1,
            'transaction_status' => 1,
            'transaction_amount' => 1,
            'transaction_currency' => 1,
            'start_date' => 1,
            'end_date' => 1,
            'payment_instrument_type' => 1,
            'store_id' => 1,
            'terminal_id' => 1,
            'fields' => 1,
            'balance_affecting_records_only' => 1,
            'page_size' => 1,
            'page' => 1,

        );
        $json = self::executeCall(
            "/v1/reporting/transactions?" . http_build_query(array_intersect_key($params, $allowedParams)),
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * search transactions that were made to the merchant who issues the request. Payments can be in any state.
     *
     * @param array $params
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return PaymentHistory
     */
    public function listBalances($params, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $allowedParams = array(
            'as_of_time' => 1,
            'currency_code' => 1,
        );
        $json = self::executeCall(
            "/v1/reporting/balances?" . http_build_query(array_intersect_key($params, $allowedParams)),
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }
}
