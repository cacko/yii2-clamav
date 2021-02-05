<?php
namespace Cacko\ClamAv\Driver;

use Cacko\ClamAv\Exception\ConfigurationException;

/**
 * Class DriverFactory
 * @package Cacko\ClamAv\Driver
 */
class DriverFactory
{
    /**
     * Available drivers
     * @var array
     */
    const DRIVERS = [
        'clamscan' => ClamscanDriver::class,
        'clamd_local' => ClamdDriver::class,
        'clamd_remote' => ClamdRemoteDriver::class,
        'default' => ClamscanDriver::class,
    ];

    /**
     * @inheritdoc
     * @throws ConfigurationException
     */
    public static function create(array $config)
    {
        if (empty($config['driver'])) {
            throw new ConfigurationException('ClamAV driver required, please check your config.');
        }

        if (!array_key_exists($config['driver'], static::DRIVERS)) {
            throw new ConfigurationException(
                sprintf(
                    'Invalid driver "%s" specified. Available options are: %s',
                    $config['driver'],
                    join(', ', array_keys(static::DRIVERS))
                )
            );
        }

        $driver = static::DRIVERS[$config['driver']];
        unset($config['driver']);
        return new $driver($config);
    }
}
