<?php

namespace CsvLoaderBenchmark;

use CsvLoaderBenchmark\Benchmark\BenchmarkInterface;

class App
{

    /**
     * @var BenchmarkInterface[]
     */
    public static array $benchmarks = [
        'phpoffice' => Benchmark\PhpOfficeBenchmark::class,
        'openspout' => Benchmark\OpenSpoutBenchmark::class,
        'vanilla' => Benchmark\VanillaBenchmark::class,
    ];
    
    public function run(string $benchmark, string $filePath, int $rowCount): void
    {
        $benchStart = Utils::getMicrotime();

        if (!array_key_exists($benchmark, self::$benchmarks)) {
            Logger::logMessage("Benchmark not found", $benchStart);
            exit(-1);
        }

        Logger::logMessage("Starting benchmark...", $benchStart);
        Logger::logMessage("Checking if file exists... ".(file_exists($filePath) ? 'YES' : 'NO'), $benchStart);

        if (file_exists($filePath) && !unlink($filePath)) {
            Logger::logMessage("Could not delete file", $benchStart);
            exit(-2);
        }

        if (!FileGenerator::generateFile($filePath, $rowCount)) {
            Logger::logMessage("Could not generate new file", $benchStart);
            exit(-3);
        }

        Logger::logMessage("File generated", $benchStart);

        $benchmarkInstance = new self::$benchmarks[$benchmark]();
        $benchStart = Utils::getMicrotime();

        Logger::logMessage("Executing benchmark: ".$benchmark, $benchStart);
        $benchmarkInstance->execute($filePath);
        Logger::logMessage("Finished benchmark: ".$benchmark, $benchStart);

        unset($benchmarkInstance);
    }
    
}
