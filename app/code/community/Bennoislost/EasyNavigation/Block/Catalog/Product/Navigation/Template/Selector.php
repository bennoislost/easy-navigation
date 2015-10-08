<?php

class Bennoislost_EasyNavigation_Block_Catalog_Product_Navigation_Template_Selector
    extends Mage_Core_Block_Abstract
{
    /** @var $_menuTree Varien_Data_Tree_Node_Collection */
    private $_menuTree;

    /** @var $_children Varien_Data_Tree_Node_Collection */
    private $_children;

    private $_depth;

    /**
     * @param $menuTree Varien_Data_Tree_Node_Collection
     * @param $children Varien_Data_Tree_Node_Collection
     * @param $depth    Int
     *
     * @return string
     */
    public function getTemplatePath(
        Varien_Data_Tree_Node_Collection $menuTree,
        Varien_Data_Tree_Node_Collection $children,
        $depth
    ) {
        $this->_menuTree = $menuTree;
        $this->_children = $children;
        $this->_depth = $depth;

        return $this->_determineTemplateFile();
    }

    protected function _determineTemplateFile()
    {
        if ($this->_isLeafNode()) {
            return 'LEAF NODE';
        }

        if ($this->_isRootCategory()) {
            return 'ROOT CATEGORY';
        }

        return '';
    }

    /**
     * @return bool
     */
    private function _isLeafNode()
    {
        return $this->_depth > 2;
    }

    /**
     * @return bool
     */
    private function _isRootCategory()
    {
        return $this->_menuTree->getIdField() === 'root' ? true : false;
    }
}
