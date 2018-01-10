<?php
namespace ThinkOpen\Blog\Block;

class Edit extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \ThinkOpen\Blog\Model\PostFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }


    public function getPostData()
    {
        $params = $this->getRequest()->getParams();
        $id = $this->getRequest()->getParam('idpost');
        $post = $this->_postFactory->create();
        
		$postData = $post->load($id);
        return $postData;
    }
}
