<?php

/**
 * Defines a bet in a lottery game 
 * 
 */
class Lottery_Bet extends Pluf_Model
{

    /**
     * Loads data model
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'lottery_bets';
        $this->_a['verbose'] = 'Lottery Bet';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'blank' => false,
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'game' => array(
                'type' => 'Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 128,
                'editable' => false,
                'readable' => true
            ),
            'state' => array(
                'type' => 'Varchar',
                'is_null' => true,
                'size' => 64,
                'editable' => true,
                'readable' => true
            ),
            'bet' => array(
                'type' => 'Float',
                'blank' => false,
                'is_null' => false,
                'default' => 0,
                'editable' => false,
                'readable' => true
            ),
            'reward' => array(
                'type' => 'Float',
                'blank' => false,
                'is_null' => false,
                'default' => 0,
                'editable' => false,
                'readable' => true
            ),
            'is_win' => array(
                'type' => 'Boolean',
                'blank' => true,
                'is_null' => true,
                'default' => 0,
                'editable' => false,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Datetime',
                'blank' => false,
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            // It shows last change in the wallet include change in total credit
            'modif_dtime' => array(
                'type' => 'Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            /*
             * Relations
             */
            'account_id' => array(
                'type' => 'Foreignkey',
                'model' => 'Lottery_Account',
                'blank' => false,
                'is_null' => false,
                'name' => 'account',
                'graphql_name' => 'account',
                'relate_name' => 'bets',
                'editable' => false,
                'readable' => true
            )
        );
    }

    /**
     * \brief پیش ذخیره را انجام می‌دهد
     *
     * @param $create boolean
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
        }
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }
}