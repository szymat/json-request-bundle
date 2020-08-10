<?php

namespace SymfonyBundles\JsonXmlRequestBundle\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

interface RequestListenerInterface
{
    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event): void;
}
