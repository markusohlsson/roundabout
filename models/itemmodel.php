<?php
// itemmodel.php

class ItemModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllItems() {
        $stmt = $this->conn->query("SELECT * FROM items");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemById($itemId) {
        $stmt = $this->conn->prepare("SELECT * FROM items WHERE item_id = :itemId");
        $stmt->bindParam(':itemId', $itemId);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    public function markItemAsSold($itemId) {
        $soldDate = date('Y-m-d');
        $stmt = $this->conn->prepare("UPDATE items SET sold = 1, sold_date = :soldDate WHERE item_id = :itemId");
        $stmt->bindParam(':itemId', $itemId);
        $stmt->bindParam(':soldDate', $soldDate);
        $stmt->execute();

        $stmt = $this->conn->prepare("SELECT * FROM items WHERE item_id = :itemId");
        $stmt->bindParam(':itemId', $itemId);
        $stmt->execute();
        $updatedItem = $stmt->fetch(PDO::FETCH_ASSOC);

        return $updatedItem;
    }

    public function updateSellerStats($sellerId, $price) {
        $updateStmt = $this->conn->prepare("UPDATE sellers SET total_items_sold = total_items_sold + 1, total_sales_amount = total_sales_amount + :price WHERE seller_id = :sellerId");
        $updateStmt->bindParam(':price', $price);
        $updateStmt->bindParam(':sellerId', $sellerId);
        $updateStmt->execute();
    }
    public function insertItem($name, $sellerId, $submittedDate, $sold, $price) {
        $stmt = $this->conn->prepare("INSERT INTO items (name, seller_id, submitted_date, sold, price) VALUES (:name, :seller_id, :submitted_date, :sold, :price)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':seller_id', $sellerId);
        $stmt->bindParam(':submitted_date', $submittedDate);
        $stmt->bindParam(':sold', $sold);
        $stmt->bindParam(':price', $price);

        if ($stmt->execute()) {
            $updateStmt = $this->conn->prepare("UPDATE sellers SET total_items_submitted = total_items_submitted + 1 WHERE seller_id = :seller_id");
            $updateStmt->bindParam(':seller_id', $sellerId);
            $updateStmt->execute();

            return true;
        } else {
            return false;
        }
    }
}
?>
