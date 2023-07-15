<?php
require_once 'inc/dbcon.php';

$dbConnection = new DatabaseConnection();

try {
    // Start the transaction
    $dbConnection->getConnection()->begin_transaction();

    $tableName = 'users';
    $userTable = [
        'username' => DatabaseConnection::sanitizeInput($_POST['userName']),
        'password' => DatabaseConnection::sanitizeInput($_POST['password']),
        'userPicture' => DatabaseConnection::sanitizeInput($_POST['profilePicture']),
        'email' => DatabaseConnection::sanitizeInput($_POST['email']),
        'firstName' => DatabaseConnection::sanitizeInput($_POST['firstName']),
        'lastName' => DatabaseConnection::sanitizeInput($_POST['lastName']),
        'age' => DatabaseConnection::sanitizeInput($_POST['age']),
    ];
    $dbConnection->insert($tableName, $userTable);


    $tableName ='hobby';
    $hobbyTable = [
        'primaryHobby' => DatabaseConnection::sanitizeInput($_POST['masterHobby']),
        'secondaryHobby' => DatabaseConnection::sanitizeInput($_POST['secondaryHobby']),
        'tertiaryHobby' => DatabaseConnection::sanitizeInput($_POST['tertiaryHobby']),
    ];

    $dbConnection->insert($tableName, $hobbyTable);

    // Commit the transaction if all inserts are successful
    $dbConnection->getConnection()->commit();
} catch (Exception $e) {
    $dbConnection->getConnection()->rollback();
    throw $e; // or handle the exception as needed
}
?>
