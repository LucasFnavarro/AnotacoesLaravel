<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // Form validation
        $request->validate(
            //rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            // error messages
            [
                'text_username.required' => 'O username é obrigatório',
                'text_username.email' => 'Username deve ser um e-mail válido!',
                'text_password.required' => 'A password é obrigatória.',
                'text_password.min' => 'A password deve ter pelo menos :min caracteres',
                'text_password.max' => 'A password deve ter no máximo :max caracteres'
            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // check if user exists
        $user = User::where('username', $username)->where('deleted_at', null)->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Username ou password incorretos.');
        }

        // check if password is correct
        if (!password_verify($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Username ou password incorretos.');
        }

        // update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // login user (coloca os dados do usuário logado na sessão)
        session([
             'user' => [
                'id' => $user->id,
               'username' => $user->username
             ]
        ]);

        // dd($user);

        // echo "Login efetudo com sucesso";

        // test database connection
        // try{
        //     DB::connection()->getPdo();
        //     echo "Connection is OK!";
        // }catch(\PDOException $e){
        //     echo "Connection failed:" . $e->getMessage();
        // }

        // get all the users from the database
        // $users1 = User::all()->toArray();
        // echo "<pre>";
        // print_r($users1);


        // as object instance of model's class
        // trás o mesmo resultado que a forma de cima.
        // $userModel = new User();
        // $users = $userModel->all()->toArray();


        // echo "<pre>";
        // print_r($users);
    }

    public function logout()
    {
        // Removendo o usuário que existe na sessão.
        session()->forget('user');
        return redirect()->to('/login');
    }
}
