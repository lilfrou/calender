<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(Request $request, Event $event, User $user)
    {

        $this->request = $request;
        $this->event = $event;
        $this->user = $user;
    }
    public function index($user_id)
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
    public function create()
    {
        $this->event->create([
            'title' => request('title'),
            'user_id' => request('user_id'),
            'description' => request('description'),
            'location' => request('location'),
            'attendees' => request('attendees'),
            'start' => request('start'),
            'end' => request('end')
        ]);
        return 200;
    }
}
