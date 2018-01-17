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
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory)
    {
        $this->_fileSystem = $fileSystem;
        $this->_uploaderFactory = $uploaderFactory;

        parent::__construct($context);
    }
    
    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $postData = $this->getRequest()->getParam('post');
        
        if(is_array($postData)) {
            
            $id = $this->getRequest()->getParam('id');

            if($id){
                $post = $this->_objectManager->create(Post::class)->load($id);
            }else{
                $post = $this->_objectManager->create(Post::class);
            }
            
            $post->setData($postData);
            
            if(!$id){
                $creationDate = date("Y-m-d H:i:s");
                $post->setCreationdate($creationDate);
            }

            $lasEditDate = date("Y-m-d H:i:s");
            $post->setLasteditdate($lasEditDate);
            
            try{

                $uploader = $this->_uploaderFactory->create(['fileId' => 'post[image]'])
                ->setAllowedExtensions(['jpg', 'jpeg'])
                ->setAllowCreateFolders(true);

                $destinationPath = $this->getDestinationPath();
                $uploadResult = $uploader->save($destinationPath);

                $post->setImage("/pub/media/images/".$uploadResult['file']);

            }catch(\Exception $e){
                
            }
            
            $post->save();

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