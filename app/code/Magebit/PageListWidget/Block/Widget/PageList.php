<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit<info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory as PageCollectionFactory;
use Magento\Framework\View\Element\Template\Context;
use Magento\Cms\Model\Page;

class PageList extends Template implements BlockInterface
{
    protected $_template = "Magebit_PageListWidget::page-list.phtml";
    private const ALL = 'all_pages';

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param PageCollectionFactory $pageCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        private readonly PageFactory $pageFactory,
        private readonly PageCollectionFactory $pageCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get widget Title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData('title');
    }

    /**
     * Get pages based on display mode.
     *
     * @return array
     */
    public function getPages(): array
    {

        return
            $this->getData('display_mode') === self::ALL ?
                $this->getAllCmsPages() :
                $this->getSelectedPages();
    }

    /**
     * Get selected pages.
     *
     * @return array
     */
    public function getSelectedPages(): array
    {
        $pageIds = $this->getData('selected_pages');
        if (empty($pageIds)) {
            return [];
        }

        $pageIdsArray = explode(',', $pageIds);
        $pages = [];
        foreach ($pageIdsArray as $pageId) {
            $page = $this->getPageById((int) $pageId);
            if ($page->getId()) {
                $pages[] = $page;
            }
        }
        return $pages;
    }

    /**
     * Get a page by ID.
     *
     * @param int $pageId
     * @return Page
     */
    public function getPageById(int $pageId): Page
    {
        return $this->pageFactory->create()->load($pageId);
    }

    /**
     * Get all CMS pages.
     *
     * @return array
     */
    public function getAllCmsPages(): array
    {
        return
            $this->pageCollectionFactory->create()
                ->addFieldToSelect(['page_id', 'title', 'identifier'])
                ->getItems();
    }
}
