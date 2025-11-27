<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilsHelper;


class UtilsController extends Controller
{

    public function getPeriods()
    {
    	$list = UtilsHelper::getAllPayPeriods();
    	$data  = [];
    	$data['total'] 	= count($list);
    	$data['LIST'] 	= $list;

    	return response()->json($data);
    }

    public function bankAccountType()
    {
    	$list = UtilsHelper::getAllBankAccountType();
    	$data  = [];
    	$data['total'] 	= count($list);
    	$data['LIST'] 	= $list;

    	return response()->json($data);
    }

    public function businessType()
    {
    	$list = UtilsHelper::getBusinessTypeAll();
    	$data  = [];
    	$data['total'] 	= count($list);
    	$data['LIST'] 	= $list;

    	return response()->json($data);
    }
}