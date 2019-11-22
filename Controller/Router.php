<?php
namespace Lof\ProductTags\Controller;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface;
class Router implements \Magento\Framework\App\RouterInterface
{
   protected $actionFactory;
   protected $helperData;
   protected $_response;
   protected $dispatched;
   /**
     * Event manager
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

   public function __construct(
       \Magento\Framework\App\ActionFactory $actionFactory,
       \Magento\Framework\App\ResponseInterface $response,
       \Lof\ProductTags\Helper\Data $helperData,
       ManagerInterface $eventManager
   ) {
       $this->actionFactory = $actionFactory;
       $this->helperData = $helperData;
       $this->_response = $response;
       $this->eventManager = $eventManager;
   }
   public function match(\Magento\Framework\App\RequestInterface $request)
   {
       die("Awetae");
        if (!$this->dispatched) {
            
            $identifier = trim($request->getPathInfo(), '/');
            $origUrlKey = $identifier;
            $condition = new DataObject(['url_key' => $identifier, 'continue' => true]);
            $this->eventManager->dispatch(
                'lof_producttags_controller_router_match_before',
                ['router' => $this, 'condition' => $condition]
                );

            $urlKey = $condition->getUrlKey();
            if ($condition->getRedirectUrl()) {
                $this->response->setRedirect($condition->getRedirectUrl());
                $request->setDispatched(true);
                return $this->actionFactory->create(
                    'Magento\Framework\App\Action\Redirect',
                    ['request' => $request]
                    );
            }
            if (!$condition->getContinue()) {
                return null;
            }
            if($this->helperData->getGeneralConfig('enabled') == 1){
                $url_prefix = $this->helperData->getGeneralConfig('route');
               
                if($url_prefix){
                    if(strpos($identifier, $url_prefix) !== false) {

                        $identifiers = explode('/',$identifier);
                        if(count($identifiers) == 2 && $identifiers[0] == $url_prefix && $identifiers[1]){
                            $tagCode = $identifiers[1];
                            $request->setModuleName('lofproducttags')//module name
                                ->setControllerName('tag') //controller name
                                ->setActionName('view') //action name
                                ->setParam('tag_code',$tagCode); //action name
                            
                            $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
                            $request->setDispatched(true);
                            $this->dispatched = true;
                            return $this->actionFactory->create(
                                'Magento\Framework\App\Action\Forward',
                                ['request' => $request]
                            );
                        }
                    
                    }
                    
                }
            }
            $request->setDispatched(true);
            $this->dispatched = true;
            return $this->actionFactory->create(
                'Magento\Framework\App\Action\Forward',
                ['request' => $request]
                );
        }
   }
} 