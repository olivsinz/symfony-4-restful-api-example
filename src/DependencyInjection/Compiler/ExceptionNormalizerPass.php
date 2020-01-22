<?php

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExceptionNormalizerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $exceptionSubscriberDefinition = $container->findDefinition('App\EventSubscriber\ExceptionSubscriber');
        $normalizers = $container->findTaggedServiceIds('app.normalizer');

        foreach ($normalizers as $id => $tags) {
            $exceptionSubscriberDefinition->addMethodCall('addNormalizer', [new Reference($id)]);
        }
    }
}
