<?php
namespace App;

class User
{

    public string $login;
    public string $password;
    public string $email;
    public string $name;
    private static $salt = 'salt';
//    public static $db = 'db.json';

    function __construct($request){
        $this->login = $request['login'];
        $this->password = $request['password'];
        $this->email = $request['email'];
        $this->name = $request['name'];
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
//        $password = $this->hashPassword($password);
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function hashPassword(): string
    {
        return $this->password = hash('sha1',self::$salt . $this->password);
    }

//    public function registration():void
//    {
//        $lineBreak = PHP_EOL;
//        $json = json_encode($this);
//        $data = file_get_contents('db.json');
//        $selector = empty($data) ? "[{$json}]" : ",{$lineBreak}{$json}]";
//        echo $selector;
//        $fileHandler = fopen('db.json', "c");
//        fseek($fileHandler, -1, SEEK_END);
//        fwrite($fileHandler, $selector);
//        fclose($fileHandler);
//        echo 'sadfads';
//
//    }
}
