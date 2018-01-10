<?php

namespace ThinkOpen\Blog\Controller\Create;


class Save extends \Magento\Framework\App\Action\Action
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
        //$postData = $this->getRequest()->getPostValue();
        $idPost = $this->getRequest()->getParam('idpost');

        $title = $this->getRequest()->getParam('title');
        $description = $this->getRequest()->getParam('description');
        $tags = $this->getRequest()->getParam('tags');

        $post = $this->_objectManager->create('ThinkOpen\Blog\Model\Post');

        if($idPost!=""){
            $post->load($idPost);
        }else{
            $post = $this->_objectManager->create('ThinkOpen\Blog\Model\Post');
        }

        $post->setTitle($title);
        $post->setDescription($description);

        $post->save();

        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}