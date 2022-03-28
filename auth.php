<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/entity/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/Validate.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/entity/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/Authorization.php';
//use App\User;
use App\Authorization;
use App\FormValidate;
use App\DatabaseManager;


    if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

        if (!empty($_POST)) {

            $errors = [];
            $dbManager = new DatabaseManager();
            $form = new FormValidate();
            $auth = new Authorization($_POST);
            $auth->hashPassword();
            $errors = $auth->validateAuthForm($_POST, $auth, $dbManager);

            if (empty($errors)) {
                http_response_code(201);
                echo json_encode(['success' => true]);
                $cookieHash = md5(uniqid(rand(), true));

                $auth->setSession($auth->login, $cookieHash);
                $dbManager->appendCookie($auth->login, $cookieHash);
                exit();
            }

            http_response_code(422); // не прошла валидация
            echo json_encode([
                'success' => false,
                'errors' => $errors
            ]);
            exit();
        }
    }




