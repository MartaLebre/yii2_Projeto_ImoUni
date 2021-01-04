<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\api\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET {id}/detalhes' => 'detalhes', //mostra informação da tabela user e da tabela perfil
                        'GET {id}/email' => 'email', //mostra o email de um user
                        'GET total' => 'total', //mostra o total de users
                        'GET visita/{id}' => 'visita',
                        'GET reserva/{id}' => 'reserva',
                    ],
                    'tokens' =>
                        [
                            '{id}' => '<id:\\d+>',
                        ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/anuncios',
                    'pluralize' => false,
                    'extraPatterns' =>
                        [
                            'PUT alterar/{id}' => 'alterar', //Altera os dados de um anúncio
                            'DELETE apagar/{id}' => 'apagar', //Apaga um anúncio
                            'POST adicionar' => 'adicionar', //Adiciona um anúncio novo
                        ],
                    'tokens' =>
                        [
                            '{id}' => '<id:\\d+>'
                        ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => '/api/casas',
                    'pluralize' => false,
                    'extraPatterns' =>
                        [
                            'GET {id}/detalhes' => 'detalhes', //mostra detalhes de uma casa
                            'DELETE apagar/{id}' => 'apagar', //apaga uma casa
                            'GET {n_registos}/registos' => 'registos', //define um limite de registos e mostra esses registos
                            'GET cozinha/{id}' => 'cozinha',
                            'GET quarto/{id}' => 'quarto',
                            'GET sala/{id}' => 'sala',
                        ],
                    'tokens' =>
                        [
                            '{id}' => '<id:\\d+>',
                            '{n_registos}' => '<n_registos:\\d+>'
                        ],
                ],
            ],
        ],

    ],
    'params' => $params,
];
