<?php

namespace CsvLoaderBenchmark;

class Logger {

    public static function logMessage(string $message, float &$lastTime): void
    {
        $currentTime = Utils::getMicrotime();
        $elapsedTime = $currentTime - $lastTime;
        $lastTime = $currentTime;
        $memoryUsage = Utils::getMemory();

        printf("[%0.6fs] [%s]\t%s\n", $elapsedTime, $memoryUsage, $message);
    }

}
