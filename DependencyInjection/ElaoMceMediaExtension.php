<?php

namespace Elao\Bundle\MceMediaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * ElaoMceMedia Extension
 */
class ElaoMceMediaExtension extends Extension
{

    /**
     * load configuration
     *
     * @param array            $configs   configs
     * @param ContainerBuilder $container container
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('elao_mce_media.configuration.parameters.is_login', $config['is_login']);
        $container->setParameter('elao_mce_media.configuration.parameters.role', $config['role']);
        $container->setParameter('elao_mce_media.configuration.parameters.secret_key', $config['secret_key']);
        $container->setParameter('elao_mce_media.configuration.parameters.configs', $config['configs']);

        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config/')));
        $loader->load('services.xml');
    }
}