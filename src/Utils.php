<?php

namespace CsvLoaderBenchmark;

class Utils
{

    public static function getMemory(): string
    {
        $memoryUsageBytes = memory_get_usage();
        if ($memoryUsageBytes < 1024) {
            return sprintf('%d B', $memoryUsageBytes);
        }

        $memoryUsageKBytes = $memoryUsageBytes / 1024;
        if ($memoryUsageKBytes < 1024) {
            return sprintf('%0.2f KB', $memoryUsageKBytes);
        }

        $memoryUsageMBytes = $memoryUsageKBytes / 1024;

        return sprintf('%0.2f MB', $memoryUsageMBytes);
    }

    public static function getMicrotime(): float
    {
        return microtime(true);
    }
}
