<?php

namespace MaxServ\YoastSeo\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface AnalysisTemplateSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return mixed
     */
    public function getItems();

    /**
     * @param mixed $items
     * @return $this
     */
    public function setItems(array $items);
}
