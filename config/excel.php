<?php

use Maatwebsite\Excel\Excel;

return [
    'exports' => [
        'chunk_size' => 1000,
        'pre_calculations' => true,
        'csv' => [
            'delimiter' => ',',
            'enclosure' => '"',
            'line_ending' => PHP_EOL,
            'use_bom' => false,
            'include_separator_line' => false,
            'excel_compatibility' => false,
            'output_encoding' => '',
            'input_encoding' => 'UTF-8',
        ],
    ],
    'imports' => [
        'read_only' => true,
        'heading_row_fallback' => null,
        'csv' => [
            'delimiter' => ',',
            'enclosure' => '"',
            'escape_character' => '\\',
            'input_encoding' => 'UTF-8',
        ],
    ],
    'extension' => [
        'xlsx' => Excel::XLSX,
        'xlsm' => Excel::XLSX,
        'xltx' => Excel::XLSX,
        'csv' => Excel::CSV,
        'tsv' => Excel::TSV,
        'ods' => Excel::ODS,
        'xls' => Excel::XLS,
    ],
    'temporary_files' => [
        'local_path' => storage_path('app/laravel-excel'),
        'remote_disk' => null,
        'use_remote' => false,
        'force_resync_remote' => null,
    ],
];
