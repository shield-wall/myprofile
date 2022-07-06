<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->phpstanConfig(getcwd() . '/phpstan.neon');
    $rectorConfig->importNames();
    $rectorConfig->paths([
        __DIR__ . '/src',
    ]);

    $rectorConfig->skip([
        UnionTypesRector::class,
        VarConstantCommentRector::class,
        ChangeOrIfReturnToEarlyReturnRector::class,
    ]);

    // Define what rule sets will be applied
    $rectorConfig->phpVersion(PhpVersion::PHP_81);
    $rectorConfig->sets([
        SetList::PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::MONOLOG_20,
        SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION,
        SetList::CODING_STYLE,
        SetList::FRAMEWORK_EXTRA_BUNDLE_50,

        DoctrineSetList::DOCTRINE_CODE_QUALITY,
        DoctrineSetList::DOCTRINE_ORM_29,
        DoctrineSetList::DOCTRINE_DBAL_30,
        DoctrineSetList::ANNOTATIONS_TO_ATTRIBUTES,
        DoctrineSetList::DOCTRINE_BEHAVIORS_20,

        SymfonyLevelSetList::UP_TO_SYMFONY_54,
        SymfonySetList::SYMFONY_54,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
        SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES,
        SymfonySetList::SYMFONY_52_VALIDATOR_ATTRIBUTES,
        SymfonySetList::SYMFONY_50_TYPES,
        SymfonySetList::SYMFONY_STRICT,

    ]);

    // get services (needed for register a single rule)
     $services = $rectorConfig->services();

    // register a single rule
     $services->set(TypedPropertyRector::class);
};
