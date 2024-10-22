<?php

namespace CsvLoaderBenchmark\Benchmark;

use CsvLoaderBenchmark\Logger;
use CsvLoaderBenchmark\Utils;
use PhpOffice\PhpSpreadsheet\IOFactory;


class PhpOfficeBenchmark implements BenchmarkInterface
{

    public function execute(string $fileName): void
    {
        $columns = [
            'A' => 'addressTo',
            'B' => 'amount',
            'C' => 'currency',
            'D' => 'memo',
        ];

        $lastTime = Utils::getMicrotime();
        Logger::logMessage("Starting PhpOffice benchmark...", $lastTime);

        $reader = IOFactory::createReaderForFile($fileName);
        $reader->setReadDataOnly(true);
        Logger::logMessage("Initialized reader...", $lastTime);

        $spreadsheet = $reader->load($fileName);
        $sheet = $spreadsheet->getActiveSheet();

        Logger::logMessage("Loaded file into memory", $lastTime);

        $i = 1;
        $result = [];

        while ($sheet->getCell("A$i")->getValue() !== null) {
            $values = [];

            foreach ($columns as $column => $key) {
                $values[$key] = $sheet->getCell($column.$i)->getValue();
            }

            $result[] = $values;
            ++$i;
        }

        Logger::logMessage("Processed ".count($result)." rows", $lastTime);
    }

}
