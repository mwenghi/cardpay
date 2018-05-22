<?php
namespace Omnipay\Cardpay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Cake\Utility\Xml;

class CompletePaymentRequest extends AbstractRequest
{
    
    /**
     * Get the data for this request.
     *
     * @return array request data
     */
    public function getData()
    {
        return $this->parameters->all();
    }
    
    /**
     * @param  array $data payment data to send
     *
     * @return PaymentResponse         payment response
     */
    public function sendData($data)
    {
        return $this->response = new StatusCallback($data);
    }
}
