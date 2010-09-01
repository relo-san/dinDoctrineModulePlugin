<?php 

/*
 * This file is part of the dinAdminStdPlugin package.
 * (c) DineCat, 2010 http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

?>
[?php

/*
 * This file was autogenerated by dinDoctrineModulePlugin package.
 * (c) DineCat, <?php echo date( 'Y' ) ?> http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 * 
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName() . "\n" ?>
 * @author     ##AUTHOR##
 */
abstract class Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorHelper extends dinModelGeneratorHelper
{

    protected $moduleName = '<?php echo $this->getModuleName() ?>';

    public function getUrlForAction( $action )
    {

        return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_' . $action;

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>::getUrlForAction()

} // Base<?php echo ucfirst( $this->getModuleName() ) ?>

//EOF
