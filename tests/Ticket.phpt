<?php declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$ticket = new Pggns\LiveAgent\Ticket('Test API', 'This is a testing message.', 'recipient@example.org', 'user@example.org', '12345678');

// required params
Assert::same('Test API', $ticket->getSubject());
Assert::same('This is a testing message.', $ticket->getMessage());
Assert::same('recipient@example.org', $ticket->getRecipient());
Assert::same('user@example.org', $ticket->getUserIdentifier());
Assert::same('12345678', $ticket->getDepartmentId());
Assert::true($ticket->getIsHtmlMessage());
Assert::true($ticket->getDoNotSendEmail());
Assert::true($ticket->getUseTemplate());

// json result
Assert::same([
	'subject' => 'Test API',
	'message' => 'This is a testing message.',
	'recipient' => 'recipient@example.org',
	'useridentifier' => 'user@example.org',
	'departmentid' => '12345678',
	'do_not_send_mail' => 'Y',
	'is_html_message' => 'Y',
	'status' => 'I',
	'use_template' => 'Y',
], $ticket->toArray());

// optional params
$ticket->setRecipientName('Tester');
$ticket->setStatus($ticket::STATUS_NEW);
$ticket->setCc('copy@example.org');
$ticket->setDateCreated(new \DateTime('2019-01-01'));
$ticket->setIsHtmlMessage(false);
$ticket->setDoNotSendEmail(false);
$ticket->setUseTemplate(false);
$ticket->setMailMessageId('123');
Assert::false($ticket->getIsHtmlMessage());
Assert::false($ticket->getDoNotSendEmail());
Assert::false($ticket->getUseTemplate());

Assert::same('Tester', $ticket->getRecipientName());
Assert::same('copy@example.org', $ticket->getCc());
Assert::same('123', $ticket->getMailMessageId());
Assert::same('N', $ticket->getStatus());

Assert::true($ticket->getDateCreated() instanceof \DateTime);
Assert::same('2019-01-01', $ticket->getDateCreated()->format('Y-m-d'));

Assert::same([], $ticket->getAttachments());
$ticket->setAttachments(['A', 'B', 'C']);
Assert::same(['A', 'B', 'C'], $ticket->getAttachments());
$ticket->addAttachment('D');
Assert::same(['A', 'B', 'C', 'D'], $ticket->getAttachments());
$ticket->setAttachments(['A', 'B']);
Assert::same(['A', 'B'], $ticket->getAttachments());

Assert::same([], $ticket->getTags());
$ticket->setTags(['A', 'B', 'C']);
Assert::same(['A', 'B', 'C'], $ticket->getTags());
$ticket->addTag('D');
Assert::same(['A', 'B', 'C', 'D'], $ticket->getTags());
$ticket->setTags(['A', 'B']);
Assert::same(['A', 'B'], $ticket->getTags());

Assert::same([], $ticket->getCustomFields());
$ticket->setCustomFields(['A' => 'X', 'B' => 'Y', 'C' => 'Z']);
Assert::same(['A' => 'X', 'B' => 'Y', 'C' => 'Z'], $ticket->getCustomFields());
$ticket->setCustomField('D', 'W');
Assert::same(['A' => 'X', 'B' => 'Y', 'C' => 'Z', 'D' => 'W'], $ticket->getCustomFields());
$ticket->setCustomField('A', null);
Assert::same(['B' => 'Y', 'C' => 'Z', 'D' => 'W'], $ticket->getCustomFields());

// json result
Assert::same([
	'subject' => 'Test API',
	'message' => 'This is a testing message.',
	'recipient' => 'recipient@example.org',
	'useridentifier' => 'user@example.org',
	'departmentid' => '12345678',
	'attachments' => 'A,B',
	'carbon_copy' => 'copy@example.org',
	'date_created' => 'Tue, 01 Jan 2019 00:00:00 +0000',
	'do_not_send_mail' => 'N',
	'is_html_message' => 'N',
	'mail_message_id' => '123',
	'recipient_name' => 'Tester',
	'status' => 'N',
	'tags' => ['A', 'B'],
	'use_template' => 'N',
	'custom_fields' => [
		['code' => 'B', 'value' => 'Y'],
		['code' => 'C', 'value' => 'Z'],
		['code' => 'D', 'value' => 'W'],
	],
], $ticket->toArray());
