<?php

namespace Omnipay\Cardpay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Cake\Utility\Xml;

class ChangeOrderStatusResponse extends AbstractResponse
{
    const IS_EXECUTED_YES = 'yes';
    const IS_EXECUTED_NO = 'no';
    const STATUS_SUCCESSFUL = 'successful';
    const STATUS_FAILED = 'failed';

    public function __construct($changeOrderStatusRequest, $data)
    {
        $this->order = current($data->attributes());
        $this->order = array_merge($this->order, current($data->order->attributes()));
        
        parent::__construct($changeOrderStatusRequest, $data);
    }

    /**
     * isSuccessful method
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getStatus() == self::STATUS_SUCCESSFUL;
    }

     /**
      * getStatus method
      *
      * @return string
      */
    public function getStatus()
    {
        if (isset($this->order['is_executed']) && $this->order['is_executed'] == self::IS_EXECUTED_YES) {
            return self::STATUS_SUCCESSFUL;
        }
        
        return self::STATUS_FAILED;
    }
    
    /**
     * getMessage method
     *
     * @return string | null
     */
    public function getMessage()
    {
        return !empty($this->order['details']) ? $this->order['details'] : '';
    }

    /**
     * getTransactionReference method
     *
     * @return string | null
     */
    public function getTransactionReference()
    {
        return $this->order['id'];
    }

    /**
     * getTransactionId method
     *
     * @return string | null
     */
    public function getTransactionId()
    {
        return $this->order['id'];
    }
}
