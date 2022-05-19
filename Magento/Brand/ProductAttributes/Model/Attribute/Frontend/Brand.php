<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-06-30 14:34:34
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-06-30 14:35:03
 * @website: http://giaphugroup.com
 */

namespace Brand\ProductAttributes\Model\Attribute\Frontend;

class Brand extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    /**
     * @var \Brand\ProductAttributes\Model\Attribute\Source\Brand
     */
    private $brandList;

    /**
     * Init
     * @param \Brand\ProductAttributes\Model\Attribute\Source\Brand $brandList
     */
    public function __construct(\Brand\ProductAttributes\Model\Attribute\Source\Brand $brandList)
    {
        $this->brandList = $brandList;
    }

    public function getValue(\Magento\Framework\DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());

        $brandLable = '';

        foreach ($this->brandList->getAllBrand() as $key => $brand) {
            if ($value == $key) {
                $brandLable = $brand;
            }
        }

        return "<b>$brandLable</b>";
    }
}
