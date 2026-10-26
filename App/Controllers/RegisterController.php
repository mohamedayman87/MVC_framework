<?php
namespace App\Controllers;

use App\Models\User;
use Moayman\Mvc\Validation\validator;

class RegisterController
{
    public function index()
    {
        return view("auth.register");
    }

    public function store()
    {
        $validator = new validator();
        $validator->setrules([
            'name'=>'required|alnum|between:5,32',
            'username'=>'required|alnum|between:5,32|unique:users,username',
            'email'=>'required|email|between:5,32|unique:users,email',
            'password' => 'required|alnum|between:8,32|confirmed',
            'password_confirmation' => 'required|alnum|between:8,32'
        ]);

        $validator->make(request()->all());

        if(!$validator->passes()){
            app()->session->setFlash('errors',$validator->errors());
            app()->session->setFlash('old',request()->all());
            return back();
        }

        User::create([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt('password')
        ]);

        app()->session->setFlash('success','Registered Successfully !');
        return back();

    }

}