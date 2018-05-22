<?php
namespace Omnipay\Cardpay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Cake\Utility\Xml;

class PaymentRequest extends AbstractRequest
{
	public $liveEndpoint = 'https://cardpay.com/MI/cardpayment.html';
    protected $sandboxEndpoint = 'https://sandbox.cardpay.com/MI/cardpayment.html';

    public function getEndpoint()
    {
        return ((bool)$this->getTestMode()) ? $this->sandboxEndpoint : $this->liveEndpoint;
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

    public function getNumber()
    {
        return $this->getParameter('number');
    }

    public function setNumber($value)
    {
        return $this->setParameter('number', $value);
    }

    public function getDescription()
    {
        return $this->getParameter('description');
    }

    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getNote()
    {
        return $this->getParameter('note');
    }

    public function setNote($value)
    {
        return $this->setParameter('note', $value);
    }

    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    public function setLocale($value)
    {
        $supported = array('en', 'ru', 'zh', 'ja');
        if(!in_array($value, $supported)){
            $value = 'en';
        }
        return $this->setParameter('locale', $value);
    }
	
    public function getSuccessUrl()
    {
        return $this->getParameter('success_url');
    }
    
    public function setSuccessUrl($value)
    {
        return $this->setParameter('success_url', $value);
    }
    
    public function getDeclineUrl()
    {
        return $this->getParameter('decline_url');
    }
    
    public function setDeclineUrl($value)
    {
        return $this->setParameter('decline_url', $value);
    }
    
    public function getCancelUrl()
    {
        return $this->getParameter('cancel_url');
    }
    
    public function setCancelUrl($value)
    {
        return $this->setParameter('cancel_url', $value);
    }

    public function getIsTwoPhase()
    {
        return $this->getParameter('is_two_phase');
    }

    public function setIsTwoPhase($value)
    {
        return $this->setParameter('is_two_phase', $value);
    }
    
    public function getData()
    {
        $this->validate('number', 'currency', 'amount');

        $input = [
            'order' => [
                'wallet_id' => $this->getUsername(),
                'number' => $this->getNumber(),
                'description' => $this->getDescription(),
                'currency' => $this->getCurrency(),
                'amount' => $this->getAmount(),
                'email' => $this->getEmail(),
                'locale' => $this->getLocale(),
                'note' => $this->getNote(),
                'is_two_phase' => $this->getIsTwoPhase(),
                'success_url' => $this->getSuccessUrl(),
                'decline_url' => $this->getDeclineUrl(),
                'cancel_url' => $this->getCancelUrl(),
            ]
        ];

        $xmlObject = Xml::build($input, [
            'format' => 'attributes'
        ]);
        $xmlString = $xmlObject->asXML();
        
        $sha = hash('sha512', $xmlString.$this->getPassword());
        
        $data = [
            'orderXML' => base64_encode($xmlString),
            'sha512' => $sha
        ];

        return $data;
    }
    
    public function sendData($data)
    {
        return new PaymentResponse($this, $data, $this->getEndpoint());
    }
}
