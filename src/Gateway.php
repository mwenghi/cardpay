<?php

namespace Omnipay\Cardpay;

use Omnipay\Common\AbstractGateway;

/**
 * Cardpay Gateway
 *
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Cardpay';
    }
    
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }
    
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }
    

    /**
     * @param array $parameters
     * @return \Omnipay\Cardpay\Message\PaymentRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cardpay\Message\PaymentRequest', $parameters);
    }

}
