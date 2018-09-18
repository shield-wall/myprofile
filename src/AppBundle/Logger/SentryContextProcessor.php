<?php

namespace AppBundle\Logger;


class SentryContextProcessor
{
    private $environment;
    private $locale;

    public function __construct(
        $environment,
        $locale
    ) {
        $this->environment = $environment;
        $this->locale = $locale;
    }

    public function __invoke(array $record): array
    {
        $record['context']['tags']['environment'] = $this->environment;
        $record['context']['tags']['locale'] = $this->locale;

        return $record;
    }
}