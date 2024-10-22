<?php

namespace CsvLoaderBenchmark\Benchmark;

use CsvLoaderBenchmark\Logger;
use CsvLoaderBenchmark\Utils;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Reader\CSV\Reader;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;


class OpenSpoutBenchmark implements BenchmarkInterface
{

    /**
     * @throws IOException
     * @throws ReaderNotOpenedException
     */
    public function execute(string $fileName): void
    {
        $columns = [
            'addressTo',
            'amount',
            'currency',
            'memo',
        ];

        $lastTime = Utils::getMicrotime();
        Logger::logMessage("Starting OpenSpout benchmark...", $lastTime);

        $reader = new Reader();
        Logger::logMessage("Initialized reader...", $lastTime);

        $reader->open($fileName);
        $sheet = $reader->getSheetIterator()->current();

        Logger::logMessage("Loaded file into memory", $lastTime);

        $i = 1;
        $result = [];

        foreach ($sheet->getRowIterator() as $row) {
            $values = [];
            $cellIndex = 0;

            foreach ($columns as $column) {
                $values[$column] = $row->getCellAtIndex($cellIndex)->getValue();
                $cellIndex++;
            }

            $result[] = $values;
            ++$i;
        }

        Logger::logMessage("Processed ".count($result)." rows", $lastTime);
    }

}
