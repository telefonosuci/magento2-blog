<?php
 
namespace ThinkOpen\Blog\Controller\Adminhtml\File;
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Upload extends \Magento\Framework\App\Action\Action
{
    
    protected $_filesystem;
    protected $_uploaderFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
    ) {
        $this->_fileSystem = $fileSystem;
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
        try {


            $file = $_FILES['bar'];
            $uploader = $this->_uploaderFactory->create(['fileId' => 'bar']);
            
            $uploader->setAllowedExtensions(['jpg', 'jpeg']);
            $uploader->setAllowCreateFolders(true);
            $uploader->setAllowRenameFiles(true);

            $uploadResult = $uploader->save($destinationPath);

            if (!$uploadResult) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }else{
            
                return "/pub/media/".$uploadResult['file'];
            
            }
            
        }catch (Exception $e){


            $this->messageManager->addError(
                __($e->getMessage())
            );
        
        }

        //$post->setImage("/pub/media/".$uploadResult['file']);


        
    }

    public function getDestinationPath()
    {
        return $this->_fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('/images');
    }

    public function validateFile($filePath)
    {
        // @todo
        // your custom validation code here
    }
   
}

