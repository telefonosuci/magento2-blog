<?php

namespace ThinkOpen\Blog\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'thinkopen_blog_post';

    protected $_cacheTag = 'thinkopen_blog_post';

    protected $_eventPrefix = 'thinkopen_blog_post';

    protected function _construct()
    {
        $this->_init('ThinkOpen\Blog\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
