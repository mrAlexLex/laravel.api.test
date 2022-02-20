<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Auth\ServerCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function save(UserRequest $request)
    {
        $validateFields = $request->validated();
        $loginHashFields =  hash('sha256', $validateFields['ftp_login']);
        $user = ServerCredentials::where('ftp_login', $loginHashFields)->first();

        if (!$user){
            $user = new ServerCredentials();
            $user->fill($validateFields);
            $user->setAuthTokenAttribute();
            if ($user->save()){
                Auth::login($user);
                if (Auth::check()){
                    return redirect(route('tickets.tickets'));
                }
            }
        }else{
            return redirect(route('tickets.registration'))->withErrors([
                'formError' => 'Пользователь уже существует'
            ]);
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
