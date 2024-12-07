<?php
/*
*reviews controller
*/
// Create or access a Session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
//Get the products model
require_once '../model/products-model.php';
//Get the uploads model
require_once '../model/uploads-model.php';
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
  case 'newReview':
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    if (empty($reviewText) || empty($invId) || empty($clientId)) {
      $message = '<p>All fields are required.</p>';
      include '../view/product-details.php';
      exit;
    }

    //Send data to the model
    $newReviewOutcome = newReview($reviewText, $invId, $clientId);

    //Check and report the result
    if ($newReviewOutcome === 1) {
      $message = "<p>Review added!</p>";
      $productInfo = getProductInfo($invId);
      $productThumbnails = getProductThumbnails($invId);
      $itemReviews = getItemReviews($invId);
      $productDisplay = buildProductDisplay($productInfo);
      $thumbnailDisplay = getProductThumbnails($productThumbnails);
      $reviewsDisplay = buildReviewDisplay($itemReviews);

      include '../view/product-detail.php';
      //header('location: /acme/reviews/index.php');
    } else {
      $reviewFormMessage = '<p>An error occurred, please try again! </p>';
      include '../view/product-detail.php';
    }
    break;

    //Show review
  case 'deliver-review-edit':

    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewInfo = getCurrentReview($reviewId);

    if (empty($reviewId)) {
      $_SESSION['message'] = '<p>Sorry, the review was not found.</p>';
      header('location: /acme/accounts');
      exit;
    }
    $containreviewid = getReview($reviewId);

    if (empty($containreviewid)) {
      $_SESSION['message'] = '<p>Sorry, the review was not found.</p>';
      header('location: /acme/accounts');
      exit;
    }

    include '../view/review-edit.php';
    break;

    //Process edit review
  case 'processEditReviewview':
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $review = getReview($reviewId);
    if (empty($review)) {
      $_SESSION['message'] = '<p>All fields are required.</p>';
      include '../view/review-edit.php';
      exit;
    }

    if (empty($reviewText)) {
      $_SESSION['message'] = '<p>All fields are required.</p>';
      include '../view/review-edit.php';
      exit;
    }

    $editedReviewResult = updateReview($reviewText, $reviewId);

    if ($editedReviewResult < 1) {
      $editMessage = "<p>Review upated!</p>";
      $_SESSION['message'] = $editMessage;
      header('location: /acme/accounts/');
    } else {
      $_SESSION['message'] = "<p>Updated Correctly :)</p>";
      header('location: /acme/accounts/');
      exit;
    }
    break;

    //Post Delete Review
  case 'postDeleteReview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewInfo = getCurrentReview($reviewId);
    if (empty($reviewId)) {
      $_SESSION['message'] = "<p>No review found, please try again.</p>";
      header('location: /acme/accounts/');
      exit;
    }
    $review = getReview($reviewId);
    if (empty($review)) {
      $_SESSION['message'] = "<p>No review found, please try again.</p>";
      header('location: /acme/accounts/');
      exit;
    }

    include '../view/review-delete.php';
    break;

    // Process Delete REVIEW
  case 'processDeleteReview':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $review = getReview($reviewId);

    if (empty($review)) {
      $_SESSION['message'] = "<p>No review found, please try again.</p>";
      header('location: /acme/accounts/');
      exit;
    }

    $deleteResult = deleteReview($reviewId);

    if ($deleteResult < 1) {
      $message = "<p>Review was not deleted!  please try again.</p>";
      $_SESSION['message'] = $message;
      include '../view/review-delete.php';
    } else {
      $message = "<p>Review deleted successfully!</p>";
      $_SESSION['message'] = $message;
      header('location: /acme/accounts/');
      exit;
    }
    break;


  default:
}
