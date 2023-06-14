<?php
// SellerView.php

class SellerView {
    public function renderSellers($sellers) {
        header('Content-Type: application/json');
        echo json_encode($sellers);
    }

    public function renderSeller($seller) {
        if ($seller) {
            header('Content-Type: application/json');
            echo json_encode($seller);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Seller not found";
        }
    }
    public function renderSuccessResponse() {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'POST request received and data inserted successfully']);
    }

    public function renderErrorResponse() {
        header('HTTP/1.1 500 Internal Server Error');
        echo 'Error inserting data';
    }
}
?>
