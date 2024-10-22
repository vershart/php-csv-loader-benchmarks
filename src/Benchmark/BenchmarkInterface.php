<?php

namespace CsvLoaderBenchmark\Benchmark;

interface BenchmarkInterface
{

    public function execute(string $fileName): void;

}
