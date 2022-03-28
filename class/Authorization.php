<?php
namespace App;
class Authorization extends User
{
    public string $login;
    public string $password;

    public function __construct($request){

        $this->login = $request['login'];
        $this->password = $request['password'];
    }


    public function validateAuthForm(array $request, object $user, DatabaseManager $dbManager):array
    {
        $errors = [];

        if (!$dbManager->dataValidation($user)){
            $errors []['login'] = 'Wrong login or password';
            $errors []['password'] = 'Wrong login or password';
        }

        if (empty($request['login'])){
            $errors[]['login'] = 'Enter your login';
        } elseif (strlen($request['login']) <= 5){
            $errors[]['login'] = 'Minimum 6 characters required';
        } elseif ($request['login'] != str_replace(" ", '', $request['login'])) {
            $errors[]['login'] = 'Invalid input, do not use spaces';
        }

        if (empty($request['password'])){
            $errors[]['password'] = 'Enter password';
        } elseif (strlen($request['password']) <= 5){
            $errors[]['password'] = 'Minimum 6 characters required';
        } elseif (!preg_match('/^[a-zA-Z\d]{1}[a-zA-Z\d]*[a-zA-Z\d]{1}$/', $request['password'])){
            $errors[]['password'] = 'Only latin letters and numbers';
        }

        return $errors;

    }

    public function setSession(string $login, string $cookieHash):void
    {
        setcookie('hash', $cookieHash, time() + 3600, '/');
        setcookie('user', $login, time() + 3600, '/');
        session_start();
        $_SESSION['user'] = $login;
    }
}
