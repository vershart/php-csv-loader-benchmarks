<?php

namespace CsvLoaderBenchmark;

class FileGenerator
{

    const RANDOM_ADDRESS_ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
    const ADDRESS_PREFIX = 'UQ';
    const AVAILABLE_CURRENCIES = ['usd', 'ton'];

    private static function generateRandomTonAddress(): string
    {
        $address = self::ADDRESS_PREFIX;

        for ($i = 0; $i < 32; $i++) {
            $address .= self::RANDOM_ADDRESS_ALPHABET[rand(0, strlen(self::RANDOM_ADDRESS_ALPHABET) - 1)];
        }

        return $address;
    }

    private static function generateRandomAmount(): float
    {
        return 0.0 + mt_rand() / mt_getrandmax() * 1000.0;
    }

    private static function generateRandomCurrency(): string
    {
        return self::AVAILABLE_CURRENCIES[array_rand(self::AVAILABLE_CURRENCIES)];
    }

    private static function generateRandomMemo(): string
    {
        $length = rand(0, 25);
        $memo = '';

        for ($i = 0; $i < $length; $i++) {
            $memo .= self::RANDOM_ADDRESS_ALPHABET[rand(0, strlen(self::RANDOM_ADDRESS_ALPHABET) - 1)];
        }

        return $memo;
    }


    private static function generateRandomRow(): array
    {
        return [
            self::generateRandomTonAddress(),
            number_format(self::generateRandomAmount(), 2),
            self::generateRandomCurrency(),
            self::generateRandomMemo(),
        ];
    }

    public static function generateFile(string $filePath, int $rowCount, string $separator = ','): bool
    {
        $file = fopen($filePath, 'w');

        if (!$file) {
            return false;
        }

        for ($i = 0; $i < $rowCount; $i++) {
            fputcsv($file, self::generateRandomRow(), $separator);
        }

        fclose($file);

        return true;
    }
    
}
