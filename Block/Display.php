<?php
namespace ThinkOpen\Blog\Block;

class Display extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }


    public function getBlogText()
    {
        return __('Here is your blog!');
    }
}