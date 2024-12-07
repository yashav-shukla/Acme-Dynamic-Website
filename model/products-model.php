<?php

/*
* Products Model
*/

function newCategory($categoryName)
{
        // Create a connection object using the acme connection function
        $db = acmeConnect();
        $sql = 'INSERT INTO categories (categoryName)
        VALUES (:categoryName)';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next line replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
}

function addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle)
{
        // Create a connection object using the acme connection function
        $db = acmeConnect();
        // SQL statement for database
        $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle)
               VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next 12 lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
        $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
        $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
        $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
        $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
}

// Get products by categoryId 
function getProductsByCategory($categoryId)
{
        $db = acmeConnect();
        $sql = 'SELECT * FROM inventory WHERE categoryId = :categoryId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
}

// Get product information by invId<>
function getProductInfo($invId)
{
        $db = acmeConnect();
        $sql = 'SELECT * FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $prodInfo;
}

// Update a product
function updateProduct(
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
) {
        // Create a connection
        $db = acmeConnect();
        // The SQL statement to be used with the database
        $sql = 'UPDATE inventory SET invName = :invName, 
  invDescription = :invDescription, invImage = :invImage, 
  invThumbnail = :invThumbnail, invPrice = :invPrice, 
  invStock = :invStock, invSize = :invSize, 
  invWeight = :invWeight, invLocation = :invLocation, 
  categoryId = :categoryId, invVendor = :invVendor, 
  invStyle = :invStyle WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
        $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
        $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
        $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
}

function deleteProduct($invId)
{
        $db = acmeConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
}

//Get a list of products based on the category
function getProductsByCategoryName($categoryName)
{
        $db = acmeConnect();
        $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
}

// Get the list of products
function getProductBasics()
{
        $db = acmeConnect();
        $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
}

function getProductThumbnails($invId)
{
        $db = acmeConnect();
        $sql = "SELECT * FROM images WHERE invId = :invId AND imgName LIKE '%-tn%'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue('invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $prodImages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $prodImages;
}
