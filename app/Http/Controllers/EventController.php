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

}
