<?php
/*
* Products Controller
*/

// Create or access a Session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model for use as needed
require_once '../model/products-model.php';
// Get the uploads model for use as needed
require_once '../model/uploads-model.php';
// Get the review model
require_once '../model/reviews-model.php';
// Get the functions library
require_once '../library/functions.php';


// Get the array of categories
$categories = getCategories();

// Nav List
$navList = navList($categories);

// var_dump($categories);
// echo '<pre>' . print_r($categories, true) . '</pre>';
// exit;

//  echo $navList;
//  exit;

//Action
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'newCat':
    include '../view/new-category.php';
    break;

  case 'addCat':
    $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

    if (empty($categoryName)) {
      $message = '<p>*Please provide information for all empty form fields.*</p>';
      include '../view/new-category.php';
      exit;
    }

    // Send the data to the model
    $regOutcome = newCategory($categoryName);

    // Check and report the result
    if ($regOutcome === 1) {
      header("location:/acme/products/index.php");
      exit;
    } else {
      $message = "<p>Sorry $categoryName, but there wasn't possible to add a new category</p>";
      include '../view/new-category.php';
      exit;
    }


    break;

  case 'newProduct':
    include '../view/new-product.php';

    break;

  case 'newProd':

    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
    $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
    $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
    $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
    $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

    // Check for missing data
    if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
      $message = '<p>*Please provide information for all empty form fields.*</p>';
      include '../view/new-product.php';
      exit;
    }

    // Send the data to the model
    $insertNew = addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

    // Check and report the result
    if ($insertNew) {
      $message = "<p>Great! $invName added to inventory.</p>";
      include '../view/new-product.php';
      exit;
    } else {
      $message = "<p>Sorry but there wasn't possible to add a new product </p>";
      include '../view/new-product.php';
      exit;
    }

    break;

    //Get Inventory Items by Id
  case 'getInventoryItems':
    // Get the categoryId 
    $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
    // Fetch the products by categoryId from the DB 
    $productsArray = getProductsByCategory($categoryId);
    // Convert the array to a JSON object and send it back 
    echo json_encode($productsArray);
    break;


  case 'mod':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    if (count($prodInfo) < 1) {
      $_SESSION['message'] = 'Sorry, no product information could be found.';
      header('Location: /acme/products/');
      exit;
    }
    include '../view/prod-update.php';
    exit;
    break;


  case 'updateProd':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
    $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
    $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
    $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
    $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

    if (
      empty($invName) || empty($invDescription)
      || empty($invImage) || empty($invThumbnail) || empty($invPrice)
      || empty($invStock) || empty($invSize) || empty($invWeight)
      || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)
    ) {
      $_SESSION['message'] = '<p>Please complete all information for the new item! </p>';
      include '../view/new-prod.php';
      exit;
    }
    $updateResult = updateProduct(
      $invId,
      $invName,
      $invDescription,
      $invImage,
      $invThumbnail,
      $invPrice,
      $invStock,
      $invSize,
      $invWeight,
      $invLocation,
      $categoryId,
      $invVendor,
      $invStyle
    );
    if ($updateResult) {
      $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header('location: /acme/products/');
      exit;
    } else {
      $_SESSION['message'] = "<p>Error. The new product was not updated.</p>";
      include '../view/prod-update.php';
      exit;
    }
    break;


  case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    if (count($prodInfo) < 1) {
      $_SESSION['message'] = 'Sorry, no product information could be found.';
      header('Location: /acme/products/');
      exit;
    }
    include '../view/prod-delete.php';
    exit;
    break;


  case 'deleteProd':
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteProduct($invId);
    if ($deleteResult) {
      $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /acme/products/');
      exit;
    } else {
      $message = "<p class='notice'>Error: $invName was not deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /acme/products/');
      exit;
    }
    break;


  case 'category':

    $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
    $products = getProductsByCategoryName($categoryName);
    if (!count($products)) {
      $_SESSION['message'] = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
    } else {
      $prodDisplay = buildProductsDisplay($products);
    }

    // echo $prodDisplay;
    // exit;

    include '../view/category.php';
    break;

  case 'detail':

    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $productInfo = getProductInfo($invId);
    $itemReviews = getItemReviews($invId);


    if (empty($productInfo)) {
      $_SESSION['message'] = "Sorry, no product information could be found";
    } else {
      $productThumbnails = getProductThumbnails($invId);
      // $productDisplay = buildProductDisplay($productInfo);
      $reviewsDisplay = buildReviewDisplay($itemReviews);
    }
    include '../view/product-detail.php';

    break;


  default:

    $categoryList = buildCategoryList($categories);

    include '../view/product-mgmt.php';
}
