<?php

declare(strict_types=1);

namespace Guidance\Tests\Project\Test\Project;

class DemoCest extends \Guidance\Tests\Project\Test\BaseAbstract
{
    // ########################################

    protected function processStateAndPreconditions(): void
    {
        /**
         * ========================================
         *               EXAMPLE USE
         * ========================================
         */

        // ========================================Data registry

        $city1 = $this->dataGenerator->getCity();
        $city2 = $this->dataGenerator->getCity();

        $email         = $this->dataGenerator->getEmail();
        $country       = $this->dataGenerator->getCountry();
        $streetAddress = $this->dataGenerator->getStreetAddress();

        // ========================================Data provider

        $testIndividualData = $this->dataSetProviderIndividual->getData('/city_chic/PDP/id/');
        $testIndividualFile = $this->dataSetProviderIndividual->getFile('guid.png');

        $testGeneralData = $this->dataSetProviderGeneral->getData('/browser/chrome/extension/store/');
        $testGeneralFile = $this->dataSetProviderGeneral->getFile('/browser/chrome/extension/watermark.png');
    }

    // ########################################


    public function _PopCultcha(\Guidance\Tests\Project\Actor $I)
    {

        $I->amOnUrl('https://www.popcultcha.com.au/');
        $I->wait(2);
        $I->maximizeWindow();
        $I->wait(2);
        $I->see('shipping');
        $I->wait(3);
        // Get rid of uses cookies
        $I->click(['css' => '.cc-btn']);
        $I->wait(5);

        // ****************************
        // Sign In
        //  *******************************

        //$I->click(['css' => 'body > div.cc-window.cc-floating.cc-type-default.cc-theme-edgeless.cc-bottom.cc-left.cc-color-override-2042708126 > div > a']);
        //$I->wait(3);

        /**
        $I->amOnPage('/customer/account/');
        $I->fillField(['css' => 'fieldset.fieldset:nth-child(2) > div:nth-child(1) > div:nth-child(2) > input:nth-child(1)'], 'wayne.hazle@guidance.com');
        $I->wait(1);
        $I->fillField(['css' => 'fieldset.fieldset:nth-child(2) > div:nth-child(2) > div:nth-child(2) > input:nth-child(1)'], '@Jwjw5050');
        $I->wait(3);
        $I->click(['css' => '.recaptcha-checkbox-border']);
        $I->wait(4);
        $I->click(['css' => 'button.login > span:nth-child(1)']);
        $I->wait(4);
        */


        // *****************************************************************************
        //  GO TO PLP - Editor's Pick & Test Sorting
        // ***********************************************************
        // 2. Go to Simple SHOP ALL PLP page----------------------------------------------------------------------------
        $I->amOnPage('/statues-and-replicas/statues-and-replicas/shop-all.html');
        $I->see('shipping');
        $I->wait(4);
        //Click in Anovos checkbox
      //  $I->click(['xpath' => '/html/body/div[3]/main/div/div[2]/div/div[2]/div[2]/div[2]/div[2]/form/ol/li[3]/a/input']);
        //$I->wait(4);
        // Clear Filter
       // $I->click(['css' => '.toolbar-filters > div:nth-child(1) > ol:nth-child(2) > li:nth-child(1) > a:nth-child(1) > span:nth-child(1) > span:nth-child(1)']);
       //   $I->wait(4);
       // $I->click(['css' => '']);


        // Use Sorter
        $I->click(['id' => 'sorter']);
        $I->wait(1);
        $I->click(['css' => '#sorter > option:nth-child(3)']);
        $I->wait(5);


        // *****************************************************************************
        //  Go to a PDP and Add to Cart
        // ***********************************************************
        $I->amOnPage('/batman-batgirl-adult-costume.html');
        $I->see('batman');
        //  Choose Medium
        $I->wait(2);
        $I->click(['css' => '#option-label-tee_size-302-item-13102']);
        //  Change QTY
        $I->wait(2);
        $I->click(['css' => 'button.qty-button:nth-child(3)']);

        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button-clone > span:nth-child(1)']);
        //$I->waitForText('Added to cart!');
        $I->wait(5);


        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->wait(5);
        $I->see('Cart');

    }


    public function _ShopCosmopolitan(\Guidance\Tests\Project\Actor $I)
    {
        $I->amOnUrl('https://shop.cosmopolitan.com/');
        $I->waitForPageLoad();
        $I->waitForText('Cosmopolitan', 30); // secs
        $I->see('Cosmopolitan');

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        $I->wait(12);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search returned no results.');

        // Valid Entry
        $I->click(['css' => '.search__btn']);
        $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');



        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER); // Press Enter Key



        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/');
        $I->wait(7);
        // Click Add to Cart
        $I->click(['css' => '.product-info-main #product-addtocart-button']);
        $I->waitForElement(['css' => '.modal-popup._show']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->click(['css' => '.cart-overview [data-role="closeBtn"]']);
        $I->waitForElementNotVisible(['css' => '.modal-popup._show']);

        // You added ... to your shopping cart.
        $I->waitForText('You added Cosmopolitan Magazine to your shopping cart.');

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart');
        $I->wait(6);
        $I->see('Subscription');
    }



    public function ShopWomensHeathMag(\Guidance\Tests\Project\Actor $I)
    {

        $I->amOnUrl('https://shop.womenshealthmag.com/');
        $I->see('Magazine');
        $I->wait(5);

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        $I->wait(2);
        // $I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        // $I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search returned no results.');

        // Valid Entry
        $I->click(['css' => '.search__btn']);
        $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');

        // $I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        // $I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);
        $I->wait(2);
        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER); // Press Enter Key

        //$foundProductsCount = $I->executeJS('return document.querySelectorAll(\'ol.product-items li\').length;');
        //$I->assertGreaterOrEquals(3, $foundProductsCount);

        // *****************************************************************************
        //  GO TO PLP - Editor's Pick & Test Sorting
        // ***********************************************************
        // 2. Go to Simple SHOP ALL PLP page----------------------------------------------------------------------------
        $I->amOnPage('/editors-picks.html');
        $I->see('Keto');
        $I->wait(2);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'name');
        $I->wait(5);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'price');
        $I->wait(5);


        // *****************************************************************************
        //  Go to a PDP and Add to Cart
        // ***********************************************************
        $I->amOnPage('/keto-for-carb-lovers.html');
        $I->see('Keto');


        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->wait(5);
        $I->see('Cart');

    }

    public function _ShopPrevention(\Guidance\Tests\Project\Actor $I)
    {
        $I->amOnUrl('https://shop.prevention.com/');
        $I->waitForPageLoad();
        $I->see('Editor');

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search returned no results.');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);

        $foundProductsCount = $I->executeJS('return document.querySelectorAll(\'ol.product-items li\').length;');
        $I->assertGreaterOrEquals(3, $foundProductsCount);

        // *****************************************************************************
        //  Go to PLP & Test Sorting
        // ***********************************************************

        // 2. Go to SHOP ALL PLP page and choose sorting drop downs
        $I->amOnPage('/shop-all.html');
        $I->wait(2);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'name');
        $I->wait(5);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'price');
        $I->wait(5);

        // *****************************************************************************
        //  go to PDP and Add to Cart
        // ***********************************************************

        // 2. Go to Simple SHOP ALL PDP page
        $I->amOnPage('/keto-for-carb-lovers.html');
        $I->see('Keto');

        // Click Add to Cart
        $I->click(['css' => '.product-info-main #product-addtocart-button']);
        $I->waitForElement(['css' => '.modal-popup._show']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->click(['css' => '.cart-overview [data-role="closeBtn"]']);
        $I->waitForElementNotVisible(['css' => '.modal-popup._show']);

        // You added ... to your shopping cart.
        $I->waitForText('You added Keto for Carb Lovers: 21-Day Plan for Losing Weight and Eating Foods You\'ll Love to your shopping cart.');

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');
    }

    // **********************************

    public function _ShopElle(\Guidance\Tests\Project\Actor $I)
    {


        $I->amOnUrl('https://shop.elle.com');
        $I->reloadPage();
        $I->see('Elle');
        $I->wait(2);

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
       // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);
        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');

    }

    public function _ShopMarieClaire(\Guidance\Tests\Project\Actor $I)
    {


        $I->amOnUrl('https://shop.marieclaire.com/');
        $I->see('Marie');
        // Search, Add magazine on front page to cart,  go to checkout
        $I->wait(2);

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);

        $I->wait(5);
        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');


    }

    public function _ShopMensHealth(\Guidance\Tests\Project\Actor $I)
    {


        $I->amOnUrl('https://shop.menshealth.com/');
        $I->see('Editor');
        // Search, Add magazine on front page to cart,  go to checkout

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);

        // *****************************************************************************
        //  Go to PLP & Test Sorting
        // ***********************************************************

        // 2. Go to SHOP ALL PLP page and choose sorting drop downs
        $I->amOnPage('/editors-picks.html');
        $I->wait(2);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'name');
        $I->wait(5);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'price');
        $I->wait(5);

        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/all-out-hiit.html');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');


    }

    public function _ShopEsquire(\Guidance\Tests\Project\Actor $I)
    {


        $I->amOnUrl('https://shop.esquire.com/');
        $I->see('Esquire');
        $I->wait(5);

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);

        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');

    }


    public function _ShopVeranda(\Guidance\Tests\Project\Actor $I)
    {


        $I->amOnUrl('https://shop.veranda.com/veranda-magazine.html');
        $I->see('Veranda');
        $I->wait(5);

        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);

        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');


    }

    public function _ShopTownandCountry(\Guidance\Tests\Project\Actor $I)
    {


        $I->amOnUrl('https://shop.townandcountrymag.com');
        $I->see('Town');
        $I->wait(5);
        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);

        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');
    }

    public function _ShopHarpersBazaar(\Guidance\Tests\Project\Actor $I)
    {

        $I->amOnUrl('https://store.harpersbazaar.com');
        $I->see('BAZAAR');
        $I->wait(5);
        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);

        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');

    }

    public function _ShopWomansDay(\Guidance\Tests\Project\Actor $I)
    {

        $I->amOnUrl('https://shop.womansday.com');
        $I->see('Woman');
        $I->wait(5);
        // ******************************************
        // Search Valid and Invalid
        // ***************************

        // Invalid Entry

        $I->click(['css' => '.search__btn']);
        // $I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'XXX');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->see('No Result');

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->see('Your search');

        // Valid Entry

        $I->click(['css' => '.search__btn']);
        //$I->waitForElement(['css' => '.search__block--active']);

        $I->fillField(['id' => 'search'], 'Magazine');
        //$I->waitForElementVisible(['id' => 'searchsuite-autocomplete'], 20);
        //$I->seeElement(['css' => '#searchsuite-autocomplete .product']);

        //$ajaxFoundProductsCount = $I->executeJS('return document.querySelectorAll(\'#product li\').length;');
        //$I->assertGreaterOrEquals(3, $ajaxFoundProductsCount);

        $I->pressKey(['id' => 'search'],\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->wait(5);

        // *****************************************************************************
        //  Go to PLP & Test Sorting
        // ***********************************************************

        // 2. Go to SHOP ALL PLP page and choose sorting drop downs
        $I->amOnPage('/editors-picks.html');
        $I->wait(2);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'name');
        $I->wait(5);
        $I->selectOption(['css' => '#authenticationPopup + .toolbar #sorter'], 'price');
        $I->wait(5);

        // *****************************************************************************
        //  Add to Cart
        // ***********************************************************

        $I->amOnPage('/womans-day-favorite-chicken-recipes.html');
        // Click Add to Cart
        $I->see('Add to Cart');
        $I->click(['css' => '#product-addtocart-button > span:nth-child(1)']);
        $I->waitForText('Added to cart!');

        // Continue Shopping
        $I->wait(5);
        $I->click(['css' => 'a.action:nth-child(5)']);
        // You added ... to your shopping cart.
        $I->waitForText('added');
        $I->wait(5);

        // *****************************************************************************
        //  Go to Shopping Cart
        // ***********************************************************
        $I->amOnPage('/checkout/cart/');
        $I->see('Cart');


    }

    public function _ShopPioneerWoman(\Guidance\Tests\Project\Actor $I)
    {
        // No content Except friont opage
        $I->amOnUrl('https://subscribe.hearstmags.com/subscribe/splits/pioneerwomanmag/pnw_splash');
        $I->see('Subscribe');

    }

    public function _ShopHouseBeautiful(\Guidance\Tests\Project\Actor $I)
    {
        // No content Except friont opage
        $I->amOnUrl('https://subscribe.hearstmags.com/subscribe/splits/pioneerwomanmag/pnw_splash');
        $I->see('Subscribe');

    }

    public function _GoodHousekeeping(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front opage
        $I->amOnUrl('https://www.goodhousekeeping.com/');
        $I->see('Subscribe');

    }

    public function _CountryLiving(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.countryliving.com/');
        $I->see('Subscribe');

    }

    public function _EllecDecor(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.elledecor.com/');
        $I->see('Sign');

    }


    public function _TownandCountry(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.townandcountrymag.com/');
        $I->see('Sign');

    }


    public function _RoadandTrack(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.roadandtrack.com/');
        $I->see('Sign');

    }


    public function _PopularMechanics(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.popularmechanics.com/');
        $I->see('Sign');

    }

    public function _Bicycling(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.bicycling.com/');
        $I->see('Sign');

    }

    public function _CarandDriver(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.caranddriver.com/');
        $I->see('Sign');

    }


    public function _RunnersWorld(\Guidance\Tests\Project\Actor $I)
    {
        // No content just front page
        $I->amOnUrl('https://www.runnersworld.com/');
        $I->see('Sign');

    }
    // ########################################
}