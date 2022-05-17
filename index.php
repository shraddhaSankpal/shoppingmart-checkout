<?php
session_start();
require_once("cart.php");
$cart = new cart();
$items = $cart->getProducts();

// if(isset($_POST['submit']) {
    // $nabava = new nabava();
    // $vnosNarocila = $nabava->vnos_narocila();
// }

if (!empty($_GET['action']))
{
   switch ($_GET['action'])
   {
        case 'add':
            $cart->add();
        break;
        case "remove":
            if(!empty($_SESSION["cartItems"])) {
                foreach($_SESSION["cartItems"] as $k => $v) {
                        if($_GET["sku"] == $k)
                            unset($_SESSION["cartItems"][$k]);				
                        if(empty($_SESSION["cartItems"]))
                            unset($_SESSION["cartItems"]);
                }
            }
        break;
        case "empty":
            unset($_SESSION["cartItems"]);
        break;	
   }
}

$totalQuantity = 0;
$totalPrice = 0;
?>
<HTML>
    <HEAD>
        <TITLE>Shopping Market</TITLE>
        <link href="style.css" type="text/css" rel="stylesheet" />
    </HEAD>
    <BODY>
        <div id="shopping-cart">
            <div class="txt-heading">Shopping Cart</div>
            <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
            <?php if (!empty($_SESSION["cartItems"])){?>
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
                <tbody>
                <tr>
                    <th style="text-align:left;">Name</th>
                    <th style="text-align:left;">Sku</th>
                    <th style="text-align:right;" width="5%">Quantity</th>
                    <th style="text-align:right;" width="10%">Unit Price</th>
                    <th style="text-align:right;" width="10%">Price</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                </tr>
                <?php foreach ($_SESSION["cartItems"] as $item){ ?>
                    <tr>
                        <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                        <td><?php echo $item["sku"]; ?></td>
                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                        <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                        <td  style="text-align:right;"><?php echo "$ ". $item['totalPrice']; ?></td>
                        <td style="text-align:center;"><a href='index.php?action=remove&sku=<?php echo $item["sku"]; ?>' class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                    </tr>
                    <?php 
                        $totalQuantity += $item["quantity"];
                        $totalPrice += $item["totalPrice"];
                        } ?>
                    <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td align="right"><?php echo $totalQuantity; ?></td>
                        <td align="right" colspan="2"><strong><?php echo "$ ".number_format($totalPrice, 2); ?></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <?php }else{?>
                <div class="no-records">Your Cart is Empty</div>
            <?php } ?>
        <div>
        <div id="product-grid">
            <div class="txt-heading">Products</div>
            <?php if (!empty($items)) { 
                foreach($items as $key => $item){ ?>
            <div class="product-item">
                <form method="post" action="index.php?action=add&sku=<?php echo $item["sku"]; ?>">
                    <div class="product-image"><img src="<?php echo '' . $item["image"]; ?>"></div>
                    <div class="product-tile-footer">
                    <div class="product-title"><?php echo $item["name"]; ?></div>
                    <div class="product-price"><?php echo "$".$item["unit_price"]; ?></div>
                    <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </div>
                </form>
		    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </BODY>
</HTML>


