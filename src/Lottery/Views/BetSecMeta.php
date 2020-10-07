<?php

Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Lottery_Views_BetSecMeta extends Pluf_Views
{

//     public function createOrUpdate($request, $match)
//     {
//         // Extract bet id
//         $betId = self::extractBetId($match);
//         $match['parentId'] = $betId;
//         $p = array(
//             'model' => 'Lottery_BetSecMeta',
//             'parent' => 'Lottery_Bet',
//             'parentKey' => 'bet_id'
//         );
//         // Check if meta exist
//         $meta = self::getMetaByKey($request->REQUEST['key'], $betId);
//         if (! isset($meta)) { // Should be created
//             return $this->createManyToOne($request, $match, $p);
//         } else { // Should be updated
//             $match['modelId'] = $meta->id;
//             return $this->updateManyToOne($request, $match, $p);
//         }
//     }

    /**
     * Returns the meta of given bet determined by $betId and given key by $key.
     * Returns null if such meta does not exist.
     *
     * @param string $key
     * @param integer $betId
     *            id of the bet
     * @return Lottery_BetSecMeta|NULL
     */
    public static function getMetaByKey($key, $betId)
    {
        $sql = new Pluf_SQL('`key`=%s AND `bet_id`=%s', array(
            $key,
            $betId
        ));
        $str = $sql->gen();
        $meta = Pluf::factory('Lottery_BetSecMeta')->getOne($str);
        return $meta;
    }

    private static function extractBetId($match)
    {
        if (array_key_exists('parentId', $match)) {
            return $match['parentId'];
        }
        if (array_key_exists('betId', $match)) {
            return $match['betId'];
        }
        throw new Pluf_Exception_BadRequest('Not parentId nor betId is defined');
    }

    /**
     * Extract Key of meta from $match and returns related Meta
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_DoesNotExist if Id is given and Meta with given id does not exist or is not blong to given Bet
     * @return NULL|Lottery_BetSecMeta
     */
    public static function getByKey($request, $match)
    {
        if (! isset($match['modelKey'])) {
            throw new Pluf_Exception_BadRequest('The modelKey is not set');
        }
        $betId = self::extractBetId($match);
        $meta = self::getMetaByKey($match['modelKey'], $betId);
        if ($meta === null) {
            throw new Pluf_HTTP_Error404('Object not found (Lottery_BetSecMeta,' . $match['modelKey'] . ')');
        }
        return $meta;
    }

//     public static function updateByKey($request, $match)
//     {
//         $metaField = self::getByKey($request, $match);
//         $match['modelId'] = $metaField->id;
//         $match['parentId'] = $metaField->bet_id;
//         $p = array(
//             'model' => 'Lottery_BetSecMeta',
//             'parent' => 'Lottery_Bet',
//             'parentKey' => 'bet_id'
//         );
//         $view = new Pluf_Views();
//         return $view->updateManyToOne($request, $match, $p);
//     }

}
