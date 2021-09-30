<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        //Check if fields are not empty

        if(empty($email) or empty($password))
        {
            return response()->json(['status' => 'error', 'message' => 'Email and password are required']);
        }

        $client = new Client();

        try {
            return  $client->post("http://lumen.local/v1/oauth/token", [
                "form_params" => [
                    "client_secret" => "",
                    "grant_type" => "password",
                    "client_id" => 4,
                    "username" => $request->email,
                    "password" => $request->password
                ]
            ]);
        } catch (BadResponseException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
