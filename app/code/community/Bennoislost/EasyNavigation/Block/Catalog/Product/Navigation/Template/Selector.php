<?php

class Bennoislost_EasyNavigation_Block_Catalog_Product_Navigation_Template_Selector
    extends Mage_Core_Block_Abstract
{
    /** @var $_menuTree Varien_Data_Tree_Node */
    private $_menuTree;

    /** @var $_menuChildren Varien_Data_Tree_Node_Collection */
    private $_menuChildren;

    private $_depth;

    /**
     * @param $menuTree Varien_Data_Tree_Node
     * @param $children Varien_Data_Tree_Node_Collection
     * @param $depth    Int
     *
     * @return string
     */
    public function getTemplatePath(
        Varien_Data_Tree_Node $menuTree,
        Varien_Data_Tree_Node_Collection $children,
        $depth
    ) {
        $this->_menuTree = $menuTree;
        $this->_menuChildren = $children;
        $this->_depth = $depth;

        return $this->_determineTemplateFile();
    }

    /**
     * @return string
     */
    protected function _determineTemplateFile()
    {
        if ($this->_isLeafNode()) {
            return 'LEAF NODE';
        }

        if ($this->_isRootCategory()) {
            return 'ROOT CATEGORY';
        }

        if ($this->_isParentWithChildren()) {
            return 'PARENT WITH CHILDREN';
        }

        if ($this->_isParentWithoutChildren()) {
            return 'PARENT WITHOUT CHILDREN';
        }

        if ($this->_isChildWithChildren()) {
            return 'CHILD WITH CHILDREN';
        }

        if ($this->_isChildWithoutChildren()) {
            return 'CHILD WITHOUT CHILDREN';
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

    /**
     * @return bool
     */
    private function _isParentWithChildren()
    {
        return ($this->_depth === 1 && $this->_menuChildren->count());
    }

    /**
     * @return bool
     */
    private function _isParentWithoutChildren()
    {
        return ($this->_depth === 1 && (!$this->_menuChildren->count()));
    }

    /**
     * @return bool
     */
    private function _isChildWithChildren()
    {
        return $this->_depth > 1 && $this->_menuChildren->count();
    }

    /**
     * @return bool
     */
    private function _isChildWithoutChildren()
    {
        return $this->_depth > 1 && (!$this->_menuChildren->count());
    }
}
