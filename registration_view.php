<?php
use App\DatabaseManager;
include 'registration.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/entity/database.php';
if (isset($_COOKIE['user']) && isset($_COOKIE['hash'])){
    session_start();
    $_SESSION['user'] = $_COOKIE['user'];
    $dbManager = new DatabaseManager();
}
include 'index.php';
?>


    <?php if (isset($_SESSION['user']) && isset($_COOKIE['user']) && $_COOKIE['hash'] === $dbManager->getCookieHash($_SESSION['user'])):?>
    <div class="container">
        <h1 class="text-center"> <?= 'Hello, ' . $dbManager->findNameByLogin($_SESSION['user']); ?> </h1>
    </div>
        <?php else :?>
    <div class="container">
        <div class="row justify-content-center">
            <form method="post" id="form" action="registration.php" >
                <h1 class="text-center">Please sign up</h1>
                <div class="form-group ">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp" placeholder="Enter login" >
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="repeat-password">Repeat password</label>
                    <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="Repeat password">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name">
                    <div class="invalid-feedback"></div>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
            </form>
        </div>
    </div>
    <div id="my_message"></div>
    <div id="my"></div>
    <?php endif; ?>
</body>
</html>