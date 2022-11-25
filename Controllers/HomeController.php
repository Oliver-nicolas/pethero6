<?php

namespace Controllers;

use DAO\CuponDAO as CuponDAO;
use DAO\PaymentDAO as PaymentDAO;
use Models\Payment;

class HomeController
{
    private $cuponDAO;
    private $paymentDAO;

    public function __construct()
    {
        $this->cuponDAO = new CuponDAO();
        $this->paymentDAO = new PaymentDAO();
    }

    public function Index($message = "")
    {
        require_once(VIEWS_PATH . "index.php");
    }

    public function PayCoupon($couponNumber, $paid = false)
    {
        $cupon = $this->cuponDAO->SearchByNroCupon($couponNumber);
        require_once(VIEWS_PATH . "coupon/pay-coupon.php");
    }

    public function SendPayment($cuponId)
    {
        try {
            unset($_SESSION['error_pay']);
            unset($_SESSION['success_pay']);

            $coupon = $this->cuponDAO->Search($cuponId);

            if ($this->paymentDAO->SearchByCoupon($cuponId) == null) {                

                $payment = new Payment();
                $payment->setCupon($coupon);
                $payment->setAmount($coupon->getPrice());

                if ($this->paymentDAO->Add($payment)) {
                    $_SESSION['success_pay'] = 'Cupon paid';
                }
            } else {
                $_SESSION['error_pay'] = 'The coupon has already been paid';
            }
        } catch (\Throwable $th) {
            $_SESSION['error_pay'] = 'Exception. ' . $th->getMessage();
        }

        $this->PayCoupon($coupon->getNroCupon(), true);
    }
}
