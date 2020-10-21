<?php

namespace App\Http\Controllers;

use GuzzleHttp\TransferStats;

use App\Models\Event;
use App\Models\Token;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Carbon\Carbon;
class EventController extends Controller
{
    public function __construct(Request $request, Event $event, User $user, Token $token)
    {

        $this->request = $request;
        $this->event = $event;
        $this->user = $user;
        $this->token = $token;
    }
    public function index($user_id)
    {
        if ($user_id == 0) {
            $events = $this->event->all();
        } else {
            $events = $this->event->where('user_id', $user_id)->get();
        }
        return $events;
    }
    public function login($user_id)
    {
        if ($this->user->Auth($user_id) == '["admin"]') {
            $events = $this->event->all();
        } else {
            $events = $this->event->where('user_id', $user_id)->get();
        }
        return $events;
    }
    public function getUsers()
    {
        return $this->user->all();
    }
    public function getEvent($event_id)
    {

        $event = $this->event->where('id', $event_id)->first();
        return $event;
    }
    public function update()
    {
        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);
            $arr_token = json_decode($this->token->where('user_id', request('user_id'))->value('token'));

            $accessToken = $arr_token->access_token;
            $meeting_id=$this->event->where('id', request('id'))->value('meeting_id');
            $response = $client->request('PATCH', '/v2/meetings/'.$meeting_id, [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
                'json' => [
                    "topic" => request('title'),
                    "type" => 2,
                    "start_time" => Carbon::parse(request('start')),
                    "duration" => Carbon::parse(request('start'))->diffInMinutes(Carbon::parse(request('end'))),
                    "password" => request('password')
                ],
            ]);
        } catch (Exception $e) {
            if (401 == $e->getCode()) {
                $arr_refresh_token = json_decode($this->token->where('user_id', request('user_id'))->value('token'));
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
                $this->tokenUpdateCreate($token,request('user_id'));

                $this->update();
            } else {
                echo $e->getMessage();
            }
        }

        $this->event->where('id', request('id'))->update([
            'title' => request('title'),
            'user_id' => request('user_id'),
            'description' => request('description'),
            'start' => request('start'),
            'end' => request('end'),
            'password'=> request('password')
        ]);

        return 200;
    }
    public function destroy()
    {
        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);
            $arr_token = json_decode($this->token->where('user_id', request('user_id'))->value('token'));

            $accessToken = $arr_token->access_token;
            $meeting_id=$this->event->where('id', request('event_id'))->value('meeting_id');
            $response = $client->request('DELETE', '/v2/meetings/'.$meeting_id, [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
            ]);
        } catch (Exception $e) {
            if (401 == $e->getCode()) {
                $arr_refresh_token = json_decode($this->token->where('user_id', request('user_id'))->value('token'));
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
                $this->tokenUpdateCreate($token,request('user_id'));

                $this->destroy();
            } else {
                echo $e->getMessage();
            }
        }


        $event = $this->event->where('id', request('event_id'))->delete();
        return 200;
    }
    function create_meeting()
    {
        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);

            $arr_token = json_decode($this->token->where('user_id', request('user_id'))->value('token'));

            $accessToken = $arr_token->access_token;


            $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
                'json' => [
                    "topic" => request('title'),
                    "type" => 2,
                    "start_time" => Carbon::parse(request('start')),
                    "duration" => Carbon::parse(request('start'))->diffInMinutes(Carbon::parse(request('end'))),
                    "password" => request('password')
                ],
            ]);

            $data = json_decode($response->getBody());
            $this->event->create([
                'title' => request('title'),
                'meeting_id'=>$data->id,
                'user_id' => request('user_id'),
                'description' => request('description'),
                'start' => request('start'),
                'end' => request('end'),
                "password" => request('password'),
                "join_url" => $data->join_url
            ]);
            return 200;
            //  return ['join_url'=> $data->join_url,'password'=>request('password'),'meeting_id'=>$data->id];

        } catch (Exception $e) {
            if (401 == $e->getCode()) {
                $arr_refresh_token = json_decode($this->token->where('user_id', request('user_id'))->value('token'));
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
                $this->tokenUpdateCreate($token,request('user_id'));

                $this->create_meeting();
            } else {
                echo $e->getMessage();
            }
        }
    }

    public function getCode()
    {
        return redirect()->away('https://zoom.us/oauth/authorize?response_type=code&client_id=' . env('CLIENT_ID') . '&redirect_uri=' . env('REDIRECT_URI'));
    }
    public function getToken()
    {
        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode(env('CLIENT_ID') . ':' . env('CLIENT_SECRET'))
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $_GET['code'],
                    "redirect_uri" => env('REDIRECT_URI')
                ],
            ]);

            $token = json_decode($response->getBody()->getContents(), true);
            $this->tokenUpdateCreate($token,Auth::user()->id);

            return redirect()->route('dashboard');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function tokenUpdateCreate($token,$user_id)
    {
        $user_token =  $this->token->where('user_id', $user_id)->first();

        if ($user_token !== null) {
            $user_token->update(['user_id' => $user_id, 'token' => json_encode($token)]);
        } else {
            $this->token->create(['user_id' =>$user_id, 'token' => json_encode($token)]);
        }
    }
}
