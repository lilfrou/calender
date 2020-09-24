<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Requests\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(Request $request, User $user)
    {

        $this->request = $request;
        $this->user = $user;
    }
    public function index($auth){
        return Auth::user()->auth != 'admin' ? redirect(route('dashboard'))
            : view('user.index', [
                'users' => $this->user->where('auth', $auth)->latest()->paginate(20),
                'auth' => $auth,
            ]);
    }
    public function update(){
        $this->user->where('id', request('id'))->update($this->request->setUser());
        return back()->with('positive', 'success_update');
    }
    public function delete(){
        $this->user->where('id', request('id'))->delete();
        return back()->with('positive', 'success_delete');
    }

}
