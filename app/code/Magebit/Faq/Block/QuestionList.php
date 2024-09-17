<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit<info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Magebit\Faq\Block;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\View\Element\Template;

class QuestionList extends Template
{
    protected QuestionRepositoryInterface $questionRepository;

    public function __construct(
        Template\Context $context,
        QuestionRepositoryInterface $questionRepository,
        array $data = []
    ) {
        $this->questionRepository = $questionRepository;
        parent::__construct($context, $data);
    }

    public function getFaqQuestions()
    {
        return $this->questionRepository->getList();
    }
}
