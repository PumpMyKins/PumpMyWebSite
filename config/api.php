<?php

return [

    'groups' => [
        'user',
        'news',
    ],

    'user'	 => [
        'Administration' => [
            'user.get',
            'user.get.discord',
            'user.admin.get',
            'user.admin.get.discord',
            'user.admin.create',
            'user.admin.update',
            'user.admin.delete',
        ],
        'Moderation' => [
            'user.get',
            'user.get.discord',
        ],
        'Joueur' => [
            'user.get',
            'user.get.discord',
        ],
    ],

    'news' => [
        'Administration' => [
            'news.get',
            'news.create',
            'news.update',
            'news.delete',
            'news.admin.get',
            'news.admin.update',
            'news.admin.delete',
        ],
        'Moderation' => [
            'news.get',
            'news.create',
            'news.update',
            'news.delete',		],
        'Joueur' => [
            'news.get',
            'news.create',
            'news.update',
            'news.delete',
        ],
    ],
];
