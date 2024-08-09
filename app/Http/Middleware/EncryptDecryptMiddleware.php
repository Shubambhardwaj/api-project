<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class EncryptDecryptMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Encrypt request data
        $request->merge([
            'data' => Crypt::encryptString($request->input('data'))
        ]);

        $response = $next($request);

        // Decrypt response data
        if ($response->getContent()) {
            $content = json_decode($response->getContent(), true);
            if (isset($content['data'])) {
                $content['data'] = Crypt::decryptString($content['data']);
                $response->setContent(json_encode($content));
            }
        }

        return $response;
    }
}
