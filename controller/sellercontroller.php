<?php
// SellerController.php
class SellerController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleEndpoint($endpoint) {
        if ($endpoint === '/sellers') {
            $sellers = $this->model->getAllSellers();
            $this->view->renderSellers($sellers);
            exit();
        } elseif (strpos($endpoint, '/sellers/') === 0) {
            $sellerId = substr($endpoint, strlen('/sellers/'));
            $seller = $this->model->getSellerById($sellerId);
            $items = array();
            
            foreach ($seller as $item) {
                $itemData = array(
                    "item_id" => $item["item_id"],
                    "item_name" => $item["item_name"],
                    "submitted_date" => $item["submitted_date"],
                    "sold" => $item["sold"],
                    "price" => $item["price"],
                    "sold_date" => $item["sold_date"]
                );
                $items[] = $itemData;
            }
            
            $sellerData = array(
                "seller_id" => $seller[0]["seller_id"],
                "seller_name" => $seller[0]["seller_name"],
                "total_items_submitted" => $seller[0]["total_items_submitted"],
                "total_items_sold" => $seller[0]["total_items_sold"],
                "total_sales_amount" => $seller[0]["total_sales_amount"],
                "items" => $items
            );
            
            header('Content-Type: application/json');
            
            echo json_encode($sellerData);
            exit();
        }
    }

    public function createSeller() {
        $jsonPayload = file_get_contents('php://input');
        $data = json_decode($jsonPayload, true);
        $name = isset($data['name']) ? filter_var($data['name'], FILTER_SANITIZE_STRING) : '';
        $totalItemsSubmitted = isset($data['total_items_submitted']) ? filter_var($data['total_items_submitted'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $totalItemsSold = isset($data['total_items_sold']) ? filter_var($data['total_items_sold'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $totalSalesAmount = isset($data['total_sales_amount']) ? filter_var($data['total_sales_amount'], FILTER_SANITIZE_NUMBER_INT) : 0;

        $success = $this->model->createSeller($name, $totalItemsSubmitted, $totalItemsSold, $totalSalesAmount);
        if ($success) {
            $this->view->renderSuccessResponse();
        } else {
            $this->view->renderErrorResponse();
        }
    }
}
?>
