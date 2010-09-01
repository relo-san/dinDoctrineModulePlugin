
    protected function addSortQuery( $query )
    {

<?php
echo "        if ( array( null, null ) == ( \$sort = \$this->getSort() ) )\n";
echo "        {\n";
echo "            return;\n";
echo "        }\n\n";

echo "        \$table = Doctrine::getTable( '" . $this->getModelClass() . "' );\n";
echo "        \$rules = \$this->configuration->getSortRules();\n";
echo "        \$orders = array();\n";
echo "        foreach ( \$rules[\$sort[0]]['columns'] as \$column )\n";
echo "        {\n";
echo "            \$orders[\$column] = \$sort[1];\n";
echo "        }\n";
echo "        \$table->addQuery( \$query )->addOrderBy( \$orders )->free();\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::addSortQuery()


    protected function getSort()
    {

<?php
echo "        if ( null !== \$sort = \$this->getUser()->getAttribute( '" . $this->getModuleName() . ".sort', null, 'admin_module' ) )\n";
echo "        {\n";
echo "            return \$sort;\n";
echo "        }\n\n";

echo "        \$this->setSort( \$this->configuration->getDefaultSort() );\n\n";

echo "        return \$this->getUser()->getAttribute( '" . $this->getModuleName() . ".sort', null, 'admin_module' );\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::getSort()


    protected function setSort( array $sort )
    {

<?php
echo "        if ( null !== \$sort[0] && null === \$sort[1] )\n";
echo "        {\n";
echo "            \$sort[1] = 'asc';\n";
echo "        }\n";
echo "        if ( \$sort[1] == 'def' )\n";
echo "        {\n";
echo "            \$sort = array( null, null );\n";
echo "        }\n\n";

echo "        \$this->getUser()->setAttribute( '" . $this->getModuleName() . ".sort', \$sort, 'admin_module' );\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::setSort()


    protected function isValidSortRule( $rule )
    {

<?php
echo "        \$sort = \$this->configuration->getSortRules();\n";
echo "        return isset( \$sort[\$rule] ) ? true : false;\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::isValidSortRule()
