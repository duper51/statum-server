<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 5/24/2017
 * Time: 11:58 PM
 */

namespace Me\Controller;


use Me\Models\LoginToken;
use Me\Services\NonceService;
use Me\Views\LoginPage;
use Illuminate\Database\Capsule\Manager as Capsule;
class LoginController extends Controller
{
    private $routes = [
        "GET:login" => "login",
        "POST:login" => "process_login"
    ];

    public function process_login($request, $response) {
        if(isset($request->username) && isset($request->password) && isset($request->nonce)) {
            $val = Capsule::table("users")->where('username', $request->username)->first();
            if(password_verify($request->password, $val['password'])) {
                $_SESSION['login'] = true;
                $token = new LoginToken();
                $token->token = NonceService::generate_nonce();
                $token->username = $request->username;
                $token->save();
                setcookie("login_token", $token->token, time() + (3600 * 24 * 30));
                setcookie("username", $request->username, time() + (3600 * 24  * 30));
                $response->redirect("/")->send();
            } else {
                $login = new LoginPage();
                $login->execute(['warning' => "Bad username or password."]);
            }
        } else {
            $login = new LoginPage();
            $login->execute(['warning' => "Please enter a username and password."]);
        }
    }
}