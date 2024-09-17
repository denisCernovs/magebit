<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit<info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\Question;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection {
    /**
     * @return void
     */
    protected function _construct() {
        $this->_init(
            Question::class,
            QuestionResource::class
        );
    }
}
