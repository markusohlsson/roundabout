<?php
// SellerModel.php

class SellerModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllSellers() {
        $stmt = $this->conn->query("SELECT * FROM sellers ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSellerById($sellerId) {
        $stmt = $this->conn->prepare("
            SELECT
                items.item_id,
                items.name AS item_name,
                items.submitted_date,
                items.sold,
                items.price,
                items.sold_date,
                sellers.seller_id,
                sellers.name AS seller_name,
                sellers.total_items_submitted,
                sellers.total_items_sold,
                sellers.total_sales_amount
            FROM
                items
                LEFT JOIN sellers ON items.seller_id = sellers.seller_id
            WHERE
                sellers.seller_id = :sellerId
        ");
        $stmt->bindParam(':sellerId', $sellerId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createSeller($name, $totalItemsSubmitted, $totalItemsSold, $totalSalesAmount) {
        $stmt = $this->conn->prepare("INSERT INTO sellers (name, total_items_submitted, total_items_sold, total_sales_amount) VALUES (:name, :total_items_submitted, :total_items_sold, :total_sales_amount)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':total_items_submitted', $totalItemsSubmitted);
        $stmt->bindParam(':total_items_sold', $totalItemsSold);
        $stmt->bindParam(':total_sales_amount', $totalSalesAmount);
        return $stmt->execute();
    }
}
    
