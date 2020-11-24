<?php
/**
 * Catgento
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customize this module for your needs.
 *
 * @category   Catgento
 * @package    Catgento_AdminActivity
 */
namespace Catgento\AdminActivity\Model\ResourceModel\ActivityLogDetail;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Catgento\AdminActivity\Model\ResourceModel\ActivityLogDetail
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Catgento\AdminActivity\Model\ActivityLogDetail',
            'Catgento\AdminActivity\Model\ResourceModel\ActivityLogDetail'
        );
    }
}
