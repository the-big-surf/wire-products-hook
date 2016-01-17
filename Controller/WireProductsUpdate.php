<?php

namespace TheBigSurf\WireProductsHook\Controller;

class WireProductsUpdate
{

    /**
     * Logging instance
     * @var \TheBigSurf\WireProductsHook\Logger\Logger
     */
    protected $_logger;


    /**
     * Message Manager interface
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $_messageManager;


    public function __construct(
        \TheBigSurf\WireProductsHook\Logger\Logger $logger,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {

        $this->_logger = $logger;

        $this->_messageManager = $messageManager;

    }

    protected function getSKU( $_product ) {

        if ( ! $_product )
        {

            $this->_logger->error( 'No product set to retrieve SKU' );

            return null;

        }

        // get the sku
        $_sku = $_product->getSku();

        if ( ! $_sku )
        {

            $this->_logger->error( 'Product SKU not set correctly' );

            return null;

        }

        return $_sku;

    }

    protected function updateWireProduct( $_product, $actionName = '' ) {

    	// get the products SKU
    	$_sku = $this->getSKU( $_product );

    	if ( $_sku )
    	{
    		if ( $actionName )

    			$actionName = $actionName . ' - ';

	        $message = $actionName . "syncing product with Processwire - sku: " . $_sku;

	        $this->_messageManager->addSuccess( $message );

	        $this->_logger->info( $message );

	    }

    }

}