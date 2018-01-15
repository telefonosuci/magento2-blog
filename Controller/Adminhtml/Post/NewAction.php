<?php

namespace ThinkOpen\Blog\Controller\Adminhtml\Post;
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
            
            $post = $this->_objectManager->create(Post::class);
            
            $creationDate = date("Y-m-d H:i:s");
            $post->setCreationDate($creationDate);
            $post->setData($contactDatas)->save();

            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/grid');
        }
    }
}