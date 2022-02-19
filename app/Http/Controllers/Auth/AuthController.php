<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Auth\ServerCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function save(Request $request)
    {
        $validateFields = $request->validate([
            'ftp_login' => 'required|string',
            'ftp_password' => 'required|string',
        ]);

        /*
         *
         * Проверка существования пользователя
         * Если есть редирект на регистрацию с ошибкой
         *
         */

        $user = new ServerCredentials();
        $user->fill($validateFields);
        $user->setAuthTokenAttribute();
        if ($user->save()){
            Auth::login($user);
            if (Auth::check()){
                return redirect(route('tickets.tickets'));
            }
        }

        return redirect(route('tickets.login'))->withErrors([
            'formError' => 'Не удалось создать пользователя'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('tickets.tickets'));
    }

    public function login(Request $request)
    {
        $loginFields = $request->only(['ftp_login', 'ftp_password']);
        $loginHashFields = array_map(function (string $fields){
            return hash('sha256', $fields);
        },
        $loginFields);
        $user = ServerCredentials::where($loginHashFields)->first();

        if ($user){
            Auth::login($user);
            if (Auth::check()){
                return redirect(route('tickets.tickets'));
            }
        }

        return redirect(route('tickets.login'))->withErrors([
            'formError' => 'Пользователя нет'
        ]);
    }
}
