<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Core\PayPalConstants;
use PayPal\Validation\ArgumentValidator;
use PayPal\Rest\ApiContext;

/**
 * Class Payment
 *
 * Lets you create, process and manage payments.
 *
 * @package PayPal\Api
 *
 * @property string transaction_id
 * @property string tracking_number
 * @property string tracking_number_type  //CARRIER_PROVIDED  or E2E_PARTNER_PROVIDED
 * @property string status
 * @property string shipment_date
 * @property string carrier
 * @property string carrier_name_other  //Provide this value only if the carrier parameter is OTHER.
 * @property boolean notify_buyer
 * @property string postage_payment_id
 * @property integer quantity
 * @property string tracking_number_validated
 * @property string last_updated_time
 * @property \PayPal\Api\Links[] links
 */
class Tracker extends PayPalResourceModel
{
    /**
     * The PayPal transaction ID.
     *
     * @param string $transaction_id
     *
     * @return $this
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }
    /**
     * The PayPal transaction ID.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }
    /**
     * The tracking number for the shipment.
     *
     * @param string $tracking_number
     *
     * @return $this
     */
    public function setTrackingNumber($tracking_number)
    {
        $this->tracking_number = $tracking_number;
        return $this;
    }

    /**
     * The tracking number for the shipment.
     *
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->tracking_number;
    }
    /**
     * The type of tracking number. The possible values are:
    CARRIER_PROVIDED. A merchant-provided tracking number.
    E2E_PARTNER_PROVIDED. A marketplace-provided tracking number.
     *
     * @param string $tracking_number_type
     *
     * @return $this
     */
    public function setTrackingNumberType($tracking_number_type)
    {
        $this->tracking_number_type = $tracking_number_type;
        return $this;
    }

    /**
     * The type of tracking number.
     *
     * @return string
     */
    public function getTrackingNumberType()
    {
        return $this->tracking_number_type;
    }
    /**
     * The status of the item shipment.
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * The status of the item shipment.
     *
     * @return string
     * @link https://developer.paypal.com/docs/tracking/reference/shipping-status/
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * The date when the shipment occurred
     *
     * @param string $shipment_date
     *
     * @return $this
     */
    public function setShipmentDate($shipment_date)
    {
        $this->shipment_date = $shipment_date;
        return $this;
    }

    /**
     * The date when the shipment occurred
     * @return string
     */
    public function getShipmentDate()
    {
        return $this->shipment_date;
    }
    /**
     *
     * The carrier for the shipment. Some carriers have a global version as well as local subsidiaries. The subsidiaries are repeated over many countries and might also have an entry in the global list. Choose the carrier for your country. If the carrier is not available for your country, choose the global version of the carrier. If your carrier name is not in the list, set carrier_other_name to OTHER.
     *
     * @param string $carrier
     *
     * @return $this
     * @link https://developer.paypal.com/docs/tracking/reference/carriers/
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }
    /**
     * The carrier for the shipment.
     *
     * @return string
     */
    public function getCarrier()
    {
        return $this->carrier;
    }
    /**
     *
     * The name of the carrier for the shipment. Provide this value only if the carrier parameter is OTHER.
     * @param string $carrier_name_other
     *
     * @return $this
     */
    public function setCarrierNameOther($carrier_name_other)
    {
        $this->carrier_name_other = $carrier_name_other;
        return $this;
    }
    /**
     * The name of the carrier for the shipment. Provide this value only if the carrier parameter is OTHER.
     *
     * @return string
     */
    public function getCarrierNameOther()
    {
        return $this->carrier_name_other;
    }
    /**
     * The postage payment ID.
     * @return string
     */
    public function getPostagePaymentId()
    {
        return $this->postage_payment_id;
    }
    /**
     *
     * If true, sends an email notification to the buyer of the PayPal transaction. The email contains the tracking information that was uploaded through the API. @param string $carrier_name_other
     *
     * @return $this
     */
    public function setNotifyBuyer($notify_buyer)
    {
        $this->notify_buyer = $notify_buyer;
        return $this;
    }
    /**
     * If true, sends an email notification to the buyer of the PayPal transaction. The email contains the tracking information that was uploaded through the API.
     * @return string
     */
    public function getNotifyBuyer()
    {
        return $this->notify_buyer;
    }
    /**
     * The quantity of items shipped.
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * Indicates whether the carrier validated the tracking number.
     * @return string
     */
    public function getTrackingNumberValidated()
    {
        return $this->tracking_number_validated;
    }

    /**
     * The date and time when the tracking information was last updated
     * @param string $last_updated_time
     *
     * @return $this
     */
    public function setLastUpdatedTime($last_updated_time)
    {
        $this->last_updated_time = $last_updated_time;
        return $this;
    }

    /**
     * The date and time when the tracking information was last updated
     * @return string
     */
    public function getLastUpdatedTime()
    {
        return $this->last_updated_time;
    }

    /**
     * The ID of the tracker in the transaction_id-tracking_number format.
     * @return string
     */
    public function getTrackerIdentifier()
    {
        return $this->transaction_id.'-'.$this->tracking_number;
    }
    /**
     * Shows details for a payment, by ID.
     *
     * @param string $paymentId
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return Payment
     */
    public function get($apiContext = null, $restCall = null)
    {
        $id = $this->getTrackerIdentifier();
        ArgumentValidator::validate($id, 'id');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/shipping/trackers/$id",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Tracker();
        $ret->fromJson($json);
        return $ret;
    }
    /**
     * Partially updates a payment, by ID. You can update the amount, shipping address, invoice ID, and custom data. You cannot use patch after execute has been called.
     *
     * @param PatchRequest $patchRequest
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return boolean
     */
    public function update($patchRequest, $apiContext = null, $restCall = null)
    {
        $id = $this->getTrackerIdentifier();
        ArgumentValidator::validate($id, "id");
        ArgumentValidator::validate($patchRequest, 'patchRequest');
        $payLoad = $patchRequest->toJSON();
        self::executeCall(
            "/v1/shipping/trackers/$id",
            "PUT",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        return true;
    }


}
