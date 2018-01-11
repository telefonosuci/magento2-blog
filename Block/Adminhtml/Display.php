<?php
namespace ThinkOpen\Blog\Block\Adminhtml;

class Display extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \ThinkOpen\Blog\Model\PostFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }
    
    public function getPostCollection()
    {
        $post = $this->_postFactory->create();
		$collection = $post->getCollection();

        return $collection;
        
    }
}