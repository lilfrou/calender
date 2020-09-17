<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct( Request $request, Event $event){

        $this->request = $request;
        $this->event = $event;
    }
        public function index(){
            return $this->event->all();
        }
        public function create(){
            $this->event->create(['title'=>request('title'),
            'description'=>request('description'),
            'location'=>request('location'),
            'attendees'=>request('attendees'),
            'start'=>request('start'),
            'end'=>request('end')]);
            return 200;
        }

}
