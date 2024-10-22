# CSV Loader Benchmark

This project benchmarks different CSV loading libraries in PHP. It supports the following libraries:
- PhpOffice
- OpenSpout
- Vanilla PHP

## Requirements

- PHP >= 8.1
- Composer

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/vershart/csv-loader-benchmark.git
    cd csv-loader-benchmark
    ```

2. Install dependencies:
    ```sh
    composer install
    ```

## Usage

To run a benchmark, use the following command:
    ```sh
    php bench.php <benchmarkName> <rowCount>
    ```

For example, to run the benchmark for PhpOffice with 100 000 rows:
    ```sh
    php bench.php phpoffice 100 000
    ```
