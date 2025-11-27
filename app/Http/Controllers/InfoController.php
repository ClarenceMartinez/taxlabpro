<?php

namespace App\Http\Controllers;

use App\Models\AssetTransfer;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        phpinfo();
    }
}