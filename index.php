<?php
/*
* Acme Controller
*/

// Create or access a Session 
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of categories
$categories = getCategories();



// Nav List
$navList = navList($categories);

// 27 de Marzo 
// if (isset($_SESSION['loggedin'])) {
//   $clientData = getClient($_SESSION['clientData']['clientEmail']);
//   array_pop($clientData);
// }

//  echo $navList;
//  exit;

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

//Action
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'something':

    break;

  default:
    include 'view/home.php';
}
