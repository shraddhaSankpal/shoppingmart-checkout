<?php
require_once("cart.php");
use PHPUnit\Framework\TestCase;

class Checkout extends TestCase{
    public function test_the_price_is_discounted_multiple_times_when_ordering_seven_times_a(){
        $cart = new cart();

        $this->assertEquals(4, count($cart->getProducts()), 'Product total does not equal expected value of 4');
    }
}
?>