<?php

namespace Magebit\Faq\Controller\Adminhtml\Index;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    private $questionRepository;

    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $questionId = (int) $this->getRequest()->getParam('id', 0);

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if (!$questionId) {
            $this->messageManager->addWarningMessage(__("The question with the provided id was not found2.", $questionId));
            return $result->setPath('faq/index/index');
        }

        try {
            $question = $this->questionRepository->getById($questionId);
            if (!$question->getId()) {
                $this->messageManager->addWarningMessage(__("The question with the provided id was not found.", $questionId));
            } else {
                $this->questionRepository->delete($question);
                $this->messageManager->addSuccessMessage(__("The question has been deleted"));
            }

        } catch (\Throwable $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('faq/index/index');
    }
}
