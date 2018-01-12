<?php

namespace ThinkOpen\Blog\Controller\Adminhtml\post;
use Magento\Backend\App\Action;
use ThinkOpen\Blog\Model\Post as Post;

class NewAction extends \Magento\Backend\App\Action
{
    /**
     * Edit A Contact Page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $contactDatas = $this->getRequest()->getParam('post');
        if(is_array($contactDatas)) {
            $contact = $this->_objectManager->create(Post::class);
            $contact->setData($contactDatas)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/grid');
        }
    }
}