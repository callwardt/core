<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * LiteCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@litecommerce.com so we can send you a copy immediately.
 *
 * @category   LiteCommerce
 * @package    XLite
 * @subpackage Model
 * @author     Creative Development LLC <info@cdev.ru>
 * @copyright  Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.litecommerce.com/
 * @see        ____file_see____
 * @since      1.0.0
 */

namespace XLite\Module\CDev\Moneybookers\Model\Payment\Processor;

/**
 * Moneybookers payment processor
 *
 * @package XLite
 * @see     ____class_see____
 * @since   1.0.0
 */
class Moneybookers extends \XLite\Model\Payment\Base\Iframe
{
    /**
     * Allowed languages 
     * 
     * @var   array
     * @see   ____var_see____
     * @since 1.0.0
     */
    protected $allowedLanguages = array(
        'EN', 'DE', 'ES', 'FR', 'IT', 'PL', 'GR', 'RO', 'RU', 'TR',
        'CN', 'CZ', 'NL', 'DA', 'SV', 'FI',
    );

    /**
     * Allowed currencies codes
     * 
     * @var   array
     * @see   ____var_see____
     * @since 1.0.0
     */
    protected $allowedCurrencies = array(
        'EUR', 'TWD', 'USD', 'THB', 'GBP', 'CZK', 'HKD', 'HUF', 'SGD', 'SKK',
        'JPY', 'EEK', 'CAD', 'BGN', 'AUD', 'PLN', 'CHF', 'ISK', 'DKK', 'INR',
        'SEK', 'LVL', 'NOK', 'KRW', 'ILS', 'ZAR', 'MYR', 'RON', 'NZD', 'HRK',
        'TRY', 'LTL', 'AED', 'JOD', 'MAD', 'OMR', 'QAR', 'RSD', 'SAR', 'TND',
    );

    /**
     * Statuses 
     * 
     * @var   array
     * @see   ____var_see____
     * @since 1.0.0
     */
    protected $statuses = array(
        '-2' => 'Failed',
        '2'  => 'Processed',
        '0'  => 'Pending',
        '-1' => 'Cancelled',
    );

    /**
     * Failed reason codes and messages
     * 
     * @var   array
     * @see   ____var_see____
     * @since 1.0.0
     */
    protected $failedReasons = array(
        '01' => 'Referred',
        '02' => 'Invalid Merchant Number',
        '03' => 'Pick-up card',
        '04' => 'Authorisation Declined',
        '05' => 'Other Error',
        '06' => 'CVV is mandatory, but not set or invalid',
        '07' => 'Approved authorisation, honour with identification',
        '08' => 'Delayed Processing',
        '09' => 'Invalid Transaction',
        '10' => 'Invalid Currency',
        '11' => 'Invalid Amount/Available Limit Exceeded/Amount too high',
        '12' => 'Invalid credit card or bank account',
        '13' => 'Invalid Card Issuer',
        '14' => 'Annulation by client',
        '15' => 'Duplicate transaction',
        '16' => 'Acquirer Error',
        '17' => 'Reversal not processed, matching authorisation not found',
        '18' => 'File Transfer not available/unsuccessful',
        '19' => 'Reference number error',
        '20' => 'Access Denied',
        '21' => 'File Transfer failed',
        '22' => 'Format Error',
        '23' => 'Unknown Acquirer',
        '24' => 'Card expired',
        '25' => 'Fraud Suspicion',
        '26' => 'Security code expired',
        '27' => 'Requested function not available',
        '28' => 'Lost/Stolen card',
        '29' => 'Stolen card, Pick up',
        '30' => 'Duplicate Authorisation',
        '31' => 'Limit Exceeded',
        '32' => 'Invalid Security Code',
        '33' => 'Unknown or Invalid Card/Bank account',
        '34' => 'Illegal Transaction',
        '35' => 'Transaction Not Permitted',
        '36' => 'Card blocked in local blacklist',
        '37' => 'Restricted card/bank account',
        '38' => 'Security Rules Violation',
        '39' => 'The transaction amount of the referencing transaction is higher than the transaction amount of the original transaction',
        '40' => 'Transaction frequency limit exceeded, override is possible',
        '41' => 'Incorrect usage count in the Authorisation System exceeded',
        '42' => 'Card blocked',
        '43' => 'Rejected by Credit Card Issuer',
        '44' => 'Card Issuing Bank or Network is not available',
        '45' => 'The card type is not processed by the authorisation centre / Authorisation System has determined incorrect Routing',
        '47' => 'Processing temporarily not possible',
        '48' => 'Security Breach',
        '49' => 'Date / time not plausible, trace-no. not increasing',
        '50' => 'Error in PAC encryption detected',
        '51' => 'System Error',
        '52' => 'MB Denied - potential fraud',
        '53' => 'Mobile verification failed',
        '54' => 'Failed due to internal security restrictions',
        '55' => 'Communication or verification problem',
        '56' => '3D verification failed',
        '57' => 'AVS check failed',
        '58' => 'Invalid bank code',
        '59' => 'Invalid account code',
        '60' => 'Card not authorised',
        '61' => 'No credit worthiness',
        '62' => 'Communication error',
        '63' => 'Transaction not allowed for cardholder',
        '64' => 'Invalid Data in Request',
        '65' => 'Blocked bank code',
        '66' => 'CVV2/CVC2 Failure',
        '99' => 'General error',
    );

    /**
     * Payment types 
     * 
     * @var   array
     * @see   ____var_see____
     * @since 1.0.0
     */
    protected $paymentTypes = array(
        'MBD' => 'Moneybooker direct',
        'WLT' => 'E-wallet',
        'PBT' => 'Pending bank transfer',
    );

    /**
     * Get settings widget or template
     *
     * @return string Widget class name or template path
     * @access public
     * @see    ____func_see____
     * @since  1.0.0
     */
    public function getSettingsWidget()
    {
        return 'modules/CDev/Moneybookers/config.tpl';
    }

    /**
     * Get iframe data
     *
     * @return string|array URL or POST data
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getIframeData()
    {
        $id = $this->getSessionId();

        return $id ? $this->getPostURL() . '?sid=' . $id : null;
    }

    /**
     * Get Moneybookers session id 
     * 
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getSessionId()
    {
        $data = array(
            'pay_to_email'          => $this->getSetting('email'),
            'language'              => $this->getLanguageCode(),
            'recipient_description' => substr(\XLite\Core\Config::getInstance()->Company->company_name, 0, 30),
            'transaction_id'        => $this->getSetting('prefix') . $this->transaction->getTransactionId(),
            'pay_from_email'        => $this->getProfile()->getLogin(),
            'firstname'             => $this->getProfile()->getBillingAddress()->getFirstname(),
            'lastname'              => $this->getProfile()->getBillingAddress()->getLastname(),
            'address'               => $this->getProfile()->getBillingAddress()->getStreet(),
            'postal_code'           => $this->getProfile()->getBillingAddress()->getZipcode(),
            'city'                  => $this->getProfile()->getBillingAddress()->getCity(),
            'country'               => $this->getCountryCode(),
            'amount'                => $this->getOrder()->getCurrency()->roundValue($this->transaction->getValue()),
            'currency'              => $this->getCurrencyCode(),
            'status_url'            => $this->getCallbackURL(null, true),
            'return_url'            => $this->getReturnURL(null, true),
            'cancel_url'            => $this->getReturnURL(null, true, true),
            'hide_login'            => 1,
            'prepare_only'          => 1,
        );

        if ($this->getSetting('logo_url')) {
            $data['logo_url'] = $this->getSetting('logo_url');
        }

        $this->transaction->setPublicId($data['transaction_id']);

        $request = new \XLite\Core\HTTP\Request($this->getPostURL());
        $request->body = $data;
        $response = $request->sendRequest();

        $id = null;
        if (
            200 == $response->code
            && preg_match('/SESSION_ID=([a-z0-9]+)/iSs', $response->headers->SetCookie, $match)
            && $response->body == $match[1]
        ) {
            $id = $match[1];

        } elseif (200 != $response->code) {
            $this->setDetail(
                'moneybookers_session_error',
                'Moneybookers payment processor did not recieve session ID successfull (HTTP error: ' . $response->code . ').',
                'Session initialization error'
            );

        } elseif (preg_match('/SESSION_ID=([a-z0-9]+)/iSs', $response->headers->SetCookie, $match)) {

            $this->setDetail(
                'moneybookers_session_error',
                'Moneybookers payment processor did not recieve session ID successfull (page body has not session ID).',
                'Session initialization error'
            );

        } else {
            $this->setDetail(
                'moneybookers_session_error',
                'Moneybookers payment processor did not recieve session ID successfull.',
                'Session initialization error'
            );
        }

        if (
            !$id
            && preg_match('/<h1[^>]*>(.+)<\/h1>/USs', $response->body, $m1)
            && preg_match('/<div class="gateway_content">(.+)<\/div>/USs', $response->body, $m2)
        ) {
            $m1 = trim($m1[1]);
            $m2 = trim(strip_tags($m2[1]));

            $this->setDetail(
                'moneybookers_session_error',
                $m1 . ': ' . $m2,
                'Session initialization error'
            );
        }

        return $id;
    }

    /**
     * Process return
     *
     * @param \XLite\Model\Payment\Transaction $transaction Return-owner transaction
     *
     * @return void
     * @access public
     * @see    ____func_see____
     * @since  1.0.0
     */
    public function processReturn(\XLite\Model\Payment\Transaction $transaction)
    {
        parent::processReturn($transaction);

        if (\XLite\Core\Request::getInstance()->cancel) {
            $this->setDetail(
                'status',
                'Payment transaction is cancelled',
                'Status'
            );
            $this->transaction->setNote('Payment transaction is cancelled');
            $this->transaction->setStatus($transaction::STATUS_FAILED);

        } elseif ($transaction::STATUS_INPROGRESS == $this->transaction->getStatus()) {
            $this->transaction->setStatus($transaction::STATUS_PENDING);        
        }
    }

    /**
     * Process callback
     *
     * @param \XLite\Model\Payment\Transaction $transaction Callback-owner transaction
     *
     * @return void
     * @see    ____func_see____
     * @since  1.0.0
     */
    public function processCallback(\XLite\Model\Payment\Transaction $transaction)
    {
        parent::processCallback($transaction);

        $request = \XLite\Core\Request::getInstance();

        if (!$request->isPost()) {
            $this->markCallbackRequestAsInvalid(static::t('Request type must be POST'));

        } elseif (!isset($request->status)) {
            $this->markCallbackRequestAsInvalid(static::t('\'status\' request argument can not found'));

        } else {
            $this->setDetail(
                'status',
                isset($this->statuses[$request->status]) ? $this->statuses[$request->status] : 'Failed',
                'Status'
            );

            $this->saveDataFromRequest();

            switch ($request->status) {
                case 0:
                    $status = $transaction::STATUS_PENDING;
                    break;

                case 2:
                    $status = $transaction::STATUS_SUCCESS;
                    break;

                default:
                    $status = $transaction::STATUS_FAILED;
            }

            // Amount checking
            if (isset($request->amount) && !$this->checkTotal($request->amount)) {
                $status = $transaction::STATUS_FAILED;
            }

            // Currency checking
            if (isset($request->currency) && !$this->checkCurrency($request->currency)) {
                $status = $transaction::STATUS_FAILED;
            }

            // Check MD5 hash
            if (
                $status == $transaction::STATUS_SUCCESS
                && $request->md5sig
                && $this->getSetting('secret_word')
            ) {
                $base = $request->merchant_id
                    . $request->transaction_id
                    . strtoupper(md5($this->getSetting('secret_word')))
                    . $request->mb_amount
                    . $request->mb_currency
                    . $request->status;

                if (strtoupper(md5($base)) != strtoupper($request->md5sig)) {
                    $this->setDetail(
                        'signature_error',
                        'Payment transaction\'s secure signature is corrupted' . PHP_EOL
                        . 'Signature from request: ' . strtoupper($request->md5sig) . PHP_EOL
                        . 'Calculated signature: ' . strtoupper(md5($base)),
                        'Hacking attempt'
                    );
                    $status = $transaction::STATUS_FAILED;
                }
            }

            if ($request->payment_type && isset($this->paymentTypes[$request->payment_type])) {
                $this->setDetail(
                    'payment_type',
                    $this->paymentTypes[$request->payment_type] . ' (' . $request->payment_type . ')',
                    'Payment type'
                );
            }

            if ($request->failed_reason_code && isset($this->failedReasons[$request->failed_reason_code])) {
                $this->setDetail(
                    'failed_reason',
                    $this->failedReasons[$request->failed_reason_code],
                    'Failed reason'
                );
            }

            $this->transaction->setStatus($status); 
        }
    }

    /**
     * Check - payment method is configured or not
     *
     * @param \XLite\Model\Payment\Method $method Payment method
     *
     * @return boolean
     * @access public
     * @see    ____func_see____
     * @since  1.0.0
     */
    public function isConfigured(\XLite\Model\Payment\Method $method)
    {
        return parent::isConfigured($method)
            && $method->getSetting('email');
    }

    /**
     * Check - payment processor is applicable for specified order or not
     *
     * @param \XLite\Model\Order $order Order
     *
     * @return boolean
     * @see    ____func_see____
     * @since  1.0.0
     */
    public function isApplicable(\XLite\Model\Order $order)
    {
        return parent::isApplicable($order)
            && in_array(strtoupper($order->getCurrency()->getCode()), $this->allowedCurrencies);
    }

    /**
     * Get language code 
     * 
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getLanguageCode()
    {
        $code = strtoupper(\XLite\Core\Session::getInstance()->getLanguage()->getCode());
        
        return in_array($code, $this->allowedLanguages) ? $code : 'EN';
    }

    /**
     * Get country code 
     * 
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getCountryCode()
    {
        return strtoupper($this->getProfile()->getBillingAddress()->getCountry()->getCode3());

    }

    /**
     * Get currency code 
     * 
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getCurrencyCode()
    {
        return strtoupper($this->getOrder()->getCurrency()->getCode());
    }

    /**
     * Get post URL 
     * 
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getPostURL()
    {
        return '1' == $this->getSetting('test')
            ? 'http://www.moneybookers.com/app/test_payment.pl'
            : 'https://www.moneybookers.com/app/payment.pl';
    }

    /**
     * Define saved into transaction data schema
     *
     * @return array
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function defineSavedData()
    {
        $data = parent::defineSavedData();

        $data['mb_transaction_id']  = 'Moneybookers\' transaction ID';
        $data['failed_reason_code'] = 'Failed reason code';

        return $data;
    }
}
