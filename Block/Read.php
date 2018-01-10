<?php
namespace ThinkOpen\Blog\Block;

class Read extends \Magento\Framework\View\Element\Template
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
        $post = $this->_postFactory->create();
        
        //$post->getCollection()->addFieldToFilter('id', 2);;
        
		$postData = $post->load(1);
        return $postData;
    }
}
