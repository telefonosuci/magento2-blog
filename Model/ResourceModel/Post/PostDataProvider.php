<?php

namespace ThinkOpen\Blog\Model\ResourceModel\Post;

use ThinkOpen\Blog\Model\ResourceModel\Post\CollectionFactory;
use ThinkOpen\Blog\Model\Post;

class PostDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $postCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }



    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @var Post $post */
        foreach ($items as $post) {
            // our fieldset is called "contact" or this table so that magento can find its datas:
            $this->loadedData[$post->getId()]['post'] = $post->getData();
        }

        return $this->loadedData;

    }



}