<?php
    namespace DAO;

    use Models\Payment as Payment;

    interface IPaymentDAO
    {
        function Add(Payment $payment);
    }
