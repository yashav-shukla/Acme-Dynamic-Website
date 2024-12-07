<?php
/*
* Accounts Controller
*/

// Create or access a Session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// get the review model
require_once '../model/reviews-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of categories
$categories = getCategories();

// Nav List
$navList = navList($categories);

//Action
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'login':
    include '../view/login.php';
    break;
  case 'login_user':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    //validate email
    $clientEmail = checkEmail($clientEmail);
    //check password
    $checkPassword = checkPassword($clientPassword);
    //check for missing data
    if (empty($clientEmail) || empty($checkPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/login.php';
      exit;
    }

    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if (!$hashCheck) {
      $message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }

    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;

    // Send them to the admin view
    header('location: /acme/accounts/index.php');
    exit;

    break;
  case 'registration':
    include '../view/registration.php';
    break;

  case 'register':
  case 'register':
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    //validate email
    $clientEmail = checkEmail($clientEmail);
    //check password
    $checkPassword = checkPassword($clientPassword);

    // Check for existing email address in the table
    $existingEmail = checkExistingEmail($clientEmail);
    if ($existingEmail) {
      $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /acme/accounts/?action=login');
      exit;
    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }
    break;


  case 'updateClient';
    include '../view/client-update.php';
    break;

  case 'updateClientInformation';

    // Filter and store the data
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

    //validate email
    $clientEmail = checkEmail($clientEmail);

    //check email to be different than session
    if ($clientEmail != $_SESSION['clientData']['clientEmail']) {

      // Check for existing email address in the table
      $existingEmail = checkExistingEmail($clientEmail);
      if ($existingEmail) {
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/client-update.php';
        exit;
      }
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/client-update.php';
      exit;
    }

    // Send the data to the model
    $updateOutcome = updateClientInformation($clientFirstname, $clientLastname, $clientEmail, $clientId);

    // Check and report the result
    if ($updateOutcome === 1) {
      $clientInfo = getClientInfo($clientId);
      $_SESSION['clientData'] = $clientInfo;
      $_SESSION['message'] = "Information updated correctly!";
      header('Location: /acme/accounts/');
      exit;
    } else {
      $_SESSION['message'] = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;

  case 'updateClientPassword';
    // Filter and store data
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    //check password
    $checkPassword = checkPassword($clientPassword);

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Check for missing data
    if (empty($checkPassword)) {
      $_SESSION['message'] = '<p>**Please check password formatting.**</p>';
      include '../view/client-update.php';
      exit;
    }


    // Send the data to the model
    $updateOutcome = updateClientPassword($hashedPassword, $clientId);

    // Check and report the result
    if ($updateOutcome === 1) {
      $_SESSION['message'] = "Password updated correctly!";
      header('Location: /acme/accounts/');
      exit;
    } else {
      $_SESSION['message'] = "<p>Sorry but the update failed. Please try again.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;

  case 'logout':
    session_destroy();
    header('location: /acme/');
    break;

  default:


    if (isset($_SESSION['clientData'])) {
      $reviews = getClientReviews($_SESSION['clientData']['clientId']);
      if (!empty($reviews)) {
        $reviewList = showadminReview($reviews);
      }
    }
    if (isset($_SESSION['loggedin'])) {
      include '../view/admin.php';
    } else {
      header('Location: /acme/index.php');
    }
    break;
}
