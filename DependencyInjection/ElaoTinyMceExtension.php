<?php

namespace Elao\TinyMceBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * ElaoTinyMce Extension
 */
class ElaoTinyMceExtension extends Extension
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

        $container->setParameter('elao.tiny_mce.configuration.is_login', $config['is_login']);
        $container->setParameter('elao.tiny_mce.configuration.role', $config['role']);
        $container->setParameter('elao.tiny_mce.configuration.secret_key', $config['secret_key']);
        $container->setParameter('elao.tiny_mce.configuration.configs', $config['configs']);

        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config/')));
        $loader->load('services.xml');
    }
}