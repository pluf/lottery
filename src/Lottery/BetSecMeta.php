<?php

class Lottery_BetSecMeta extends Pluf_Model
{

    /**
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'lottery_bet_secure_metas';
        $this->_a['verbose'] = 'Lottery_BetSecMeta';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'is_null' => false,
                'editable' => false
            ),
            'key' => array(
                'type' => 'Varchar',
                'is_null' => false,
                'size' => 250,
                'editable' => false
            ),
            'value' => array(
                'type' => 'Varchar',
                'is_null' => false,
                'size' => 256,
                'editable' => false
            ),
            /*
             * Relations
             */
            'bet_id' => array(
                'type' => 'Foreignkey',
                'model' => 'Lottery_Bet',
                'name' => 'bet',
                'graphql_name' => 'bet',
                'relate_name' => 'secure_metas',
                'is_null' => false,
                'editable' => false
            )
        );

        $this->_a['idx'] = array(
            'bet_secure_meta_idx' => array(
                'col' => 'key, bet_id',
                'type' => 'unique', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            )
        );
    }

    /**
     * Extracts information of metafield and returns it.
     *
     * @param string $key
     * @param long $betId
     * @return Lottery_BetMeta
     */
    public static function getMeta($key, $betId)
    {
        $model = new Lottery_BetSecMeta();
        $where = new Pluf_SQL('`key`=%s AND `bet_id`=%s', array(
            $model->_toDb($key, 'key'),
            $model->_toDb($betId, 'bet_id')
        ));
        $metas = $model->getList(array(
            'filter' => $where->gen()
        ));
        if ($metas === false or count($metas) !== 1) {
            return false;
        }
        return $metas[0];
    }
}
