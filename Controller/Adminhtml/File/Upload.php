<?php
 
namespace ThinkOpen\Blog\Controller\Adminhtml\File;
 
class Upload extends \Magento\Framework\App\Action\Action
{
    
    protected $_filesystem;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
    ) {
        $this->_filesystem = $fileSystem;
        $this->_uploaderFactory = $uploaderFactory;
        parent::__construct($context);
    }
    
    /**
     * Upload and save image
     */
    public function execute()
    {

        /*
        $result = array();
        if ($_FILES['image']['name']) {
            try {
                // init uploader model.
                $uploader = $this->_objectManager->create(
                    'Magento\MediaStorage\Model\File\Uploader',
                    ['fileId' => 'test_image']
                );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                // get media directory
                $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
                // save the image to media directory
                $result = $uploader->save($mediaDirectory->getAbsolutePath());
            } catch (Exception $e) {
                \Zend_Debug::dump($e->getMessage());
            }
        }
        return $result;
*/


        $destinationPath = $this->getDestinationPath();

        $uploader = $this->_uploaderFactory->create(['fileId' => 'image'])
        ->setAllowedExtensions(['jpg', 'jpeg'])
        ->setAllowCreateFolders(true)
        ->setAllowedExtensions(['jpg', 'jpeg']);

        $uploadResult = $uploader->save($destinationPath);

        return "/pub/media/".$uploadResult['file'];
        //$post->setImage("/pub/media/".$uploadResult['file']);


        
    }
   
}

