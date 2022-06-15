<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ECSConfig $ecsConfig): void {
    // A. full sets
    $ecsConfig->import(SetList::PSR_12);
    $ecsConfig->import(SetList::CLEAN_CODE);
    $ecsConfig->import(SetList::DOCTRINE_ANNOTATIONS);
    $ecsConfig->import(SetList::SPACES);

    $parameters = $ecsConfig->parameters();
    $parameters->set(Option::SKIP, [
        NotOperatorWithSuccessorSpaceFixer::class,
    ]);


    // B. standalone rule
    $services = $ecsConfig->services();
    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);
};
