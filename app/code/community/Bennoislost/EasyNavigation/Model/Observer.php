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

        return;
    }
}