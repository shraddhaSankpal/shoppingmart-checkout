<?php
require_once("db.php");
define('DB_PREFIX', 'xyl');

class cart{

    // Constructor to initialize Database connection
    function __construct() {
        // create instance of the object
        $database = new DB();
        $this->db = $database->connectDB();
    }

    // Method to get the all product from super market
    function getProducts(){
        // Query to get the DATA
        $query = "SELECT p.* from " . DB_PREFIX . "_products as p";

        try
        {
            $statement = $this->db->prepare($query);
            $statement->execute(array());
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            // $_SESSION['items'] = $result;
            return  $result;
        }
        catch (\PDOException $e)
        {
            $jsonResponse = json_encode('Something Went Wrong');
            echo $jsonResponse;
            exit();
        }
    }

    // Method to add the product to cart with price as per quantity
    function add(){
        if(!empty($_POST["quantity"])) {

            // Query to get the DATA by Sku
            $query = "SELECT p.* from " . DB_PREFIX . "_products as p where p.sku = :sku";
            try
            {
                // Get the details of the product as per the sku id
                $statement = $this->db->prepare($query);
                $statement->execute(array('sku' => $_GET['sku']));
                $product = $statement->fetch(\PDO::FETCH_ASSOC);
            }
            catch (\PDOException $e)
            {
                $jsonResponse = json_encode('Something Went Wrong');
                echo $jsonResponse;
                exit();
            }

            // Query to get the DATA by sku id
            $query = "SELECT pd.* from " . DB_PREFIX . "_product_discounts as pd where pd.sku_id = :sku_id";
            try
            {
                // Get the details of the product discounts as per the sku id
                $statement = $this->db->prepare($query);
                $statement->execute(array('sku_id' => $_GET['sku']));
                $productDiscounts = $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
            catch (\PDOException $e)
            {
                $jsonResponse = json_encode('Something Went Wrong');
                echo $jsonResponse;
                exit();
            }

            // Alogn the details of the product

            
            $product['quantity'] = $_POST["quantity"];
            $totalPrice = $this->calculateProductDiscountPrice($product, $productDiscounts);
            $itemArray = array(
                $product["sku"] => 
                    array(
                        'name'=>$product["name"],
                        'sku'=>$product["sku"],
                        'quantity'=>$_POST["quantity"],
                        'price'=>$product["unit_price"],
                        'image'=>$product["image"],
                        'totalPrice' => $totalPrice
                    )
                );

            if(!empty($_SESSION["cartItems"])) {
                // TODO
                $_SESSION["cartItems"] = array_merge($_SESSION["cartItems"],$itemArray);
            }
            else{
                $_SESSION["cartItems"] = $itemArray;
            }
        }
    }

    function calculateProductDiscountPrice($product, $productDiscounts){
        $totalProductPrice = $product['unit_price'] * $product['quantity'];

        // If multiple discount present for single product
        foreach($productDiscounts as $discount){
            if ($product['quantity'] > $discount['quantity']){
                $remainingQuantity = $product['quantity'] - $discount['quantity'];
                $total = $discount['price'] + ( $remainingQuantity * $product['unit_price']);
                if ($total < $totalProductPrice)
                {
                    $totalProductPrice = $total;
                }
            }
            elseif($product['quantity'] == $discount['quantity'])
            {
                if ($discount['price'] < $totalProductPrice){
                    $totalProductPrice = $discount['price'];
                } 
            }

            if (!empty($discount['ref']) && ($product['quantity'] <= $_SESSION['cartItems'][$discount['ref']])){
                $remainingQuantity = $product['quantity'] - $_SESSION['cartItems'][$discount['ref']]['quantity'];
                $total = ($remainingQuantity * $product['unit_price']) + ($product['quantity'] * $discount['ref_price']);

                if ($total < $totalProductPrice)
                {
                    $totalProductPrice = $total;
                }
            }
        }

        return $totalProductPrice;
    }
}
?>