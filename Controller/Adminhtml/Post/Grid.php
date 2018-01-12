<?php

namespace ThinkOpen\Blog\Controller\Adminhtml\Post;

class Grid extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		
		$this->resultPageFactory = $resultPageFactory;
		
		parent::__construct($context);

	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Posts Grid')));

		return $resultPage;
	}


}