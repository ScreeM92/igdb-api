<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Config;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Client;
use Validator;
use App\Exceptions\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $username = 'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @overwrite AuthenticatesUsers@login
     * @param Request $request
     * @return \Psr\Http\Message\StreamInterface
     */
    public function login(Request $request)
    {
        /** AuthenticatesUsers */
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();

            $clientData = $user->getClientData();
            $postData = $request->all();

            $client = new Client();
            $url = Config::get('globals.TOKEN_URL');

            $response = $client->post($url, [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $clientData->id,
                    'client_secret' => $clientData->secret,
                    'redirect_uri' => $clientData->redirect,
                    'username'=> $user->username,
                    'password'=> $postData["password"],
                    'scope' => '*',
                ],
            ]);

            $tokenData = json_decode((string) $response->getBody(), true);
            $tokenData['is_admin'] = $user->hasRole('admin');
            $tokenData['name'] = $user->name;

            return $tokenData;
        } else {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }

    public function username()
    {
        return $this->username;
    }
}