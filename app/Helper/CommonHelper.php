<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

class CommonHelper
{
    public function getCurrentUser($request)
    {
        $response = explode(' ', $request->header('Authorization'));
        $token = PersonalAccessToken::findToken(trim($response[1]));
        return $token->tokenable;
    }

    public static function uploadDocuments($request, $file, $location)
    {
        if ($request->hasFile($file)) {
            $image = $request->file($file);
            $document = intval(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path($location);
            $image->move($destinationPath, $document);
            $dbFileNAme = $location . '/' . $document;
            return $dbFileNAme;
        } else {
            return $dbFileNAme = 'dummy.png';
        }
    }
}
