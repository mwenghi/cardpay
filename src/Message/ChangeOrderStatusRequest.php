<?php

namespace Omnipay\Cardpay\Message;

use Omnipay\Common\Message\AbstractRequest;

class ChangeOrderStatusRequest extends AbstractRequest
{
    /**
     * @var $liveEndpoint
     */
	protected $sandboxEndpoint = 'https://sandbox.cardpay.com/MI/service/order-change-status';
    
    /**
     * @var $sandboxEndpoint
     */
    protected $liveEndpoint = 'https://cardpay.com/MI/service/order-change-status';
    
    public function getUsername()
    {
        return $this->getParameter('client_login');
    }

    public function setUsername($value)
    {
        return $this->setParameter('client_login', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('client_password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('client_password', $value);
    }

    public function getId()
    {
        return $this->getParameter('id');
    }

    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }

    public function getStatusTo()
    {
        return $this->getParameter('status_to');
    }

    public function setStatusTo($value)
    {
        return $this->setParameter('status_to', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getReason()
    {
        return $this->getParameter('reason');
    }

    public function setReason($value)
    {
        return $this->setParameter('reason', $value);
    }

    /**
     * getEndpoint method
     *
     * @return string
     */
    public function getEndpoint()
    {
        return ((bool)$this->getTestMode()) ? $this->sandboxEndpoint : $this->liveEndpoint;
    }
    
    /**
     * getData method
     *
     * @return array
     */
    public function getData()
    {
        $data = [
            'client_login' => $this->getUsername(),
            'client_password' => hash('sha256', $this->getPassword()),
            'id' => $this->getId(),
            'status_to' => $this->getStatusTo(),
            'amount' => $this->getAmount(),
            'reason' => $this->getReason()
        ];

        return $data;
    }
    
    /**
     * @param string $path
     * @param array  $query
     *
     * @return string
     */
    protected function createUri($query = [])
    {
        $url = $this->getEndpoint();
        
        if ($query) {
            $url .= '?' . http_build_query($query);
        }
        
        return $url;
    }

    /**
     * sendData method
     *
     * @params array with hdata to send
     * @return \Omnipay\Message\ChangeOrderStatusResponse 
     */
    public function sendData($data)
    {
        $uri = $this->createUri($data);
        $headers = [];

        try {
            $response = $this->httpClient->get($uri, $headers)->send();
        } catch (Exception $e) {
            $response = $e->getResponse();
        }
        
        return new ChangeOrderStatusResponse($this, $response->xml());
    }
}
