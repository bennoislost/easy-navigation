<?php

class Bennoislost_EasyNavigation_Model_Observer
{

    /**
     * @param Varien_Event_Observer $event
     */
    public function addCatalogToTopmenuItems(Varien_Event_Observer $event)
    {
        $block = $event->getEvent()->getBlock();
        $block->addCacheTag(Mage_Catalog_Model_Category::CACHE_TAG);

        Mage::getModel('bennoislost_easynavigation/catalog_category_navigation_add')
            ->addCategoriesToMenu(
                Mage::helper('catalog/category')->getStoreCategories(),
                $event->getMenu(),
                $block,
                true
            );
    }
}