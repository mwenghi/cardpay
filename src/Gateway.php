<?php

namespace Omnipay\Cardpay;

use Omnipay\Common\AbstractGateway;

/**
 * Cardpay Gateway class
 *
 */
class Gateway extends AbstractGateway
{
    /**
     * getName method
     *
     * @return string
     */
    public function getName()
    {
        return 'Cardpay';
    }
    
    /**
     * getUsername method
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }
    
    /**
     * setUsername method
     *
     * @param string $value to set as username
     * @return string
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }
    
    /**
     * getPassword method
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * getSignature method
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->getParameter('signature');
    }
    
    /**
     * setSignature method
     *
     * @param string $value to set as signature
     * @return string
     */
    public function setSignature($value)
    {
        return $this->setParameter('signature', $value);
    }
    
    /**
     * setPassword method
     *
     * @param string $value to set as user's password
     * @return string
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }
    
    /**
     * purchase method
     *
     * @param array $parameters to create purchase request
     * @return \Omnipay\Cardpay\Message\PaymentRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cardpay\Message\PaymentRequest', $parameters);
    }
     
    /**
     * authorize method
     *
     * @param array $parameters to create authorize request
     * @return \Omnipay\Cardpay\Message\PaymentRequest
     */
    public function authorize(array $parameters = [])
    {
        $parameters['is_two_phase'] = true;

        return $this->createRequest('\Omnipay\Cardpay\Message\PaymentRequest', $parameters);
    }
   
    /**
     * capture method 
     *
     * @param array $parameters to create capture request
     * @return \Omnipay\Cardpay\Message\ChangeOrderStatusRequest
     */
    public function capture(array $parameters = []) 
    {
        return $this->createRequest('\Omnipay\Cardpay\Message\ChangeOrderStatusRequest', $parameters);
    }

    /**
     * completeAuthorize method
     *
     * @param array $parameters to create completeAuthorize request
     * @return \Omnipay\Cardpay\Message\CompletePaymentRequest
     */
    public function completeAuthorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Cardpay\Message\CompletePaymentRequest', $parameters);
    }
}
