<?php

/**
 * Class Bennoislost_EasyNavigation_Model_Catalog_Category_Navigation_Add
 */
class Bennoislost_EasyNavigation_Model_Catalog_Category_Navigation_Add
    extends Mage_Core_Model_Abstract
{

    /**
     * @param            $categories
     * @param            $parentCategoryNode
     * @param            $menuBlock
     * @param bool|false $addTags
     */
    public function addCategoriesToMenu(
        $categories,
        $parentCategoryNode,
        $menuBlock,
        $addTags = false
    ) {
        $categoryModel = Mage::getModel('catalog/category');
        foreach ($categories as $category) {
            if (!$category->getIsActive()) {
                continue;
            }

            $nodeId = 'category-node-' . $category->getId();

            $categoryModel->setId($category->getId());
            if ($addTags) {
                $menuBlock->addModelTags($categoryModel);
            }

            $tree = $parentCategoryNode->getTree();

            $categoryData = array(
                'name'      => $category->getName(),
                'id'        => $nodeId,
                'url'       => Mage::helper('catalog/category')
                    ->getCategoryUrl($category),
                'is_active' => $this->_isActiveMenuCategory($category),
                'category_data' => $category->getData()
            );

            $categoryNode = new Varien_Data_Tree_Node(
                $categoryData,
                'id',
                $tree,
                $parentCategoryNode
            );
            $parentCategoryNode->addChild($categoryNode);

            $flatHelper = Mage::helper('catalog/category_flat');
            if ($flatHelper->isEnabled() && $flatHelper->isBuilt(true)) {
                $subcategories = (array)$category->getChildrenNodes();
            } else {
                $subcategories = $category->getChildren();
            }

            $this->addCategoriesToMenu(
                $subcategories,
                $categoryNode,
                $menuBlock,
                $addTags
            );
        }
    }

    /**
     * Checks whether category belongs to active category's path
     *
     * @param Varien_Data_Tree_Node $category
     * @return bool
     */
    protected function _isActiveMenuCategory($category)
    {
        $catalogLayer = Mage::getSingleton('catalog/layer');
        if (!$catalogLayer) {
            return false;
        }

        $currentCategory = $catalogLayer->getCurrentCategory();
        if (!$currentCategory) {
            return false;
        }

        $categoryPathIds = explode(',', $currentCategory->getPathInStore());

        return in_array($category->getId(), $categoryPathIds);
    }
}
