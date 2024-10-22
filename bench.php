<?php

require_once __DIR__.'/vendor/autoload.php';

use CsvLoaderBenchmark\App;

ini_set('memory_limit', '2048M');

if ($argc < 3) {
    printf("Usage: php bench.php <benchmarkName>\n");
    printf("Available benchmarks: %s\n", implode(', ', array_keys(App::$benchmarks)));

    exit(1);
}

list (,$benchmarkName,$rowCount) = $argv;

$rowCount = (int)$rowCount;

$filePath = join(DIRECTORY_SEPARATOR, [__DIR__, 'test.csv']);

$benchmark = new App();
$benchmark->run($benchmarkName, $filePath, $rowCount);
