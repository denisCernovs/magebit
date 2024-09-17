<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit<info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Magebit\Faq\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Index extends Action {

    public function execute(): ResultInterface
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $page->setActiveMenu('Magebit_Faq::faq');
        $page->addBreadcrumb(__('FAQ'), __('FAQ'));
        $page->addBreadcrumb(__('Manage FAQ'), __('Manage FAQ'));
        $page->getConfig()->getTitle()->prepend(__('Frequently Asked Questions'));

        return $page;
    }
}
