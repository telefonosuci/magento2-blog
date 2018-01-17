<?php
namespace ThinkOpen\Blog\Block;

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
		$collection = $post->getCollection()->addFieldToFilter(
            array('isactive'),
            array(
                array('like'=>1)
            )
        );

        return $collection;
        
    }
}