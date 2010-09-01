[?php

/*
 * This file was autogenerated by dinDoctrineModulePlugin package.
 * (c) DineCat, <?php echo date( 'Y' ) ?> http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

require_once( dirname( __FILE__ ) . '/../lib/Base<?php echo ucfirst( $this->moduleName ) ?>GeneratorConfiguration.php' );
require_once( dirname( __FILE__ ) . '/../lib/Base<?php echo ucfirst( $this->moduleName ) ?>GeneratorHelper.php' );

/**
 * <?php echo $this->getModuleName() ?> actions
 * 
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName() . "\n" ?>
 * @author     ##AUTHOR##
 */
abstract class <?php echo $this->getGeneratedModuleName() ?>Actions extends <?php echo $this->getActionsBaseClass()."\n" ?>
{

    public function preExecute()
    {

<?php
echo '        $this->configuration = new ' . $this->getModuleName() . "GeneratorConfiguration();\n\n";

echo "        if ( !\$this->getUser()->hasCredential( \$this->configuration->getCredentials( \$this->getActionName() ) ) )\n";
echo "        {\n";
echo "            \$this->forward( sfConfig::get( 'sf_secure_module' ), sfConfig::get( 'sf_secure_action' ) );\n";
echo "        }\n\n";

echo "        \$this->dispatcher->notify( new sfEvent( \$this,\n";
echo "            'admin.pre_execute', array( 'configuration' => \$this->configuration )\n";
echo "        ) );\n\n";

echo '        $this->helper = new ' . $this->getModuleName() . "GeneratorHelper();\n";
echo "        \$response = \$this->getResponse();\n";
echo "        \$response->addCacheControlHttpHeader( 'no-store, no-cache, must-revalidate' );\n";
echo "        \$response->setHttpHeader( 'Expires', \$response->getDate( time() ) );\n\n";

echo "        if ( \$this->getRequestParameter( '_is_ajax', null ) )\n";
echo "        {\n";
echo "            \$this->setLayout( false );\n";
echo "        }\n\n";

if ( $this->configuration->hasParent() )
{
    foreach ( $this->configuration->getParents() as $parent )
    {
        echo "        \$this->getContext()->getRouting()->setDefaultParameter(\n";
        echo "            '" . $parent['identifier'] . "', \$this->request->getParameter( '" . $parent['identifier'] . "' )\n";
        echo "        );\n\n";
    }
}

?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::preExecute()

<?php $parts = dirname( __FILE__ ) . '/../../parts/' ?>
<?php include $parts . 'indexAction.php' ?>

<?php if ( $this->configuration->hasFilterForm() ): ?>
<?php include $parts . 'filterAction.php' ?>
<?php endif ?>

<?php include $parts . 'newAction.php' ?>

<?php include $parts . 'createAction.php' ?>

<?php include $parts . 'editAction.php' ?>

<?php include $parts . 'updateAction.php' ?>

<?php include $parts . 'deleteAction.php' ?>

<?php if ( $this->configuration->getValue( 'list.batch_actions' ) ): ?>
<?php include $parts . 'batchAction.php' ?>
<?php endif ?>

<?php include $parts . 'processFormAction.php' ?>

<?php if ( $this->configuration->hasFilterForm() ): ?>
<?php include $parts . 'filtersAction.php' ?>
<?php endif ?>

<?php include $parts . 'paginationAction.php' ?>

<?php include $parts . 'sortingAction.php' ?>

<?php include $parts . 'showAction.php' ?>

} // <?php echo $this->getGeneratedModuleName() ?>Actions

//EOF