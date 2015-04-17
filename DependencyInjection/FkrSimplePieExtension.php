<?php
namespace Fkr\SimplePieBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FkrSimplePieExtension extends Extension {

    const FKR_SIMPLE_PIE_RSS_SERVICE_NAME = 'fkr_simple_pie.rss';

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('fkr_simple_pie.cache_enabled', $config['cache_enabled']);
        $container->setParameter('fkr_simple_pie.cache_dir', $config['cache_dir']);
        $container->setParameter('fkr_simple_pie.cache_duration', $config['cache_duration']);

        if (
            isset($config['idna_converter']) &&
            $config['idna_converter'] &&
            $container->hasDefinition(self::FKR_SIMPLE_PIE_RSS_SERVICE_NAME)
        ) {
            $idnaConvertFilename = realpath(implode(DIRECTORY_SEPARATOR, [
                $container->getParameter('kernel.root_dir'),    // /app/
                '..',                                           // /
                'vendor',                                       // /vendor/
                'simplepie',                                    // /vendor/simplepie/
                'simplepie',                                    // /vendor/simplepie/simplepie/
                'idn',                                          // /vendor/simplepie/simplepie/idn/
                'idna_convert.class.php'                        // /vendor/simplepie/simplepie/idn/idna_convert.class.php
            ]));
            if (@is_file($idnaConvertFilename)) {
                $service = $container->getDefinition(self::FKR_SIMPLE_PIE_RSS_SERVICE_NAME);
                $service->setFile($idnaConvertFilename);
            }
        }
    }
}
