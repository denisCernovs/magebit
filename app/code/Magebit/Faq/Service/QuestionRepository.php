<?php

namespace Magebit\Faq\Service;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @param QuestionResource $resource
     * @param QuestionFactory $factory
     */
    public function __construct(
        private readonly QuestionResource $resource,
        private readonly QuestionFactory $factory,
        private readonly CollectionFactory $collectionFactory
    )
    {

    }

    public function save(QuestionInterface $question): void
    {
       $this->resource->save($question);
    }

    /**
     * @param int $questionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $questionId): QuestionInterface
    {
        $question = $this->factory->create();
        $this->resource->load($question, $questionId);

        if (!$question->getId()) {
            throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $questionId));
        }

        return $question;
    }

    /**
     * @param QuestionInterface $question
     * @return void
     * @throws \Exception
     */
    public function delete(QuestionInterface $question): void
    {
        $this->resource->delete($question);
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $collection = $this->collectionFactory->create();

        $collection->setOrder('position', 'ASC');

        return $collection->getItems();
    }
}
