<?php


namespace DeclarativeSchema\Example\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class Addcolumn implements DataPatchInterface
{



    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
       ModuleDataSetupInterface $moduleDataSetup

     ) {

        $this->moduleDataSetup = $moduleDataSetup;

    }
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $setup = $this->moduleDataSetup;

        $data[] = ['name' => 'sike', 'description' => 'cool','is_enabled' =>1];
        $data[] = ['name' => 'Mike', 'description' => 'cool','is_enabled' =>1];

         $this->moduleDataSetup->getConnection()->insertArray(
            $this->moduleDataSetup->getTable('table_example'),
            ['name', 'description','is_enabled'],
            $data
        );     
        $this->moduleDataSetup->endSetup();
    }
    public function getAliases()
    {
        return [];
    }
    public static function getDependencies()
    {
        return [];
    }
}