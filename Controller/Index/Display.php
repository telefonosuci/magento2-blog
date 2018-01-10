<?php

namespace ThinkOpen\Blog\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    //protected $_postFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
        )
    {
        $this->_resultPageFactory = $resultPageFactory;
        //$this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {


        //$post = $this->_objectManager->create('ThinkOpen\Blog\Model\Post');
        //$collection = $post->getCollection();
        
        
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}