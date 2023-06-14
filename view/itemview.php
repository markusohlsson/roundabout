<?php 
// view.php

class ItemView {
    public function renderJson($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function renderNotFound() {
        header("HTTP/1.0 404 Not Found");
        echo "Item not found";
    }
    public function renderSuccessResponse() {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'POST request received, data inserted, and seller updated successfully']);
    }

    public function renderErrorResponse() {
        header('HTTP/1.1 500 Internal Server Error');
        echo 'Error inserting data';
    }
}



?>