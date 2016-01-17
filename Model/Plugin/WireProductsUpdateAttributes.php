<?php

namespace TheBigSurf\WireProductsHook\Model\Plugin;

use Magento\Catalog\Model\Product\Action\Interceptor;
use TheBigSurf\WireProductsHook\Controller\WireProductsUpdate;

class WireProductsUpdateAttributes extends WireProductsUpdate
{

    /**
     * Object Manager instance
     * @var \Magento\Framework\App\ObjectManager::getInstance()
     */
    protected $_objectManager;


    public function __construct(
        \TheBigSurf\WireProductsHook\Logger\Logger $logger,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {

        $this->_logger = $logger;

        $this->_messageManager = $messageManager;

        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();

    }


    /**
     * @param Interceptor $interceptor
     * @param \Closure $closure
     * @param $productIds
     * @param $attrData
     * @param $storeId
     * @return Interceptor
     */
    public function aroundUpdateAttributes(
        Interceptor $interceptor,
        \Closure $closure,
        $productIds,
        $attrData,
        $storeId
    ) {

        // execute the original method and remember the result;
        $result = $closure($productIds, $attrData, $storeId);


        foreach ($productIds as $key => $prodID) :

            // get the product object
            $_product = $this->_objectManager->get('Magento\Catalog\Model\Product')->load( $prodID );

            // pass the SKU to Processwire
            $this->updateWireProduct( $_product, 'Bulk Update' );

        endforeach;


        // do something with $productIds here
        return $result;

    }

}