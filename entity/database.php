<?php

namespace App;

class DatabaseManager
{
    public static $db = 'db.json';

    public function saveUser(object $user):void
    {
        $lineBreak = PHP_EOL;
        $json = json_encode($user);
        $data = file_get_contents(self::$db);
        $selector = empty($data) ? "[{$json}]" : ",{$lineBreak}{$json}]";
        $fileHandler = fopen(self::$db, "c");
        fseek($fileHandler, -1, SEEK_END);
        fwrite($fileHandler, $selector);
        fclose($fileHandler);
    }

    public function isLoginExist($login):bool
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data);
        foreach($data as $user){
            if ($user->login === $login){
                return true;
            }
        }
        return false;
    }

    public function isEmailExist(string $email):bool
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data);
        foreach($data as $user){
            if ($user->email === $email){
                return true;
            }
        }
        return false;

    }

    public function dataValidation(object $auth): bool
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data);
        foreach($data as $user){
            if ($user->password === $auth->password && $user->login === $auth->login){
                return true;
            }
        }
        return false;

    }

    public function appendCookie(string $login, string $cookieHash):void
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data);
        // print_r($data);
        foreach($data as $key => $user){
            // print_r($user);
            if ($user->login === $login){
                $user->cookie = $cookieHash;
                $data[$key] = $user;
                $data = json_encode($data);
                file_put_contents(self::$db, $data);
            }
        }
    }

    public function getCookieHash(string $login)
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data);
        foreach($data as $user){
            if ($user->login === $login){
                if (property_exists($user, 'cookie')){
                    return $user->cookie;
                }


            }
        }
        return false;
    }

    public function findNameByLogin(string $login):string
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data);
        foreach($data as $user) {
            if ($user->login === $login) {
                return $user->name;
            }
        }
        return 'Что-то пошло не так';
    }

    public function findAll():array
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data, true);
        return $data;
    }

    public function deleteUser(string $login):void
    {
        $data = file_get_contents(self::$db);
        $data = json_decode($data, true);
        foreach ($data as $id => $user){
            if ($user['login'] == $login){
                unset($data[$id]);
            }
        }
        $json = json_encode($data);
        file_put_contents('db.json', $json);
    }
}