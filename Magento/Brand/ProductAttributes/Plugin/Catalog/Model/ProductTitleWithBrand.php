<?php

namespace Brand\ProductAttributes\Plugin\Catalog\Model;

class ProductTitleWithBrand
{
    /**
     * @var \Brand\ProductAttributes\Model\Attribute\Source\Brand
     */
    private $brandList;
    private $object;
    /**
     * Init
     * @param \Brand\ProductAttributes\Model\Attribute\Source\Brand $brandList
     */
    public function __construct(\Brand\ProductAttributes\Model\Attribute\Source\Brand $brandList)
    {
        $this->brandList = $brandList;
        $this->object = $object;
    }
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());

        $brandLable = '';

        foreach ($this->brandList->getAllBrand() as $key => $brand) {
            if ($value == $key) {
                $brandLable = $brand;
            }
        }

        $newBrandName = $brandLable.'- ';
        $prodName = $newBrandName.$result;

        return $prodName; // Adding Apple in product name
    }
}
