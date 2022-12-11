<?php

namespace App\Http\Controllers\admin\account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class menageController extends Controller
{
    public function create(Request $request)
    {

        $data = $request->validate([
            'email' => 'required',
            'passwd' => 'required',
            'confrimPasswd' => 'required',
        ]);



        $user = new User();
        $user->email = $request->email;
        $user->password = $request->passwd;
        $user->role = 'ADMIN';
        $user->save();
        return redirect()->back()->with([
            'success' => 'Пользователь успешно создан'
        ]);
    }

    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => 'required',
            'passwd' => 'required'
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->passwd,
        ];

        isset($request->stayInSystem) ? $remember = true : $remember = false;

        if (Auth::attempt($data, $remember)) {
            return redirect()->route('admin');
        } else {
            return redirect()->back()->with([
                'email' => $request->email
            ])->withErrors([
                'user' => 'user not found!'
            ]);
        };
        
        return redirect()->route('admin');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'oldPasswd' => 'required',
            'newPasswd' => 'required',
            'confirmNewPasswd' => 'required'
        ]);

        $errors = [];
        Hash::check($request->oldPasswd, Auth::user()->password)
            ?: $errors['oldPasswd'] = 'Старый пароль введен не верно!';
        $request->newPasswd !== $request->confirmNewPasswd
            ? $errors['confirmPassword'] = 'Новые пароли не совподают!' : '';
        if ($errors) return redirect()->back()->withErrors($errors);

        $user = user::find(Auth::user()->id);
        $user->password = $request->newPasswd;
        $user->save();
        return redirect()->back()->with([
            'success' => 'Пароль изменен успешно!'
        ]);
    }

    public function changeEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'passwd' => 'required'
        ]);

        $errors = [];
        Hash::check($request->passwd, Auth::user()->password)
            ?: $errors['password'] = 'Не верный пароль!';
        if($errors) return redirect()->back()->withErrors($errors);

        $user = User::find(auth::user()->id);
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with([
            'success' => 'Почта была успешно измененна!'
        ]);
    }
}
