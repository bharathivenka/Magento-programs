<?php

namespace Task\Feedback\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Task\Feedback\Model\ResourceModel\Feedback\CollectionFactory;

class DataProvider extends AbstractDataProvider
{

    /** @var array */
    protected $_loadedData;


    /** @var \Task\Feedback\Model\ResourceModel\Feedback\Collection */
    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $feedbackCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $feedbackCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $feedbackCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /** @return array */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $data = $item->getData();
            switch ($data['status']) {
                case null:
                    $data['status'] = 'Pending';
                    break;
                case true:
                    $data['status'] = 'Accepted';
                    break;
                case false:
                    $data['status'] = 'Declined';
                    break;
            }

            $this->_loadedData[$item->getId()] = $data;
        }
        return $this->_loadedData;
    }
}
