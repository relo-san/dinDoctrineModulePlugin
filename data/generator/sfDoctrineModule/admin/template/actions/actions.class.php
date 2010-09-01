[?php

require_once( dirname( __FILE__ ) . '/../lib/Base<?php echo ucfirst($this->moduleName) ?>GeneratorConfiguration.php' );
require_once( dirname( __FILE__ ) . '/../lib/Base<?php echo ucfirst($this->moduleName) ?>GeneratorHelper.php' );

/**
 * <?php echo $this->getModuleName() ?> actions
 * 
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName() . "\n" ?>
 * @author     relo_san [http://relo-san.com/]
 * @version    SVN: $Id: actions.class.php 17 2010-03-15 02:49:25Z relo_san $
 */
abstract class <?php echo $this->getGeneratedModuleName() ?>Actions extends <?php echo $this->getActionsBaseClass()."\n" ?>
{

    public function preExecute()
    {

        $this->configuration = new <?php echo $this->getModuleName() ?>GeneratorConfiguration();

        if ( !$this->getUser()->hasCredential( $this->configuration->getCredentials( $this->getActionName() ) ) )
        {
            $this->forward( sfConfig::get( 'sf_secure_module' ), sfConfig::get( 'sf_secure_action' ) );
        }

        $this->dispatcher->notify( new sfEvent( $this, 'admin.pre_execute', array( 'configuration' => $this->configuration ) ) );

        $this->helper = new <?php echo $this->getModuleName() ?>GeneratorHelper();
        $response = $this->getResponse();
        $response->addCacheControlHttpHeader( 'no-store, no-cache, must-revalidate' );
        $response->setHttpHeader( 'Expires', $response->getDate( time() ) );

        if ( $this->getRequestParameter( '_is_ajax', null ) )
        {
            $this->setLayout( false );
        }

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::preExecute()

<?php include dirname(__FILE__).'/../../parts/indexAction.php' ?>

<?php if ($this->configuration->hasFilterForm()): ?>
<?php include dirname(__FILE__).'/../../parts/filterAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/newAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/createAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/editAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/updateAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/deleteAction.php' ?>

<?php if ($this->configuration->getValue('list.batch_actions')): ?>
<?php include dirname(__FILE__).'/../../parts/batchAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/processFormAction.php' ?>

<?php if ($this->configuration->hasFilterForm()): ?>
<?php include dirname(__FILE__).'/../../parts/filtersAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/paginationAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/sortingAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/showAction.php' ?>

} // <?php echo $this->getGeneratedModuleName() ?>Actions

//EOF