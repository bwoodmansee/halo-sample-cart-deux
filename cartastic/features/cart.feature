Feature: A sample e-commerce shopping cart that is similar to what NordstromRack.com | HauteLook uses in production.

Scenario: Add a product to the cart, then add the same product again
  Given I have an empty cart
  And There exists a product with id "shirt" and available quantity "10"
  When I try to add product "shirt" with quantity "1" to the cart
  And I try to add product "shirt" with quantity "3" to the cart
  Then I should have "1" products in my cart with a total quantity of "4"
  And Product "shirt" should have available quantity "6"

Scenario: Add a product to the cart, then add a different product
  Given I have an empty cart
  And There exists a product with id "shirt" and available quantity "10"
  And There exists a product with id "pants" and available quantity "3"
  When I try to add product "shirt" with quantity "7" to the cart
  And I try to add product "pants" with quantity "3" to the cart
  Then I should have "2" products in my cart with a total quantity of "10"
  And Product "shirt" should have available quantity "3"
  And Product "pants" should have available quantity "0"

Scenario: Add product to cart where not all of the requested quantity is available
  Given I have an empty cart
  And There exists a product with id "dress" and available quantity "7"
  When I try to add product "dress" with quantity "10" to the cart
  Then I should have "1" products in my cart with a total quantity of "7"
  And Product "dress" should have available quantity "0"

  Scenario: Add product to cart, and re-add where not all of the requested quantity is available
    Given I have an empty cart
    And There exists a product with id "pants" and available quantity "6"
    When I try to add product "pants" with quantity "5" to the cart
    And I try to add product "pants" with quantity "2" to the cart
    Then I should have "1" products in my cart with a total quantity of "6"
    And Product "pants" should have available quantity "0"

Scenario: Add a product to the cart, then add a different product
  Given I have an empty cart
  And There exists a product with id "shirt" and available quantity "10"
  And There exists a product with id "pants" and available quantity "6"
  When I try to add product "shirt" with quantity "7" to the cart
  And  I try to add product "pants" with quantity "1" to the cart
  And I try to update the quantity in cart for product "shirt" to be quantity "3"
  Then I should have "2" products in my cart with a total quantity of "4"
  And Product "shirt" should have available quantity "7"
  And Product "pants" should have available quantity "5"
