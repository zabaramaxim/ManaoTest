<?php
namespace App; //include_once $_SERVER['DOCUMENT_ROOT'] . '/entity/database.php';
use App\DatabaseManager;
class FormValidate
{
    public function validateRegistrationForm($request, DatabaseManager $dbManager):array {
        $errors = [];
//        $dbManager = new DatabaseManager();

        if (empty($request['login'])){
            $errors[]['login'] = 'Enter your login';
        } elseif (strlen($request['login']) <= 5){
            $errors[]['login'] = 'Minimum 6 characters required';
        } elseif ($request['login'] != str_replace(" ", '', $request['login'])){
            $errors[]['login'] = 'Invalid input, do not use spaces';
        } elseif ($dbManager->isLoginExist($request['login'])){
            $errors[]['login'] = 'Login already exist';
        }



        if (empty($request['password'])){
            $errors[]['password'] = 'Enter password';
        } elseif (strlen($request['password']) <= 5){
            $errors[]['password'] = 'Minimum 6 characters required';
        } elseif (!preg_match('/^[a-zA-Z\d]{1}[a-zA-Z\d]*[a-zA-Z\d]{1}$/', $request['password'])){
            $errors[]['password'] = 'Only latin letters and numbers';
        }


        if (empty($request['repeat-password'])){
            $errors[]['repeat_password'] = 'Repeat password';
        } elseif (strlen($request['repeat-password']) <= 5) {
            $errors[]['repeat-password'] = 'Minimum 6 characters required';
        } elseif (!preg_match('/^[a-zA-Z\d]{1}[a-zA-Z\d]*[a-zA-Z\d]{1}$/', $request['repeat-password'])) {
            $errors[]['repeat-password'] = 'Only latin letters and numbers';
        } elseif ($request['password'] != $request['repeat-password']){
            $errors[]['repeat-password'] = 'Passwords do not match';
        }


        if (empty($request['email'])) {
            $errors[]['email'] = 'Enter email ';
        } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[]['email'] = 'invalid email';
        } elseif (strlen($request['email']) < 4) {
            $errors[]['email'] = 'Email should be more 4 symbol';
        } elseif ($dbManager->isEmailExist($request['email'])){
            $errors[]['email'] = 'Email already exist';
        }



        if (empty($request['name'])) {
            $errors[]['name'] = 'Enter your name';
        } elseif (strlen($request['name']) <= 1){
            $errors[]['name'] = 'Minimum 2 characters required';
        } elseif (!preg_match('/^[a-zA-Z]*[a-zA-Z]{1}$/', $request['name'])){
            $errors[]['name'] = 'Only latin letters';
        }

        return $errors;
    }


    public function isValid(array $errors):bool {
        if (empty($errors)){
            return true;
        }return false;
    }
}
