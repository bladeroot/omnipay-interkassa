<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Message;

/**
 * InterKassa Complete Purchase Request
 * Implements request for APIv1.
 */
class OldCompletePurchaseRequest extends CompletePurchaseRequest
{
    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @return OldCompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new OldCompletePurchaseResponse($this, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function calculateSign($data, $signKey)
    {
        unset($data['ik_sign_hash']);
        ksort($data, SORT_STRING);
        array_push($data, $signKey);
        $signAlgorithm = $this->getSignAlgorithm();
        $signString = implode(':', $data);
        return base64_encode(hash($signAlgorithm, $signString, true));
    }
}
