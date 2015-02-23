<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TuByuem\Skrobaczka\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * Description of AddMappingPass.
 *
 * @author TuByuem <tubyuem@wp.pl>
 */
class AddMappingPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $mappingTags = $container->findTaggedServiceIds('mapping');
        $converterIds = array_keys($container->findTaggedServiceIds('model_converter'));
        foreach ($converterIds as $converterId) {
            $this->addMappingsToConverter($container, $converterId, $mappingTags);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $converterId
     * @param array            $mappingTags
     */
    private function addMappingsToConverter(ContainerBuilder $container, $converterId, array $mappingTags)
    {
        $converterDefinition = $container->getDefinition($converterId);
        foreach ($mappingTags as $mappingId => $tags) {
            $mappingReference = new Reference($mappingId);
            foreach ($tags as $tag) {
                $this->validateTag($mappingId, $tag);
                $converterDefinition->addMethodCall(
                    'addMapping',
                    [$mappingReference, $tag['alias']]
                );
            }
        }
    }

    /**
     * @param string $mappingId
     * @param array  $tag
     *
     * @throws InvalidConfigurationException
     */
    private function validateTag($mappingId, array $tag)
    {
        if (!isset($tag['alias'])) {
            throw new InvalidConfigurationException(sprintf('Alias attribute is required in %s mapping service definition.', $mappingId));
        }
    }
}
