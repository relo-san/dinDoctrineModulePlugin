<?php

/*
 * This file is part of the dinDoctrineModulePlugin package.
 * (c) DineCat, 2010 http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

/**
 * UI helper
 * 
 * @package     dinDoctrineModulePlugin
 * @subpackage  lib.helper
 * @author      Nicolay N. Zyk <relo.san@gmail.com>
 */
class DinAdminHelper
{

    /**
     * Render form field
     * 
     * @param   sfFormField $field
     * @param   array   $options    Render options
     * @return  void
     */
    static public function renderField( $field, $options = array() )
    {

        if ( isset( $options['class'] ) )
        {
            $field->getWidget()->setAttribute( 'class', $options['class'] );
        }

        echo $field;

    } // DinAdminHelper::renderField()

} // DinAdminHelper

//EOF