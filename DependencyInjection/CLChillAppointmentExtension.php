<?php

namespace CL\Chill\AppointmentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CLChillAppointmentExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    public function prepend(ContainerBuilder $container) {
        
        //register AppointmentBundle into assetic
        // get all Bundles
        $bundles = $container->getParameter('kernel.bundles');
        
        if (!isset($bundles['AsseticBundle'])) {
            throw new Exception("You must use Assetic Bundle");
        }
        
        $asseticConfig = $container->getExtensionConfig('assetic');
        //die(var_dump($asseticConfig));
        
        array_push($asseticConfig[0]['bundles'], 'CLChillAppointmentBundle');
        
        $config['bundles'] = $asseticConfig[0]['bundles'];
        
        $container->prependExtensionConfig('assetic', $config);
    }

}
