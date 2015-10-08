<?php

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

        $template = $this->getChild('template-selector')
            ->getTemplatePath(
                $menuTree,
                $menuTree->getChildren(),
                $this->_getMenuTreeDepth($menuTree)
            );

        return parent::_getHtml($menuTree, $childrenWrapClass);
    }

    private function _getMenuTreeDepth(Varien_Data_Tree_Node $menuTree)
    {
        $depth = $menuTree->getDepth();
        return is_null($depth) ? 0 : $depth += 1;
    }
}
