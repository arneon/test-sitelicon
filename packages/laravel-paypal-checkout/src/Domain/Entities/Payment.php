<?php

namespace Arneon\LaravelPaypalCheckout\Domain\Entities;

class Payment
{
    private $id;
    private $order_id;
    private $payment_id;
    private $payer_id;
    private $payer_email;
    private $amount;
    private $currency;
    private $payment_status;

    /**
     * @param $id
     * @param $order_id
     * @param $payment_id
     * @param $payer_id
     * @param $payer_email
     * @param $amount
     * @param $currency
     * @param $payment_status
     */
    public function __construct($id, $order_id, $payment_id, $payer_id, $payer_email, $amount, $currency, $payment_status)
    {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->payment_id = $payment_id;
        $this->payer_id = $payer_id;
        $this->payer_email = $payer_email;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->payment_status = $payment_status;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Payment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     * @return Payment
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @param mixed $payment_id
     * @return Payment
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayerId()
    {
        return $this->payer_id;
    }

    /**
     * @param mixed $payer_id
     * @return Payment
     */
    public function setPayerId($payer_id)
    {
        $this->payer_id = $payer_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayerEmail()
    {
        return $this->payer_email;
    }

    /**
     * @param mixed $payer_email
     * @return Payment
     */
    public function setPayerEmail($payer_email)
    {
        $this->payer_email = $payer_email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return Payment
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->payment_status;
    }

    /**
     * @param mixed $payment_status
     * @return Payment
     */
    public function setPaymentStatus($payment_status)
    {
        $this->payment_status = $payment_status;
        return $this;
    }




}
