<?php
 namespace Magebit\Faq\Model\ResourceModel;

 use Magento\Framework\Model\AbstractModel;
 use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

 class Question extends AbstractDb {

     private const TABLE = 'faq_questions';
     private const ID = 'id';

     protected function _construct(): void
     {
         $this->_init(self::TABLE, self::ID);
     }

     protected function _beforeSave(AbstractModel $object)
     {
         $object->setData('updated_at', 0);
         return parent::_beforeSave($object);
     }
 }


