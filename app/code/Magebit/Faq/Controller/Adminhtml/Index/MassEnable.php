<?php

namespace Magebit\Faq\Controller\Adminhtml\Index;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;

class MassEnable extends Action
{
    private $filter;
    private $collectionFactory;
    private $questionRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();

            /** @var QuestionInterface $question */
            foreach ($collection as $question) {
                $question->setStatus(QuestionInterface::STATUS_ENABLED);
                $this->questionRepository->save($question);
            }
            $this->messageManager->addSuccessMessage(__("A total of %1 record(s) have been enabled", $collectionSize));
        } catch (\Throwable $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('faq/index/index');
    }
}
