<?php

namespace Magebit\Faq\Controller\Adminhtml\Index;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\Question;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class InlineEdit extends Action
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
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        $items = $this->getRequest()->getParam('items');

        $messages = [];
        $error = false;

        if(!count($items)) {
            $messages[] = __('Please, correct the data sent.');
            $error = true;
        } else {

            foreach (array_keys($items) as $questionId) {
                try {
                    /** @var Question $question */
                    $question = $this->questionRepository->getById((int) $questionId);
                    $question->setData(array_merge($question->getData(), $items[$questionId]));
                    $this->questionRepository->save($question);
                } catch (\Throwable $e) {
                    $messages[] = '[Question ID: ' . $questionId . '] ' . $e->getMessage();
                    $error = true;
                }
            }
        }

        return $result->setData(
            [
                'messages' => $messages,
                'error' => $error
            ]
        );
    }
}
