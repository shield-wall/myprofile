<?php

declare(strict_types=1);

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

uses(ApiTestCase::class)->beforeEach(static fn () => static::bootKernel())->in('Feature');
