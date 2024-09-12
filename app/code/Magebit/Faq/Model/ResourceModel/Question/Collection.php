<?php

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\Question;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init(
            Question::class,
            QuestionResource::class
        );
    }
}
