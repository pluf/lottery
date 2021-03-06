<?php

/**
 * Defines a wallet to store credit. 
 * 
 */
class Lottery_Wallet extends Pluf_Model
{

    /**
     * Loads data model
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'bank_wallets';
        $this->_a['verbose'] = 'Lottery Wallet';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'blank' => false,
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'title' => array(
                'type' => 'Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 256,
                'editable' => true,
                'readable' => true
            ),
            // Currency of lottery wallets is CoinCodile token
            'currency' => array(
                'type' => 'Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 50,
                'default' => 'CoinCodile',
                'editable' => false,
                'readable' => false
            ),
            'total_deposit' => array(
                'type' => 'Float',
                'blank' => false,
                'is_null' => false,
                'default' => 0,
                'editable' => false,
                'readable' => true
            ),
            'total_withdraw' => array(
                'type' => 'Float',
                'blank' => false,
                'is_null' => false,
                'default' => 0,
                'editable' => false,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 1024,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Boolean',
                'blank' => false,
                'default' => false,
                'readable' => true,
                'editable' => false
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
            'owner_id' => array(
                'type' => 'Foreignkey',
                'model' => 'Lottery_Account',
                'blank' => false,
                'is_null' => false,
                'name' => 'owner',
                'graphql_name' => 'owner',
                'relate_name' => 'wallets',
                'editable' => false,
                'readable' => true
            )
        );

        $this->_a['idx'] = array(
            'wallet_owner_idx' => array(
                'col' => 'owner_id',
                'type' => 'normal', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
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