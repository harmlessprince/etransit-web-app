<?php


namespace App\Classes;
use App\Models\Invoice as RecordInvoice;


class Invoice
{
    public static function record($userId , $transactionId , $tripType = null , $returnDate = null)
    {
        $invoice = new RecordInvoice();
        $invoice->user_id = $userId;
        $invoice->transaction_id = $transactionId;
        $invoice->trip_type = $tripType;
        $invoice->return_date = $returnDate;
        $invoice->saveQuietly();

        return $invoice;
    }
}
