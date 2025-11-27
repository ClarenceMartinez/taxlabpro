<?php  
namespace App\Helpers;
use App\Models\PayPeriod;
use App\Models\BankAccountType;
use App\Models\BusinessType;

class UtilsHelper
{
    // Obtener todos los períodos de pago
    public static function getAllPayPeriods()
    {
        return PayPeriod::all();
    }

    public static function getAllBankAccountType()
    {
        return BankAccountType::all();
    }

    public static function getBusinessTypeAll()
    {
        return BusinessType::all();
    }


}


?>