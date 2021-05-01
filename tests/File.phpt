<?php declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

/**
 * Check construct exception
 */
Assert::exception(static function () {
    new QualityUnit\File('example');
}, RuntimeException::class);

/**
 * Check getters
 */
$file = new QualityUnit\File(__DIR__ . '/source/test_file.txt');
Assert::same(__DIR__ . '/source/test_file.txt', $file->getPath());
Assert::same('test_file.txt', $file->getName());
Assert::same('txt', $file->getExtension());
Assert::same('text/plain', $file->getMimeType());
Assert::true(isset($file->toArray()['file']));
Assert::same('CURLFile', get_class($file->toArray()['file']));
Assert::same(__DIR__ . '/source/test_file.txt', $file->toArray()['file']->getFilename());
unset($file);

/**
 * Check setters
 */
$file = new QualityUnit\File(__DIR__ . '/source/test_file.txt');
$file->setPath('example/path/test_file.txt');
Assert::same('example/path/test_file.txt', $file->getPath());
$file->setExtension('png');
Assert::same('png', $file->getExtension());
Assert::same('example/path/test_file.txt', $file->getPath());
Assert::same('test_file.txt', $file->getName());
$file->setName('example_name.txt');
Assert::same('example_name.txt', $file->getName());
Assert::same('png', $file->getExtension());
Assert::same('example/path/test_file.txt', $file->getPath());
$file->setMimeType('example/type');
Assert::same('example/type', $file->getMimeType());
Assert::same('example_name.txt', $file->getName());
Assert::same('png', $file->getExtension());
Assert::same('example/path/test_file.txt', $file->getPath());
