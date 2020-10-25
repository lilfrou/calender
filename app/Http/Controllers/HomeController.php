<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Token;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Event $event, User $user, Token $token)
    {

        $this->request = $request;
        $this->event = $event;
        $this->user = $user;
        $this->token = $token;
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->auth === 'operator' && Auth::user()->zoom_user_status !== 'active' && Auth::user()->zoom_user_id !==null) {
            $this->checkEmailValidation();
        }
        if (Token::where('user_id', Auth::user()->id)->first()) {
            return Auth::user()->auth !== 'guest'
                ? view('dashboard')
                : view('guest');
        } else {
            if (Auth::user()->auth === 'operator' && Auth::user()->zoom_user_status !== 'active' && Auth::user()->zoom_user_id !==null) {

                return view('zoom-email-validation');
            } else {
                if (Auth::user()->auth === 'operator' && Auth::user()->zoom_user_status === 'active' && Auth::user()->zoom_user_id !==null) {
                    return redirect()->route('api.getCode');
                };
                return Auth::user()->auth !== 'guest'
                    ? view('zoom')
                    : view('guest');
            }
        }
    }
    public function checkEmailValidation()
    {

        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);
            $user_id = User::where('auth', 'admin')->value('id');
            $arr_token = json_decode($this->token->where('user_id', $user_id)->value('token'));
            $accessToken = $arr_token->access_token;

            $response = $client->request('GET', '/v2/users/' . Auth::user()->zoom_user_id, [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
                'json' => [
                    'login_type' => 100

                ],
            ]);

            $data = json_decode($response->getBody());
            $this->user->where('id', Auth::user()->id)->update(['zoom_user_status' => $data->status]);
        } catch (Exception $e) {
            if (401 == $e->getCode()) {
                $user_id = User::where('auth', 'admin')->value('id');
                $arr_refresh_token = json_decode($this->token->where('user_id', $user_id)->value('token'));
                $refresh_token = $arr_refresh_token->refresh_token;

                $client = new Client(['base_uri' => 'https://zoom.us']);

                $response = $client->request('POST', '/oauth/token', [
                    "headers" => [
                        "Authorization" => "Basic " . base64_encode(env('CLIENT_ID') . ':' . env('CLIENT_SECRET'))
                    ],
                    'form_params' => [
                        "grant_type" => "refresh_token",
                        "refresh_token" => $refresh_token
                    ],
                ]);
                $token = json_decode($response->getBody()->getContents(), true);
                $this->tokenUpdateCreate($token, $user_id);

                $this->checkEmailValidation();
            } else {
                echo $e->getMessage();
            }
        }
    }
}
