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
 * @property string id
 * @property Tracker[] trackers
 * @property \PayPal\Api\Links[] links
 * @property \PayPal\Api\Error[] errors
 */
class Trackers extends PayPalResourceModel
{
    /**
     * An array of tracking information for shipments.
     *
     * @return Tracker[]
     */
    public function getTrackers()
    {
        return $this->trackers;
    }

    /**
     * An array of tracking information for shipments..
     *
     * @param Tracker[] $trackers
     *
     * @return $this
     */
    public function setTrackers($trackers)
    {
        $this->trackers = $trackers;
        return $this;
    }

    /**
     * Append tracking information to this list.
     *
     * @param Tracker $tracker
     * @return $this
     */
    public function addTrackers($tracker)
    {
        if (!$this->getTrackers()) {
            return $this->setTrackers(array($tracker));
        } else {
            return $this->getTrackers(
                array_merge($this->getTrackers(), array($tracker))
            );
        }
    }

    /**
     * errors for the batch_add state.
     *
     * @return \PayPal\Api\Error[]
     */
    public function setErrors()
    {
        return $this->errors;
    }

    /**
     * errors for the batch_add state.
     *
     * @return \PayPal\Api\Error[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Creates and processes a payment. In the JSON request body, include a `payment` object with the intent, payer, and transactions. For PayPal payments, include redirect URLs in the `payment` object.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return Trackers
     */
    public function batch($apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "/v1/shipping/trackers-batch",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * Updates or cancels the tracking information for a PayPal transaction, by ID. To cancel tracking information, call this method and set the status to CANCELLED. For more information, see Update or cancel tracking information.  *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return Trackers
     */
    public function update($track_number_new, $apiContext = null, $restCall = null)
    {
        $obj_arr = $this->getTrackers();
        $obj = array_pop($obj_arr);
        $id = $obj->getTransactionId() . '-' . $obj->getTrackingNumber();
        $obj->setTrackingNumber($track_number_new);
        return self::executeCall(
            "/v1/shipping/trackers/$id",
            "PUT",
            $obj->toJSON(),
            null,
            $apiContext,
            $restCall
        );
    }

    /**
     * Updates or cancels the tracking information for a PayPal transaction, by ID. To cancel tracking information, call this method and set the status to CANCELLED. For more information, see Update or cancel tracking information.  *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return Tracker
     */
    public function show($apiContext = null, $restCall = null)
    {
        $obj_arr = $this->getTrackers();
        $obj = array_pop($obj_arr);
        $id = $obj->getTransactionId() . '-' . $obj->getTrackingNumber();
        $json = self::executeCall(
            "/v1/shipping/trackers/$id",
            "GET",
            null,
            null,
            $apiContext,
            $restCall
        );
        $obj_rtn = new Tracker();
        $obj_rtn->fromJson($json);
        return $obj_rtn;
    }
}
