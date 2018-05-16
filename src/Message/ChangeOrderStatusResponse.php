<?php

namespace Omnipay\Cardpay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Cake\Utility\Xml;

class ChangeOrderStatusResponse extends AbstractResponse
{
    public function __construct($changeOrderStatusRequest, $data)
    {
        error_log(__METHOD__ . ": got data: " . print_r($data, true) . "\n", 3, '/tmp/payment.log');

        
        $this->raw = $data;
        $xml = Xml::build($data);
        error_log(__METHOD__ . ': attributes: ' . print_r(current($xml->attributes()), true) . "\n", 3, '/tmp/payment.log');
        $this->data = current($xml->attributes());

        parent::__construct($changeOrderStatusRequest, $data);
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getStatus() == 'accepted';
    }

     /**
     * @return null|string
     */
    public function getStatus()
    {
        if (!isset($this->data['transaction']) || !isset($this->data['transaction']['status'])) {
            return null;
        }
        
        return $this->data['transaction']['status'];
    }
}
