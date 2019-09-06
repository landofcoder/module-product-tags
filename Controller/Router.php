<?php
namespace Lof\ProductTags\Controller;
class Router implements \Magento\Framework\App\RouterInterface
{
   protected $actionFactory;
   protected $helperData;
   protected $_response;
   public function __construct(
       \Magento\Framework\App\ActionFactory $actionFactory,
       \Magento\Framework\App\ResponseInterface $response,
       \Lof\ProductTags\Helper\Data $helperData
   ) {
       $this->actionFactory = $actionFactory;
       $this->helperData = $helperData;
       $this->_response = $response;
   }
   public function match(\Magento\Framework\App\RequestInterface $request)
   {
        $identifier = trim($request->getPathInfo(), '/');
        if($this->helperData->getGeneralConfig('enable') == 1){
            $url = $this->helperData->getGeneralConfig('route');
            if($url){
                if(strpos($identifier, $url) !== false) {
                $request->setModuleName('lofproducttags')-> //module name
                setControllerName('tag')-> //controller name
                setActionName('view'); //action name
                }
                
            }
        }
        else {
            return false;
        }
        
       return $this->actionFactory->create(
           'Magento\Framework\App\Action\Forward',
           ['request' => $request]
       );
   }
} 