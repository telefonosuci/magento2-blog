<?php

namespace ThinkOpen\Blog\Controller\Adminhtml\Post;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_pageFactory;
    protected $_postFactory;

    protected $_fileSystem;
    protected $_uploaderFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory)
    {

        $this->_resultPageFactory = $resultPageFactory;
        $this->_fileSystem = $fileSystem;
        $this->_uploaderFactory = $uploaderFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        //$postData = $this->getRequest()->getPostValue();
        $idPost = $this->getRequest()->getParam('idpost');

        $title = $this->getRequest()->getParam('title');
        $description = $this->getRequest()->getParam('description');
        $tags = $this->getRequest()->getParam('tags');
        $body = $this->getRequest()->getParam('body');
        //$creationDate = date('Y-m-d H:i:s');
        $tagsArray = array_unique(array_map("trim", explode(",", $tags)));
        $tagsJson = json_encode($tagsArray);
        
        
        $destinationPath = $this->getDestinationPath();

        $uploader = $this->_uploaderFactory->create(['fileId' => 'postimage'])
        ->setAllowedExtensions(['jpg', 'jpeg'])
        ->setAllowCreateFolders(true);

        $uploadResult = $uploader->save($destinationPath);

        $post = $this->_objectManager->create('ThinkOpen\Blog\Model\Post');

        if($idPost!=""){
            $post->load($idPost);
        }else{
            $post = $this->_objectManager->create('ThinkOpen\Blog\Model\Post');
        }

        $post->setImage("/pub/media/".$uploadResult['file']);

        $post->setTitle($title);
        $post->setDescription($description);
        //$post->setCreationdate($creationDate);
        $post->setTags($tagsJson);
        $post->setBody($body);
        
        $post->save();

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('blog_admin/post/index');

        return $resultRedirect;
        
        //$resultPage = $this->_resultPageFactory->create();
        //return $resultPage;

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