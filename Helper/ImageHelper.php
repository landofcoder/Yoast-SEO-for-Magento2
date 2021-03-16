<?php

namespace MaxServ\YoastSeo\Helper;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class ImageHelper
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    protected $_request;

    /**
     * ImageHelper constructor.
     * @param StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->storeManager = $storeManager;
        $this->_request = $request;
    }

    /**
     * Convert image filename into a format which the editor understands.
     *
     * @param array $item
     * @param string $type
     */
    public function updateImageDataForDataProvider(&$item, $type)
    {
        $field = "yoast_{$type}_image";
        $image = [];
        if (isset($item[$field]) && $item[$field] && is_string($item[$field])) {
            $img = $item[$field];
            $image[] = [
                'type' => 'image',
                'name' => $img,
                'url' => $this->getYoastImage($img)
            ];
        }
        if ($image) {
            $item[$field] = $image;
        } else {
            unset($item[$field]);
        }
    }

    /**
     * @param string $image
     * @return string
     */
    public function getYoastImage($image)
    {
        $baseUrl = $this->storeManager->getStore()->getBaseUrl(
            UrlInterface::URL_TYPE_MEDIA
        );
        $image = ltrim($image, '/');
        if ($this->_request->getFullActionName() == 'catalog_product_view') {
            return $baseUrl . 'catalog/product/' . $image;
        }
        if ($this->_request->getFullActionName() == 'catalog_category_view') {
            return $baseUrl . 'catalog/category/' . $image;
        }
        return $baseUrl . 'yoast/img/' . $image;
    }
}
