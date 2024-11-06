<?php
require_once './config.php';
require_once './firebaseRDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $db = new firebaseRDB($databaseURL);

    try {
        // Update the 'status' to true for the specified item
        $data = ['status' => true];
        // Pass 'medicines' as the table name and $id as the unique ID
        $db->update('medicines', $id, $data);

        // Redirect back to the original page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
