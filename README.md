# LiveAgent v3 REST API Client
[![Build Status](https://travis-ci.org/pavolbiely/liveagent.svg?branch=master)](https://travis-ci.org/pavolbiely/neoship)
[![Coverage Status](https://coveralls.io/repos/github/pavolbiely/liveagent/badge.svg?branch=master)](https://coveralls.io/github/pavolbiely/liveagent?branch=master)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BHZKXCWAK2NNS)

This is an unofficial LiveAgent API v3 PHP Client. QualityUnit does not provide official one yet.

**This is still an unstable development version. Currently only all GET requests are implemented and POST to create a ticket and a file. Feel free to contribute and add any missing requests.**

![LiveAgent Logo](https://www.ladesk.com/fileadmin/templates/less/img/la-logo.svg)

## Installation

Use composer to install this package.

## Example of usage

Create a new LiveAgentAPI client instance
```php
$la = new QualityUnit\LiveAgentApi('https://yourliveagantdomain.com/api/v3', 'api_key');

$ticket = new QualityUnit\Ticket('Test API', 'This is a testing message.', 'recipient@example.org', 'user@example.org');

print_r($la->createTicket($ticket));
```

## How to run tests?
Tests are build with [Nette Tester](https://tester.nette.org/). You can run it like this:
```bash
php -f tester ./ -c php.ini-mac --coverage coverage.html --coverage-src ../src
```

## Minimum requirements
- PHP 7.1+
- php-curl

## License
MIT License (c) Pavol Biely

Read the provided LICENSE file for details.

# Links
- [API reference](https://support.ladesk.com/docs/api/v3/)
- [Official REST API docs](https://support.ladesk.com/066804-LiveAgent-API)
- [Official website](https://www.ladesk.com)
