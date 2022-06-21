<?php declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$tag = new Pggns\LiveAgent\Tag('Test API', '#ffffff', '#000000', 'Y');

// required params
Assert::same('Test API', $tag->getName());
Assert::same('#ffffff', $tag->getColor());
Assert::same('#000000', $tag->getBackgroundColor());
Assert::true($tag->getIsPublic());

// json result
Assert::same([
	'name' => 'Test API',
], $tag->toArray());

$tag->setColor('#ffffff');
$tag->setBackgroundColor('#000000');
Assert::true($tag->getIsPublic());

// json result
Assert::same([
	'name' => 'Test API',
	'color' => '#ffffff',
	'background_color' => '#000000',
	'is_html_message' => 'N',
], $tag->toArray());
