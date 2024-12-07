<?php

//Review model

/*
needed functions for the review :
  -. add a review
  -. get reviews for a specific inventory item
  -. get reviews written by the user
  -. get a specific review
  -. update a specific review
  -. delete a specific review
*/


//add new review 
function newReview($reviewText, $invId, $clientId)
{
  $db = acmeConnect();
  $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}



//update a specific review 
function updateReview($reviewText, $reviewId)
{
  $db = acmeConnect();
  $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

//delete a specific review 
function deleteReview($reviewId)
{
  $db = acmeConnect();
  $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

// get reviews for a specific inventory item 
function getItemReviews($invId)
{
  $db = acmeConnect();
  $sql = 'SELECT reviews.*, clients.* FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $itemReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $itemReviews;
}

//get reviews written by the user
function getClientReviews($clientId)
{
  $db = acmeConnect();
  $sql = 'SELECT * FROM reviews AS r INNER JOIN inventory AS i ON r.invId = i.invId WHERE r.clientId = :clientId ORDER BY clientId DESC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}


//get a specific review 
function getReview($reviewId)
{
  $db = acmeConnect();
  $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId ORDER BY reviewDate ASC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $review;
}


function getCurrentReview($reviewId)
{
  $db = acmeConnect();
  $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $review = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $review;
}
