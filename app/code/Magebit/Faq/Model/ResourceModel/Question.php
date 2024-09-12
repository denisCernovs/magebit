<?php
 namespace Magebit\Faq\Model\ResourceModel;

 use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

 class Question extends AbstractDb {

     private const TABLE = 'magebit_faq_question';
     private const ID = 'id';

     protected function _construct()
     {
         $this->_init(self::TABLE, self::ID);
     }
 }
