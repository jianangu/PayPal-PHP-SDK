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
 * @property string disputed_transaction_id
 * @property string start_time
 * @property string next_page_token
 * @property integer page
 * @property integer page_size
 *
 * @property \PayPal\Api\Links[] links
 * @property \PayPal\Api\Error[] errors
 */
class Dispute extends PayPalResourceModel
{
    /**
     * search transactions that were made to the merchant who issues the request. Payments can be in any state.
     *
     * @param array $params
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return PaymentHistory
     */
    public function search($params, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $allowedParams = array();
        if (array_key_exists('start_time', $params)) {
//            $allowedParams['start_time'] = 1;
            if (isset($params['page_size'])) {
                $allowedParams['page_size'] = 1;
            }
            if (isset($params['next_page_token'])) {
                $allowedParams['next_page_token'] = 1;
            }
        } elseif (array_key_exists('disputed_transaction_id', $params)) {
            $allowedParams['disputed_transaction_id'] = 1;
        }
        $payLoad = '';
        $json = self::executeCall(
            "/v1/customer/disputes?" . http_build_query(array_intersect_key($params, $allowedParams)),
//            "/v1/customer/disputes?" . http_build_query($params),
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
     * @param string $params
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return PaymentHistory
     */
    public function details($dispute_id, $apiContext = null, $restCall = null)
    {
        $payLoad = "";
        $json = self::executeCall(
            "/v1/customer/disputes/$dispute_id",
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
