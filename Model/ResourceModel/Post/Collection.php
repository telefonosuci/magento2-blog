<?php
namespace ThinkOpen\Blog\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'thinkopen_blog_post_collection';
    protected $_eventObject = 'post_collection';

    protected function _construct()
    {
        $this->_init('ThinkOpen\Blog\Model\Post', 'ThinkOpen\Blog\Model\ResourceModel\Post');
    }

}

