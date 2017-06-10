<?php

require_once 'config.php';
require_once 'user.php';

// $user = new User();

// $user->setEmail(time().'test@test.pl');
// $user->setUsername('Tester Testowy');
// $user->setPassword('test');

// $user->saveToDB($conn);

// $user->saveToDB($conn);

$user = User::loadUserById($conn, 1);

$user->setUsername('fixed');
$user->setEmail('fixed@fixed.com');

$user->saveToDB($conn);

var_dump(User::LoadAllUsers($conn));





foreach (User::loadAllUsers($conn) as $key => $user) {
	$user->setUsername($key . '-' . $user->getUSername());

	$user->saveToDB($conn);
}

$user = User::loadUserById($conn , 3);
$user->delete($conn);
var_dump($user);



