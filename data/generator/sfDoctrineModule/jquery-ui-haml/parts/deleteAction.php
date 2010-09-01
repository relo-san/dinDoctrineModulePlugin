
    public function executeDelete( sfWebRequest $request )
    {

<?php
echo "        \$request->checkCSRFProtection();\n\n";

echo "        \$this->dispatcher->notify( new sfEvent(\n";
echo "            \$this, 'admin.delete_object',\n";
echo "            array( 'object' => \$this->getRoute()->getObject() )\n";
echo "        ) );\n\n";

if ( $this->configuration->hasNSTree() )
{
    echo "        \$object = \$this->getRoute()->getObject();\n";
    echo "        if ( \$object->getNode()->isValidNode() )\n";
    echo "        {\n";
    echo "            \$object->getNode()->delete();\n";
    echo "        }\n";
    echo "        else\n";
    echo "        {\n";
    echo "            \$object->delete();\n";
    echo "        }\n\n";

    echo "        \$this->getUser()->setFlash( 'notice', 'admin.messages.deleteSuccess' );";
}
else
{
    echo "        if ( \$this->getRoute()->getObject()->delete() )\n";
    echo "        {\n";
    echo "            \$this->getUser()->setFlash( 'notice', 'admin.messages.deleteSuccess' );\n";
    echo "        }\n\n";
}

echo "        \$this->forward( '" . $this->getModuleName() . "', 'index' );\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeDelete()
