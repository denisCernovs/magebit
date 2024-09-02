<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit<info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;

class CmsList implements OptionSourceInterface
{

    /**
     * @param CollectionFactory $pageCollectionFactory
     */
    public function __construct(
        private readonly CollectionFactory $pageCollectionFactory
    ){

    }

    /**
     * Return options array.
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $options = [];

        $collection = $this->pageCollectionFactory->create()
            ->addFieldToSelect(['page_id', 'title']);

        foreach ($collection as $page) {
            $options[] = [
                'value' => $page->getId(),
                'label' => $page->getTitle()
            ];
        }

        return $options;
    }
}
