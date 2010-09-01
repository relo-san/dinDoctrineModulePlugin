<?php

/*
 * This file is part of the dinDoctrineModulePlugin package.
 * (c) DineCat, 2010 http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

/**
 * Model generator helper
 * 
 * @package     dinDoctrineModulePlugin
 * @subpackage  lib.helper
 * @author      Nicolay N. Zyk <relo.san@gmail.com>
 */
class dinModelGeneratorHelper extends sfModelGeneratorHelper
{

    protected
        $dictionary = 'admin.',
        $csrfToken = null,
        $csrfField = null;

    /**
     * Link to save
     * 
     * @param   object  $object Object
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToSave( $object, $params )
    {

        return '<li class="sf_admin_action_save"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){'
            . '$(".sf_admin_action_save button").button({icons:{primary:\'ui-icon-disk\'}})'
            . '});}</script><button type="submit">'
            . I18n::__( $this->dictionary . 'labels.save' ) . '</button></li>';

    } // dinModelGeneratorHelper::linkToSave()


    /**
     * Link to show
     * 
     * @param   object  $object Object
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToShow( $object, $params )
    {

        return '<li class="sf_admin_action_show"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){'
            . '$(".sf_admin_action_show a").button({icons:{primary:\'ui-icon-image\'}})'
            . '});}</script>' . Url::linkr( I18n::__( $this->dictionary . 'labels.show' ),
                $this->getUrlForAction( 'show' ), $object, $params['params'] ) . '</li>';

    } // dinModelGeneratorHelper::linkToShow()


    /**
     * Link to delete
     * 
     * @param   object  $object Object
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToDelete( $object, $params )
    {

        if ( !isset( $params['params']['data'] ) )
        {
            $params['params']['data'] = 'sf_method=delete'
                . ( $this->getCsrfToken() ? '&' . $this->getCsrfField() . '=' . $this->getCsrfToken() : '' );
        }
        if ( !isset( $params['params']['jconfirm'] ) )
        {
            $params['params']['jconfirm'] = '$("#dialog-del-obj").dialog({resizable:false,height:140,'
                . 'modal:true,buttons:{\'' . I18n::__( 'admin.buttons.confirmDelete' )
                . '\':function(){%%action%%$(this).dialog(\'close\');},\''
                . I18n::__( 'admin.buttons.confirmCancel' ) . '\':function(){$(this).dialog(\'close\');}}});';
        }
        $params['params']['url'] = true;

        if ( !isset( $params['is_only_icon'] ) )
        {
            $s[] = '<li class="sf_admin_action_delete"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){';
            $s[] = '$(".sf_admin_action_delete a").button({icons:{primary:\'ui-icon-trash\'}})});}</script>';
        }
        $s[] = Url::linkr(
            I18n::__( $this->dictionary . 'labels.delete' ), $this->getUrlForAction( 'delete' ),
            $object, $params['params']
        );
        if ( !isset( $params['is_only_icon'] ) )
        {
            $s[] = '</li>';
        }

        return implode( $s );

    } // dinModelGeneratorHelper::linkToDelete()


    /**
     * Link to list
     * 
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToList( $params )
    {

        return '<li class="sf_admin_action_list"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){'
            . '$(".sf_admin_action_list a").button({icons:{primary:\'ui-icon-arrowreturnthick-1-w\'}})'
            . '});}</script>' . Url::link( I18n::__( $this->dictionary . 'labels.backToList' ),
                $this->getUrlForAction( 'list' ), $params['params'] ) . '</li>';

    } // dinModelGeneratorHelper::linkToList()


    /**
     * Link to new
     * 
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToNew( $params )
    {

        return '<li class="sf_admin_action_new"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){'
            . '$(".sf_admin_action_new a").button({icons:{primary:\'ui-icon-document\'}})'
            . '});}</script>' . Url::link( I18n::__( $this->dictionary . 'labels.new' ),
                $this->getUrlForAction( 'new' ), $params['params'] ) . '</li>';

    } // dinModelGeneratorHelper::linkToNew()


    /**
     * Link to edit
     * 
     * @param   object  $object Object
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToEdit( $object, $params )
    {

        if ( !isset( $params['is_only_icon'] ) )
        {
            $s[] = '<li class="sf_admin_action_edit"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){';
            $s[] = '$(".sf_admin_action_edit a").button({icons:{primary:\'ui-icon-pencil\'}})});}</script>';
        }
        $s[] = Url::linkr(
            I18n::__( $this->dictionary . 'labels.edit' ), $this->getUrlForAction( 'edit' ),
            $object, $params['params']
        );
        if ( !isset( $params['is_only_icon'] ) )
        {
            $s[] = '</li>';
        }
        return implode( $s );

    } // dinModelGeneratorHelper::linkToEdit()


    /**
     * Link to filters
     * 
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToFilters( $params )
    {

        if ( !isset( $params['params'] ) )
        {
            $params['params'] = array( 'ajax' => 'filter', 'dest' => $this->moduleName );
        }
        return '<div class="sf_admin_filter_button"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){'
            . '$(".sf_admin_filter_button a").button({icons:{primary:\'ui-icon-search\'}})'
            . '});}</script>' . Url::linkr( I18n::__( $this->dictionary . 'labels.filter' ),
                $this->getUrlForAction( 'collection' ), array( 'action' => 'filter' ),
                $params['params'] ) . '</div>';

    } // dinModelGeneratorHelper::linkToFilters()


    /**
     * Link to clear filters
     * 
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToClearFilters( $params )
    {

        if ( !isset( $params['params'] ) )
        {
            $params['params'] = array( 'query_string' => '_reset', 'ajax' => 'post' );
        }
        return '<div class="sf_admin_reset_filter_button'
            . ( $params['hasFilters'] ? '' : ' ui-state-disabled' )
            . '"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){'
            . '$(".sf_admin_reset_filter_button a").button({icons:{primary:\'ui-icon-close\'}})'
            . '});}</script>' . Url::linkr( I18n::__( $this->dictionary . 'labels.reset' ),
                $this->getUrlForAction( 'collection' ), array( 'action' => 'filter' ), $params['params'] ) . '</div>';

    } // dinModelGeneratorHelper::linkToFilters()


    /**
     * Link to save and add
     * 
     * @param   object  $object Object
     * @param   array   $params Params for generation
     * @return  string  Generated xhtml compliant
     */
    public function linkToSaveAndAdd( $object, $params )
    {

        if ( !$object->isNew() )
        {
            return '';
        }
        return '<li class="sf_admin_action_save_and_add"><script type="text/javascript">if(typeof jQuery!=\'undefined\'){$(function(){'
            . '$(".sf_admin_action_save_and_add button").button({icons:{primary:\'ui-icon-copy\'}})'
            . '});$(".sf_admin_action_save_and_add button").click(function(){$(".sf_admin_action_save_and_add")'
            . '.prepend(\'<input type="hidden" name="_save_and_add" value="1" />\');});}</script>'
            . '<button type="submit" name="_save_and_add">'
            . I18n::__( $this->dictionary . 'labels.saveAndAdd' ) . '</button></li>';

    } // dinModelGeneratorHelper::linkToSaveAndAdd()


    /**
     * Get CSRF token
     * 
     * @return  string|false    CSRF token string
     */
    public function getCsrfToken()
    {

        if ( is_null( $this->csrfToken ) )
        {
            $this->csrfToken = $this->csrfField = false;
            $form = new BaseForm();
            if ( $form->isCSRFProtected() )
            {
                $this->csrfToken = $form->getCSRFToken();
                $this->csrfField = $form->getCSRFFieldName();
            }
        }
        return $this->csrfToken;

    } // dinModelGeneratorHelper::getCsrfToken()


    /**
     * Get CSRF field name
     * 
     * @return  string|false    CSRF field name
     */
    public function getCsrfField()
    {

        if ( is_null( $this->csrfField ) )
        {
            $this->getCsrfToken();
        }
        return $this->csrfField;

    } // dinModelGeneratorHelper::getCsrfField()


    /**
     * Get url for action
     * 
     * @param   string  $action Action name
     * @return  string  Uri for action
     */
    public function getUrlForAction( $action )
    {
    } // dinModelGeneratorHelper

} // dinModelGeneratorHelper

//EOF