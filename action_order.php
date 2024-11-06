<?php
// Start session and include Firebase connection files
session_name('MyCustomSessionName');
session_start();
require_once './config.php';
require_once './firebaseRDB.php';

// Initialize FirebaseRDB class
$db = new firebaseRDB($databaseURL);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $productKey = $_POST['product_key']; 
    $totalAmount = $_POST['total_amount']; // Assuming total_amount is entered in the form

    // Check if the user session is available
    if (isset($_SESSION['user'])) {
        $userKey = $_SESSION['user']['id'];  // Retrieve user key from the session
       
        // Prepare data to insert
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'user_key' => $userKey, // Storing the user key
            'total_amount' => $totalAmount, // Storing the total amount
            'product_key' => $productKey,
        ];

        try {
            // Retrieve the current stock of the ordered medicine
            $medicineData = $db->retrieve("medicines/{$productKey}");
            $medicine = json_decode($medicineData, true);

            if ($medicine && isset($medicine['medicine_stock'])) {
                // Check if the stock is zero or less
                $currentStock = (int)$medicine['medicine_stock'];
                if ($currentStock <= 0) {
                    echo '<script>
                        alert("This item is currently out of stock.");
                        window.location.href = "index.php";
                    </script>';
                    exit; // Stop execution if out of stock
                }

                // Insert booking data into Firebase
                $inserted = $db->insert('bookings', $data);

                // Check if the insertion was successful
                if ($inserted) {
                    // Calculate the new stock value
                    $newStock = $currentStock - 1;

                    // Update the stock in the medicines collection
                    $updateData = ['medicine_stock' => $newStock];
                    $db->update("medicines", $productKey, $updateData);

                    echo '<script>
                        alert("Booking details saved successfully and stock updated!");
                        window.location.href = "index.php";
                    </script>';
                } else {
                    throw new Exception("Failed to save booking details.");
                }
            } else {
                throw new Exception("Medicine not found or stock data is unavailable.");
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        // User session is not available, redirect to login
        echo '<script>alert("Please log in to continue."); window.location.href = "login.php";</script>';
    }
}
?>
