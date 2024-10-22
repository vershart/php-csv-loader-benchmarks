<?php

namespace CsvLoaderBenchmark\Benchmark;

use CsvLoaderBenchmark\Logger;
use CsvLoaderBenchmark\Utils;


class VanillaBenchmark implements BenchmarkInterface
{

    public function execute(string $fileName): void
    {
        $columns = [
            'addressTo',
            'amount',
            'currency',
            'memo',
        ];

        $lastTime = Utils::getMicrotime();
        Logger::logMessage("Starting PHP Vanilla CSV benchmark...", $lastTime);

        $fileHandler = fopen($fileName, 'r');

        Logger::logMessage("Initialized reader...", $lastTime);
        Logger::logMessage("Loaded file into memory", $lastTime);

        $i = 1;
        $result = [];

        while (($row = fgetcsv($fileHandler)) !== false) {
            $values = [];

            $currentColumn = 0;

            foreach ($columns as $column) {
                $values[$column] = $row[$currentColumn];
                $currentColumn++;
            }

            $result[] = $values;
            ++$i;
        }

        Logger::logMessage("Processed ".count($result)." rows", $lastTime);
    }

}
