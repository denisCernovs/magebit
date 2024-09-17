<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit<info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface QuestionRepositoryInterface
{
    /**
     * @param QuestionInterface $question
     * @return void
     */
    public function save(QuestionInterface $question): void;

    /**
     * @param int $questionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $questionId): QuestionInterface;

    /**
     * @param QuestionInterface $question
     * @return void
     */
    public function delete(QuestionInterface $question): void;

    /**
     * @return array
     */
    public function getList(): array;
}
