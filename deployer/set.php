<?php

namespace Deployer;

set('shared_dirs', [
        'fileadmin',
        'uploads',
        'typo3temp/assets/_processed_',
        'typo3temp/assets/images',
        'typo3temp/var/logs',
    ]
);

set('shared_files', [
    '.env'
]);

set('writable_dirs', [
        'typo3conf',
        'typo3temp',
        'uploads',
        'fileadmin'
    ]
);

set('clear_paths', [
    '.git',
    '.gitignore',
    'composer.json',
    'composer.lock',
    'composer.phar',
    '.gitattributes',
    '.env.dist',
    'dynamicReturnTypeMeta.json'
]);

set('bin/typo3cms', './vendor/bin/typo3cms');

// Look on https://github.com/sourcebroker/deployer-extended#file-rm2steps-1 for docs
set('file_remove2steps_items', [
    'typo3temp/var/Cache'
]);

// Look on https://github.com/sourcebroker/deployer-extended#buffer-start for docs
set('buffer_config', [
        'index.php' => [
            'entrypoint_filename' => 'index.php',
        ],
        'typo3/index.php' => [
            'entrypoint_filename' => 'typo3/index.php',
        ],
    ]
);

// Look https://github.com/sourcebroker/deployer-extended-media for docs
set('media',
    [
        'filter' => [
            '+ /fileadmin/',
            '- /fileadmin/_processed_/*',
            '+ /fileadmin/**',
            '+ /uploads/',
            '+ /uploads/**',
            '- *'
        ]
    ]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_default', [
    'truncate_tables' => [
        'cf_.*'
    ],
    'ignore_tables_out' => [
        'cf_.*',
        'cache_.*',
        'be_sessions',
        'fe_sessions',
        'fe_session_data',
        'sys_file_processedfile',
        'sys_history',
        'sys_log',
        'sys_refindex',
        'tx_devlog',
        'tx_extensionmanager_domain_model_extension',
        'tx_realurl_.*',
        'tx_powermail_domain_model_mail',
        'tx_powermail_domain_model_mails',
        'tx_powermail_domain_model_answer',
        'tx_powermail_domain_model_answers',
        'tx_solr_.*',
        'tx_crawler_queue',
        'tx_crawler_process',
    ],
    'post_sql_in' => '',
    'post_sql_in_markers' => '
                              UPDATE sys_domain SET hidden = 1;
                              UPDATE sys_domain SET sorting = sorting + 10;
                              UPDATE sys_domain SET sorting=1, hidden = 0 WHERE domainName IN ({{domainsSeparatedByComma}});
                              '
]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_databases',
    [
        'database_default' => [
            get('db_default'),
            (new \SourceBroker\DeployerExtendedTypo3\Drivers\Typo3EnvDriver)->getDatabaseConfig(
                [
                    'host' => 'TYPO3__DB__Connections__Default__host',
                    'port' => 'TYPO3__DB__Connections__Default__port',
                    'dbname' => 'TYPO3__DB__Connections__Default__dbname',
                    'user' => 'TYPO3__DB__Connections__Default__user',
                    'password' => 'TYPO3__DB__Connections__Default__password',
                ]
            ),
        ]
    ]
);

