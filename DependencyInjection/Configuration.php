<?php
/*
 * This file is part of the SocialNetworkBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\SocialNetworkBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fulgurio_social_network');
        $this->addAdminUserMailsSection($rootNode);
        return $treeBuilder;
    }

    /**
     * Admin user mails configuration
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addAdminUserMailsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('admin_email')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('contact')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('from')->end()
                            ->end()
                            ->children()
                                ->scalarNode('text')->defaultValue('FulgurioSocialNetworkBundle:AdminUsers:contact_email.txt.twig')->end()
                            ->end()
                            ->children()
                                ->scalarNode('html')->defaultValue('FulgurioSocialNetworkBundle:AdminUsers:contact_email.html.twig')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end();
    }
}