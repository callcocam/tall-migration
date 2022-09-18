<?php

return [
    'run_after_migrations' => env('TALL_RUN_AFTER_MIGRATIONS', false),
    'clear_output_path'    => env('TALL_CLEAR_OUTPUT_PATH', false),
    //default configs
    'table_naming_scheme' => env('TALL_TABLE_NAMING_SCHEME', '[IndexedTimestamp]_create_[TableName]_table.php'),
    'view_naming_scheme'  => env('TALL_VIEW_NAMING_SCHEME', '[IndexedTimestamp]_create_[ViewName]_view.php'),
    'path'                => env('TALL_OUTPUT_PATH', 'tests/database/migrations'),
    'skippable_tables'    => env('TALL_SKIPPABLE_TABLES', 'migrations'),
    'skip_views'          => env('TALL_SKIP_VIEWS', false),
    'skippable_views'     => env('TALL_SKIPPABLE_VIEWS', ''),
    'sort_mode'           => env('TALL_SORT_MODE', 'foreign_key'),
    'definitions'         => [
        'prefer_unsigned_prefix'              => env('TALL_PREFER_UNSIGNED_PREFIX', true),
        'use_defined_index_names'             => env('TALL_USE_DEFINED_INDEX_NAMES', true),
        'use_defined_foreign_key_index_names' => env('TALL_USE_DEFINED_FOREIGN_KEY_INDEX_NAMES', true),
        'use_defined_unique_key_index_names'  => env('TALL_USE_DEFINED_UNIQUE_KEY_INDEX_NAMES', true),
        'use_defined_primary_key_index_names' => env('TALL_USE_DEFINED_PRIMARY_KEY_INDEX_NAMES', true),
        'with_comments'                       => env('TALL_WITH_COMMENTS', true),
        'use_defined_datatype_on_timestamp'   => env('TALL_USE_DEFINED_DATATYPE_ON_TIMESTAMP', false),
    ],

    //now driver specific configs
    //null = use default
    'mysql' => [
        'table_naming_scheme' => env('TALL_MYSQL_TABLE_NAMING_SCHEME', null),
        'view_naming_scheme'  => env('TALL_MYSQL_VIEW_NAMING_SCHEME', null),
        'path'                => env('TALL_MYSQL_OUTPUT_PATH', null),
        'skippable_tables'    => env('TALL_MYSQL_SKIPPABLE_TABLES', null),
        'skippable_views'     => env('TALL_MYSQL_SKIPPABLE_VIEWS', null),
    ],
    'sqlite' => [
        'table_naming_scheme' => env('TALL_SQLITE_TABLE_NAMING_SCHEME', null),
        'view_naming_scheme'  => env('TALL_SQLITE_VIEW_NAMING_SCHEME', null),
        'path'                => env('TALL_SQLITE_OUTPUT_PATH', null),
        'skippable_tables'    => env('TALL_SQLITE_SKIPPABLE_TABLES', null),
        'skippable_views'     => env('TALL_SQLITE_SKIPPABLE_VIEWS', null),
    ],
    'pgsql' => [
        'table_naming_scheme' => env('TALL_PGSQL_TABLE_NAMING_SCHEME', null),
        'view_naming_scheme'  => env('TALL_PGSQL_VIEW_NAMING_SCHEME', null),
        'path'                => env('TALL_PGSQL_OUTPUT_PATH', null),
        'skippable_tables'    => env('TALL_PGSQL_SKIPPABLE_TABLES', null),
        'skippable_views'     => env('TALL_PGSQL_SKIPPABLE_VIEWS', null)
    ],
    'sqlsrv' => [
        'table_naming_scheme' => env('TALL_SQLSRV_TABLE_NAMING_SCHEME', null),
        'view_naming_scheme'  => env('TALL_SQLSRV_VIEW_NAMING_SCHEME', null),
        'path'                => env('TALL_SQLSRV_OUTPUT_PATH', null),
        'skippable_tables'    => env('TALL_SQLSRV_SKIPPABLE_TABLES', null),
        'skippable_views'     => env('TALL_SQLSRV_SKIPPABLE_VIEWS', null),
    ],
];
