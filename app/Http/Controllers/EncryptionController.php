<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptionController extends Controller
{
    public function encrypt(Request $request)
    {
        $data = Crypt::encryptString($request->input('data'));
        return response()->json(['data' => $data]);
    }

    public function decrypt(Request $request)
    {
        $data = Crypt::decryptString($request->input('data'));
        return response()->json(['data' => $data]);
    }
}
