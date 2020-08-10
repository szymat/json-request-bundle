<?php

namespace SymfonyBundles\JsonXmlRequestBundle\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestTransformerListener implements RequestListenerInterface
{
    /**
     * {@inheritdoc}
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (false === $this->isAvailable($request)) {
            return;
        }

        if (false === $this->transform($request)) {
            $response = new Response('Unable to parse request.', Response::HTTP_BAD_REQUEST);

            $event->setResponse($response);
        }
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function isAvailable(Request $request): bool
    {
        return in_array($request->getContentType(), ['json', 'xml']) && $request->getContent();
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function transform(Request $request): bool
    {
        $content = $request->getContent();

        // Transform xml to json request
        if ($request->getContentType() === 'xml') {
            $xml = \simplexml_load_string($content);
            $content = \json_encode($xml);
        }

        $data = \json_decode($content, true);

        if (\json_last_error() !== \JSON_ERROR_NONE) {
            return false;
        }

        if (\is_array($data)) {
            $request->request->replace($data);
        }

        return true;
    }
}
