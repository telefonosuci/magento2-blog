<?php

namespace ThinkOpen\Blog\Controller\Create;

class Create extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_pageFactory;
    protected $_postFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        $post = $this->_postFactory->create();

        $post->setTitle('Simple Post');

        $post->setDescription('Post Description');
/*

        $post = $this->_objectManager->create('ThinkOpen\Blog\Model\Post');
        $post->setTitle('Simple Post');
        $post->setDescription('Post Description');
        $post->save();
*/


        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}