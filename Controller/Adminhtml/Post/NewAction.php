<?php

namespace ThinkOpen\Blog\Controller\Adminhtml\Post;
use Magento\Backend\App\Action;
use ThinkOpen\Blog\Model\Post as Post;
use Magento\Framework\App\Filesystem\DirectoryList;

class NewAction extends \Magento\Backend\App\Action
{
    protected $_fileSystem;
    protected $_uploaderFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory)
    {
        $this->_fileSystem = $fileSystem;
        $this->_uploaderFactory = $uploaderFactory;

        parent::__construct($context);
    }
    
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

        $postData = $this->getRequest()->getParam('post');
        
        if(is_array($postData)) {
            
            $post = $this->_objectManager->create(Post::class);
            
            $creationDate = date("Y-m-d H:i:s");
            
            $post->setCreationdate($creationDate);

            $uploader = $this->_uploaderFactory->create(['fileId' => 'postimage'])
            ->setAllowedExtensions(['jpg', 'jpeg'])
            ->setAllowCreateFolders(true);
    
            $uploadResult = $uploader->save($destinationPath);

            $post->setImage("/pub/media/".$uploadResult['file']);

            $post->setData($postData)->save();

            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/grid');
        }
    }

    public function validateFile($filePath)
    {
        // @todo
        // your custom validation code here
    }

    public function getDestinationPath()
    {
        return $this->_fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('/images');
    }
}