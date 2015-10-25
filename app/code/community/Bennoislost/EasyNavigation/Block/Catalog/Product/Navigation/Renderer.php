<?php

/**
 * Class Bennoislost_EasyNavigation_Block_Catalog_Product_Navigation_Renderer
 */
class Bennoislost_EasyNavigation_Block_Catalog_Product_Navigation_Renderer
    extends Mage_Page_Block_Html_Topmenu
{
    /**
     * @param Varien_Data_Tree_Node $menuTree
     * @param string                $childrenWrapClass
     *
     * @return string
     */
    protected function _getHtml(
        Varien_Data_Tree_Node $menuTree,
        $childrenWrapClass
    ) {

        $html = '';
        $counter = 1;
        $children = $menuTree->getChildren();
        $parentLevel = $menuTree->getLevel();

        $childLevel = is_null($parentLevel) ? 0 : $parentLevel + 1;
        $childrenCount = $children->count();
        $parentPositionClass = $menuTree->getPositionClass();
        $itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass
            . '-' : 'nav-';

        foreach ($children as $child) {
            $child->setLevel($childLevel);
            $child->setIsFirst($counter == 1);
            $child->setIsLast($counter == $childrenCount);
            $child->setPositionClass($itemPositionClassPrefix . $counter);

            $outermostClassCode = '';
            $outermostClass = $menuTree->getOutermostClass();
            if ($childLevel == 0 && $outermostClass) {
                $outermostClassCode = ' class="' . $outermostClass . '" ';
                $child->setClass($outermostClass);
            }

            $blockName = ($childLevel == 0)
                ? 'bennoislost.easy-navigation.renderer.with-children'
                : 'bennoislost.easy-navigation.renderer.single';

            $html .= $this->_renderBlockItem(
                $blockName,
                $childrenWrapClass,
                $child,
                $outermostClassCode
            );

            $counter++;
        }

        return $html;
    }

    /**
     * @param $blockName
     * @param $childrenWrapClass
     * @param $child
     * @param $outermostClassCode
     *
     * @return string
     */
    protected function _renderBlockItem(
        $blockName,
        $childrenWrapClass,
        $child,
        $outermostClassCode
    ) {
        $block = Mage::app()->getLayout()->getBlock($blockName);
        $block->setMenu($child);
        $block->setOutermostClassCode($outermostClassCode);
        $block->setChildrenWrapClass($childrenWrapClass);
        $block->setChildLevel($child->getLevel());
        $block->setIsFirst($child->getIsFirst());
        $block->setIsLast($child->getIsLast());

        return $block->toHtml();
    }
}
