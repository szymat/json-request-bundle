<?php

namespace SymfonyBundles\JsonXmlRequestBundle\Tests\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use SymfonyBundles\JsonXmlRequestBundle\Tests\TestCase;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use SymfonyBundles\JsonXmlRequestBundle\DependencyInjection\Configuration;

class ConfigurationTest extends TestCase
{
    public function testConfiguration()
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $this->assertInstanceOf(ConfigurationInterface::class, $configuration);

        $configs = $processor->processConfiguration($configuration, []);

        $this->assertArraySubset([], $configs);
    }
}
