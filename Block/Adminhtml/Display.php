<?php
namespace ThinkOpen\Blog\Block\Adminhtml;

class Display extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Core\Helper\Data $helper
     */
    //protected $helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \ThinkOpen\Blog\Model\PostFactory $postFactory
        //\Magento\Core\Helper\Data $helper
        )
    {
        $this->_postFactory = $postFactory;
        //$this->helper = $helper;
        parent::__construct($context);
    }
    
    public function getPostCollection()
    {
        $post = $this->_postFactory->create();
		$collection = $post->getCollection();

        return $collection;
        
    }

    public function getEditURL($postID){
        //$url = Mage::helper("adminhtml")->getUrl("ThinkOpen_Blog/post/edit/idpost/*", $postID);
        //$url = $this->helper->getUrl("ThinkOpen_Blog/post/edit/idpost/*", $postID);
        return "pippo";
    }

}