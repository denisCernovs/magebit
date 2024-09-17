<?php

namespace Magebit\Faq\Controller\Index;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected PageFactory $pageFactory;
    protected QuestionRepositoryInterface $questionRepository;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->pageFactory = $pageFactory;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('FAQ'));

        return $resultPage;
    }
}
