<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

/**
 * Class ApplicationContext
 *
 *
 * @package PayPal\Api
 *
 * @property string brand_name
 * @property string locale
 * @property string landing_page
 * @property string shipping_preference
 * @property string user_action
 */
class ApplicationContext extends PayPalModel
{
    /**
     * A label that overrides the business name in the merchant's PayPal account on the PayPal checkout pages.
     * Maximum length: 127.
     *
     * @param string $brand_name
     *
     * @return $this
     */
    public function setBrandName($brand_name)
    {
        $this->brand_name = $brand_name;
        return $this;
    }

    /**
     * A label that overrides the business name in the merchant's PayPal account on the PayPal checkout pages.
     * Maximum length: 127.
     * @return string
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * The locale of pages that the PayPal payment experience displays. A valid value is AU, AT, BE, BR, CA, CH, CN, DE, ES, GB, FR, IT, NL, PL, PT, RU, or US. A five-character code is also valid for languages in these countries: da_DK, he_IL, id_ID, ja_JP, no_NO, pt_BR, ru_RU, sv_SE, th_TH, zh_CN, zh_HK, and zh_TW.
     *
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * The locale of pages that the PayPal payment experience displays. A valid value is AU, AT, BE, BR, CA, CH, CN, DE, ES, GB, FR, IT, NL, PL, PT, RU, or US. A five-character code is also valid for languages in these countries: da_DK, he_IL, id_ID, ja_JP, no_NO, pt_BR, ru_RU, sv_SE, th_TH, zh_CN, zh_HK, and zh_TW.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * The type of landing page to show on the PayPal site for customer checkout. To use the non-PayPal account landing page, set to Billing. To use the PayPal account log in landing page, set to Login.
     *
     * @param string $landing_page
     *
     * @return $this
     */
    public function setLandingPage($landing_page)
    {
        $this->landing_page = $landing_page;
        return $this;
    }

    /**
     *The type of landing page to show on the PayPal site for customer checkout. To use the non-PayPal account landing page, set to Billing. To use the PayPal account log in landing page, set to Login.
     *
     * @return string
     */
    public function getLandingPage()
    {
        return $this->landing_page;
    }

    /**
     * The shipping preference. The possible values are:
     * NO_SHIPPING. Redacts the shipping address from the PayPal pages. Recommended for digital goods.
     * GET_FROM_FILE. Uses the customer-selected shipping address on PayPal pages.
     * SET_PROVIDED_ADDRESS. If available, uses the merchant-provided shipping address, which the customer cannot change on the PayPal pages. If the merchant does not provide an address, the customer can enter the address on PayPal pages.
     * Default: GET_FROM_FILE.
     *
     * @param string $quantity
     *
     * @return $this
     */
    public function setShippingPreference($shipping_preference)
    {
        $this->shipping_preference = $shipping_preference;
        return $this;
    }

    /**
     * The shipping preference. The possible values are:
     * NO_SHIPPING. Redacts the shipping address from the PayPal pages. Recommended for digital goods.
     * GET_FROM_FILE. Uses the customer-selected shipping address on PayPal pages.
     * SET_PROVIDED_ADDRESS. If available, uses the merchant-provided shipping address, which the customer cannot change on the PayPal pages. If the merchant does not provide an address, the customer can enter the address on PayPal pages.
     * Default: GET_FROM_FILE.
     *
     * @return string
     */
    public function getShippingPreference()
    {
        return $this->shipping_preference;
    }

    /**
     *
     * The user action. Presents the customer with either the Continue or Pay Now checkout flow:
     * Pay Now
     * user_action=commit
     * After the customer is redirected to the PayPal payment page, shows the Pay Now button.
     * Use this option when you know the final amount when checkout is initiated and you want to process the payment immediately when the customer clicks Pay Now.
     *
     *
     * Continue
     * user_action=continue
     * After the customer is redirected to the PayPal payment page, shows the Continue button.
     * Use this option when you do not know the final amount when you initiate the checkout flow and you want to redirect the customer to the merchant page without processing the payment.
     *
     * @param string $price
     *
     * @return $this
     */
    public function setUserAction($user_action)
    {
        $this->user_action = $user_action;
        return $this;
    }

    /**
     * The user action. Presents the customer with either the Continue or Pay Now checkout flow:
     * Pay Now
     * user_action=commit
     * After the customer is redirected to the PayPal payment page, shows the Pay Now button.
     * Use this option when you know the final amount when checkout is initiated and you want to process the payment immediately when the customer clicks Pay Now.
     *
     *
     * Continue
     * user_action=continue
     * After the customer is redirected to the PayPal payment page, shows the Continue button.
     * Use this option when you do not know the final amount when you initiate the checkout flow and you want to redirect the customer to the merchant page without processing the payment.
     *
     * @return string
     */
    public function getUserAction()
    {
        return $this->user_action;
    }
}
