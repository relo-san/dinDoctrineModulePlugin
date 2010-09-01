<?php

/*
 * This file is part of the dinDoctrineModulePlugin package.
 * (c) DineCat, 2010 http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

/**
 * Formatter for embedded forms
 * 
 * @package     dinDoctrineModulePlugin
 * @subpackage  lib.form
 * @author      Nicolay N. Zyk <relo.san@gmail.com>
 */
class sfWidgetFormSchemaFormatterEmbedded extends sfWidgetFormSchemaFormatter
{

    protected
        $rowFormat       = "%hidden_fields%<div class=\"sf_admin_form_row sf_admin_text%name_class%%err_class%\">\n%error%\n<div>\n%label%\n%field%\n%help%\n</div>\n</div>\n",
        $errorRowFormat  = "%errors%",
        $helpFormat      = '<div class="help">%help%</div>',
        $decoratorFormat = "\n %content%";

    public function formatRow( $label, $field, $errors = array(), $help = '', $hiddenFields = null )
    {

        preg_match( '|name=".*\[.*\]\[(.*)\]"|ui', $field, $match );
        return strtr( $this->getRowFormat(), array(
            '%label%'           => $label,
            '%err_class%'       => count( $errors ) ? ' errors' : '',
            '%name_class%'      => isset( $match[1] ) ? ' sf_admin_form_field_' . $match[1] : '',
            '%field%'           => $field,
            '%error%'           => $this->formatErrorsForRow($errors),
            '%help%'            => $this->formatHelp($help),
            '%hidden_fields%'   => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
        ) );

    } // sfWidgetFormSchemaFormatterEmbedded::formatRow()

} // sfWidgetFormSchemaFormatterEmbedded

//EOF