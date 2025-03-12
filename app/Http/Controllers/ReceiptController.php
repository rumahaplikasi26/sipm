<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index($uuid)
    {
        return view('receipt.index', compact('uuid'));
    }
}
