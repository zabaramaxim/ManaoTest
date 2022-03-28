<?php
//header('Content-Type: application/json');

include_once $_SERVER['DOCUMENT_ROOT'] . '/entity/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/Validate.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/entity/database.php';
use App\User;
use App\FormValidate;
use App\DatabaseManager;
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    if (!empty($_POST)) {

        $dbManager = new DatabaseManager();
        $form = new FormValidate();

        $errors = $form->validateRegistrationForm($_POST, $dbManager);

        if ($form->isValid($errors)) {
            $user = new User($_POST);
            $user->hashPassword();
            $dbManager->saveUser($user);
            http_response_code(201);
            echo json_encode(['success' => true]);
            exit();
        }

        http_response_code(422);
        echo json_encode([
            'success' => false,
            'errors' => $errors
        ]);
        exit();
    }
}