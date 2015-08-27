<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as Assert;
use Hautelook\Cart;
use Hautelook\Product;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->products = [];
        $this->cart = new Cart();
    }

    /**
     * @Given /^I have an empty cart$/
     */
    public function iHaveAnEmptyCart()
    {
        $this->cart = new Cart();
    }

    /**
     * @Given /^There exists a product with id "([^"]*)" and available quantity "([^"]*)"$/
     */
    public function createProductWithQuantity($productId, $availableQuantity)
    {
        $this->products[$productId] = new Product($productId, $availableQuantity);
    }

    /**
     * @When /^I try to add product "([^"]*)" with quantity "([^"]*)" to the cart$/
     */
    public function iAddProductWithQuantityToTheCart($productId, $quantity)
    {
       $this->cart->addItem($this->products[$productId], $quantity);
    }

    /**
     * @Then /^I should have "([^"]*)" products in my cart with a total quantity of "([^"]*)"$/
     */
    public function cartProductQuantityCheck($productCount, $totalQuantity)
    {
        Assert::assertEquals(
            $productCount,
            $this->cart->getCartItemsCount()
        );
        Assert::assertEquals(
            $totalQuantity,
            $this->cart->getTotalQuantityInCart()
        );
    }

    /**
     * @Given /^I try to update the quantity in cart for product "([^"]*)" to be quantity "([^"]*)"$/
     */
    public function iTryToUpdateTheQuantityInCartForProductToBeQuantity($productId, $quantity)
    {
        $this->cart->updateItem($this->products[$productId], $quantity);
    }

    /**
     * @Then /^Product "([^"]*)" should have available quantity "([^"]*)"$/
     */
    public function productShouldHaveAvailableQuantity($productId, $availableQuantity)
    {
        Assert::assertEquals(
            $availableQuantity,
            $this->products[$productId]->getQuantity()
        );
    }
}
