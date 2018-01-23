<?php

namespace ThinkOpen\Blog\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Asset\Repository;

/**
 * Shows product name in admin grids instead of product id
 */
class ActiveImage extends Column
{
    /**
     * Escaper
     *
     * @var \Magento\Framework\Escaper
     */
    protected $escaper;

    /**
     * System store
     *
     * @var SystemStore
     */
    protected $systemStore;

    protected $productFactory;

    protected $_assetRepo;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param SystemStore $systemStore
     * @param Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Escaper $escaper,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\View\Asset\Repository $assetRepo,
        array $components = [],
        array $data = []
    )
    {
        $this->productFactory = $productFactory;
        $this->escaper = $escaper;
        $this->_assetRepo = $assetRepo;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            $fieldName = $this->getData('name');

            foreach ($dataSource['data']['items'] as & $item) {

                if(isset($item[$fieldName])){

                    if($item[$fieldName]==1){
                        $url = $this->_assetRepo->getUrl("ThinkOpen_Blog::images/green_tick.png");
                    }else{
                        $url = $this->_assetRepo->getUrl("ThinkOpen_Blog::images/inactive.png");
                    }

                    $item[$fieldName . '_src'] = $url;
                    $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                    $item[$fieldName . '_orig_src'] = $url;

                }

            }
        }

        return $dataSource;
    }
}