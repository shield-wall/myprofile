<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Php80\Rector\Class_\DoctrineAnnotationClassToAttributeRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src'
    ]);

    // Define what rule sets will be applied
//    $containerConfigurator->import(LevelSetList::UP_TO_PHP_80);
//    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_ORM_29);

     $services = $containerConfigurator->services();
     $services->set(TypedPropertyRector::class);
     $services->set(DoctrineAnnotationClassToAttributeRector::class)
         ->configure([
             DoctrineAnnotationClassToAttributeRector::REMOVE_ANNOTATIONS => true
         ])
     ;
};
