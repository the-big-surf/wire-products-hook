<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TheBigSurf\WireProductsHook\Observer;

use Magento\Framework\Event\ObserverInterface;
use TheBigSurf\WireProductsHook\Controller\WireProductsUpdate;

class WireProductsSaveAfter extends WireProductsUpdate implements ObserverInterface
{

    public function execute( \Magento\Framework\Event\Observer $observer ) {

        // get the product object
        $_product = $observer->getProduct();

        // pass the SKU to Processwire
        $this->updateWireProduct( $_product, 'On Save' );

    }

}