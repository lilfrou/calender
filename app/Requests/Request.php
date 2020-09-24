<?php

namespace App\Requests;


class Request
{

    public function setUser(){
        return request()->validate([
            'auth' => 'required',
        ]);
    }


}
