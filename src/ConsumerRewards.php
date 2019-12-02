<?php namespace ConsumerRewards\SDK;

use ConsumerRewards\SDK\Apis\Marketing;
use ConsumerRewards\SDK\Apis\Packs;
use ConsumerRewards\SDK\Apis\Qrs;
use ConsumerRewards\SDK\Config\ConfigFactory;
use ConsumerRewards\SDK\Exception\ConsumerRewardsException;
use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\NetTools;
use ConsumerRewards\SDK\Tools\RequestFactory;
use Doctrine\Common\Annotations\AnnotationRegistry;

class ConsumerRewards
{
    const VERSION = '1.0';

    /**
     * Constructs a ConsumerRewards SDK instance.
     *
     * @param array $config An array of mandatory options to set SDK.
     *     Config include `username`, `password`, `api`, `web`.
     *
     * @param array $options An array of collaborators that may be used to
     *     override the SDK's default behavior. Collaborators include:
     *
     *      PSR-7: `httpClient`: ClientInterface instance (Guzzle by default).
     *      PSR-17: `requestFactory`
     *      PSR-3: `logger`: LoggerInterface instance (Monolog by default)
     *          `logLevel`: define log level Psr\Log\LogLevel value for default LoggerInterface (DEBUG by default)
     *          `logDir`: define log directory for the default LoggerInterface (root by default)
     *      PSR-16: `cache`: AbstractCachePool instance (FileSystem by default) http://www.php-cache.com/en/latest/#cache-pool-implementations
     *
     * @throws ConsumerRewardsException Some error exist (ConnectException, ....)
     * @throws ConsumerRewardsSdkAuthException If auth connection fail
     *
     */
    public function __construct(array $config = [], array $options = [])
    {
        try {
            AnnotationRegistry::registerLoader('class_exists');

            $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
            AnnotationRegistry::registerAutoloadNamespace(
                'JMS\Serializer\Annotation',
                dirname(dirname($reflection->getFileName())) . "/jms/serializer/src"
            );
        } catch (\ReflectionException $e) {
            throw new ConsumerRewardsException("Error setting SDK");
        }

        $this->autoConfig($config, $options);

        Container::set('marketingApi', new Marketing());
        Container::set('qrsApi', new Qrs());
        Container::set('packsApi', new Packs());

    }

    protected function autoConfig(array $config = [], array $options = []) {
        $configFactory = new ConfigFactory();
        $configFactory->assertRequiredOptions($config);

        if (empty($options['logger'])) {
            // Define default LogginInterface library (Monolog)
            $options['logger'] = $configFactory->getConfig('logger')->set($options);
        }
        Container::set('logger', $options['logger']);

        if (empty($options['requestFactory'])) {
            // Define default Request Factory
            $options['requestFactory'] = new RequestFactory();
        }
        if (empty($options['httpClient'])) {
            // Define de Default Http Client (Guzzle)
            $options['httpClient'] = $configFactory->getConfig('http')->set($options);
        }

        Container::set('http', new NetTools($options['httpClient'], $options['requestFactory'], ['api' => $config['api'], 'web' => $config['web']]));

        if (empty($options['cache'])) {
            // Define default Cache (File System)
            $options['cache'] = $configFactory->getConfig('cache')->set($options);
        }
        Container::set('cache', $options['cache']);

        $jwt = $configFactory->getConfig('JWT')->set($config);
        Container::set('JWT', $jwt);
    }

    /**
     * @return Marketing
     */
    public function getMarketing(): Marketing
    {
        return Container::get('marketingApi');
    }

    /**
     * @return Qrs
     */
    public function getQrs(): Qrs
    {
        return Container::get('qrsApi');
    }

    /**
     * @return Packs
     */
    public function getPacks(): Packs
    {
        return Container::get('packsApi');
    }

}
