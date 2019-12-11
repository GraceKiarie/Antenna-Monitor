<?php

namespace App\Logs;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Monolog\Formatter\NormalizerFormatter;
use function GuzzleHttp\Psr7\str;

class LogFormatter extends NormalizerFormatter
{
    /**
     * type
     */
    const LOG = 'access';
    const STORE = 'create';
    const CHANGE = 'change';
    const DELETE = 'delete';
    /**
     * result
     */
    const SUCCESS = 'success';
    const NEUTRAL = 'neutral';
    const FAILURE = 'failure';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {
        $record = parent::format($record);
        return $this->getDocument($record);
    }

    /**
     * Convert a log message into an MariaDB Log entity
     * @param array $record
     * @return array
     */
    protected function getDocument(array $record)
    {
        $fills = $record['extra'];
        $fills['level'] =Str::lower($record['level_name']);
        $fills['description'] = $record['message'];
        $fills['token'] =Str::random(30);
        $context = $record['context'];
        if (!empty($context)) {
            $fills['type'] =  Arr::has($context, 'type') ? $context['type'] : self::LOG;
            $fills['result'] =  Arr::has($context, 'result') ? $context['result'] : self::NEUTRAL;
            $fills = array_merge($record['context'], $fills);
        }
        return $fills;
    }
}
