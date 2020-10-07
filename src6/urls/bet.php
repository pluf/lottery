<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/bets/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_Bet'
        )
    ),
    // ************************************************************* Bet
    array( // Create
        'regex' => '#^/bets$#',
        'model' => 'Lottery_Views_Bet',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // Read (list)
        'regex' => '#^/bets$#',
        'model' => 'Lottery_Views_Bet',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array()
    ),
    array( // Read
        'regex' => '#^/bets/(?P<betId>\d+)$#',
        'model' => 'Lottery_Views_Bet',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array()
    ),
    // array( // Update
    // 'regex' => '#^/bets/(?P<betId>\d+)$#',
    // 'model' => 'Lottery_Views_Bet',
    // 'method' => 'update',
    // 'http-method' => 'POST',
    // 'precond' => array(
    // 'Lottery_Precondition::ownerRequired'
    // )
    // ),
    // array( // Delete
    // 'regex' => '#^/bets/(?P<betId>\d+)$#',
    // 'model' => 'Lottery_Views_Bet',
    // 'method' => 'delete',
    // 'http-method' => 'DELETE',
    // 'precond' => array(
    // 'Lottery_Precondition::ownerRequired'
    // )
    // ),
    // ************************************************************* Processing Bet
    array( // get possible actions
        'regex' => '#^/bets/(?P<betId>\d+)/possible-transitions$#',
        'model' => 'Lottery_Views_Bet',
        'method' => 'actions',
        'http-method' => 'GET'
    ),
    array( // do action on bet
        'regex' => '#^/bets/(?P<betId>\d+)/transitions$#',
        'model' => 'Lottery_Views_Bet',
        'method' => 'doAction',
        'http-method' => 'POST',
        'precond' => array(
            'Lottery_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Metas of Bet
    // array( // Create
    // 'regex' => '#^/bets/(?P<parentId>\d+)/metas$#',
    // 'model' => 'Lottery_Views_BetMeta',
    // 'method' => 'createOrUpdate',
    // 'http-method' => 'POST',
    // 'precond' => array(
    // 'Lottery_Precondition::ownerRequired'
    // )
    // ),
    array( // Read (list)
        'regex' => '#^/bets/(?P<parentId>\d+)/metas$#',
        'model' => 'Lottery_Views_BetMeta',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_BetMeta',
            'parent' => 'Lottery_Bet',
            'parentKey' => 'bet_id'
        )
    ),
    array( // Read
        'regex' => '#^/bets/(?P<parentId>\d+)/metas/(?P<modelId>\d+)$#',
        'model' => 'Lottery_Views_BetMeta',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_BetMeta',
            'parent' => 'Lottery_Bet',
            'parentKey' => 'bet_id'
        )
    ),
    array( // Read (by key)
        'regex' => '#^/bets/(?P<parentId>\d+)/metas/(?P<modelKey>[^/]+)$#',
        'model' => 'Lottery_Views_BetMeta',
        'method' => 'getByKey',
        'http-method' => 'GET'
    ),
    // array( // Update
    // 'regex' => '#^/bets/(?P<parentId>\d+)/metas/(?P<modelId>\d+)$#',
    // 'model' => 'Lottery_Views_BetMeta',
    // 'method' => 'updateManyToOne',
    // 'http-method' => 'POST',
    // 'params' => array(
    // 'model' => 'Lottery_BetMeta',
    // 'parent' => 'Lottery_Bet',
    // 'parentKey' => 'bet_id'
    // ),
    // 'precond' => array(
    // 'Lottery_Precondition::ownerRequired'
    // )
    // ),
    // array( // Update (by key)
    // 'regex' => '#^/bets/(?P<parentId>\d+)/metas/(?P<modelKey>[^/]+)$#',
    // 'model' => 'Lottery_Views_BetMeta',
    // 'method' => 'updateByKey',
    // 'http-method' => 'POST',
    // 'precond' => array(
    // 'Lottery_Precondition::ownerRequired'
    // )
    // ),
    // array( // Delete
    // 'regex' => '#^/bets/(?P<parentId>\d+)/metas/(?P<modelId>\d+)$#',
    // 'model' => 'Lottery_Views_BetMeta',
    // 'method' => 'deleteManyToOne',
    // 'http-method' => 'DELETE',
    // 'params' => array(
    // 'model' => 'Lottery_BetMeta',
    // 'parent' => 'Lottery_Bet',
    // 'parentKey' => 'bet_id'
    // ),
    // 'precond' => array(
    // 'Lottery_Precondition::ownerRequired'
    // )
    // )

    // ************************************************************* SecureMetas of Bet
    // array( // Create
    // 'regex' => '#^/bets/(?P<parentId>\d+)/secure-metas$#',
    // 'model' => 'Lottery_Views_BetSecMeta',
    // 'method' => 'createOrUpdate',
    // 'http-method' => 'POST',
    // 'precond' => array(
    // 'Lottery_Precondition::ownerRequired'
    // )
    // ),
    array( // Read (list)
        'regex' => '#^/bets/(?P<parentId>\d+)/secure-metas$#',
        'model' => 'Lottery_Views_BetSecMeta',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_BetSecMeta',
            'parent' => 'Lottery_Bet',
            'parentKey' => 'bet_id'
        ),
        'precond' => array(
            'Lottery_Precondition::ownerRequired'
        )
    ),
    array( // Read
        'regex' => '#^/bets/(?P<parentId>\d+)/secure-metas/(?P<modelId>\d+)$#',
        'model' => 'Lottery_Views_BetSecMeta',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_BetSecMeta',
            'parent' => 'Lottery_Bet',
            'parentKey' => 'bet_id'
        ),
        'precond' => array(
            'Lottery_Precondition::ownerRequired'
        )
    ),
    array( // Read (by key)
        'regex' => '#^/bets/(?P<parentId>\d+)/secure-metas/(?P<modelKey>[^/]+)$#',
        'model' => 'Lottery_Views_BetSecMeta',
        'method' => 'getByKey',
        'http-method' => 'GET'
    ),
//     array( // Update
//         'regex' => '#^/bets/(?P<parentId>\d+)/secure-metas/(?P<modelId>\d+)$#',
//         'model' => 'Lottery_Views_BetSecMeta',
//         'method' => 'updateManyToOne',
//         'http-method' => 'POST',
//         'params' => array(
//             'model' => 'Lottery_BetSecMeta',
//             'parent' => 'Lottery_Bet',
//             'parentKey' => 'bet_id'
//         ),
//         'precond' => array(
//             'Lottery_Precondition::ownerRequired'
//         )
//     ),
//     array( // Update (by key)
//         'regex' => '#^/bets/(?P<parentId>\d+)/secure-metas/(?P<modelKey>[^/]+)$#',
//         'model' => 'Lottery_Views_BetSecMeta',
//         'method' => 'updateByKey',
//         'http-method' => 'POST',
//         'precond' => array(
//             'Lottery_Precondition::ownerRequired'
//         )
//     ),
//     array( // Delete
//         'regex' => '#^/bets/(?P<parentId>\d+)/secure-metas/(?P<modelId>\d+)$#',
//         'model' => 'Lottery_Views_BetSecMeta',
//         'method' => 'deleteManyToOne',
//         'http-method' => 'DELETE',
//         'params' => array(
//             'model' => 'Lottery_BetSecMeta',
//             'parent' => 'Lottery_Bet',
//             'parentKey' => 'bet_id'
//         ),
//         'precond' => array(
//             'Lottery_Precondition::ownerRequired'
//         )
//     )
);
