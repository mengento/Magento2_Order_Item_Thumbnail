<?php

namespace Mengento\Thumbnail\Block\Adminhtml\Items\Column;

use Magento\Sales\Block\Adminhtml\Items\Column\DefaultColumn;

class Thumbnail extends DefaultColumn
{

    public function getItmeProduct()
    {

        $product = $this->getItem()->getProduct();
        if ($product->getTypeId() == \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE) {
                $children = current($this->getItem()->getChildrenItems());
                $childrenproduct = $children->getProduct();
		if($childrenproduct->getImage()){
		       return $childrenproduct;
		}
            }
        return $product;
    }
    public function getItmeProductThumbnailUrl()
    {

	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
	$thumbnailHelper = $objectManager->get('Magento\Catalog\Helper\Image');
	$thumbnail = $thumbnailHelper->init($this->getItmeProduct(), 'thumbnail')
				->constrainOnly(true)
				->keepAspectRatio(true)
				->keepFrame(false)
				->setImageFile($this->getItmeProduct()->getImage())
				->resize('160','160')
				->getUrl();

        return $thumbnail;
    }

 }
