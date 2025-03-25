<?php

declare(strict_types=1);

/*
 * This file is part of the hands-on-ekino-php/your-client project.
 *
 * (c) Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HandsOnEkinoPhp\YourClient\Client;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TodosClient
{
    public function __construct(private HttpClientInterface $client, private bool $clockHeader)
    {
    }

    /**
     * @param array<mixed> $options
     */
    public function getTodos(array $options = []): JsonResponse
    {
        $response = $this->client->request(Request::METHOD_GET, 'todos', $options);

        $headers = $response->getHeaders();
        $headers = $this->addCookieHeader($headers);
        if ($this->clockHeader) {
            $headers = $this->addClockHeader($headers);
        }

        return new JsonResponse($response->getContent(), $response->getStatusCode(), $headers, true);
    }

    /**
     * @param array<string, array<string, string>|string> $header
     *
     * @return array<string, array<string, string>|string>
     */
    private function addClockHeader(array $header): array
    {
        date_default_timezone_set('Europe/Paris');
        $currentHour = date('G');

        $clockEmojis = [
            0 => '🕛', 1 => '🕐', 2 => '🕑', 3 => '🕒', 4 => '🕓', 5 => '🕔',
            6 => '🕕', 7 => '🕖', 8 => '🕗', 9 => '🕘', 10 => '🕙', 11 => '🕚',
            12 => '🕛', 13 => '🕐', 14 => '🕑', 15 => '🕒', 16 => '🕓', 17 => '🕔',
            18 => '🕕', 19 => '🕖', 20 => '🕗', 21 => '🕘', 22 => '🕙', 23 => '🕚',
        ];

        $clockEmoji = $clockEmojis[$currentHour];
        $header['X-Request-Clock'] = $clockEmoji;

        return $header;
    }

    /**
     * @param array<string, array<string, string>|string> $header
     *
     * @return array<string, array<string, string>|string>
     */
    private function addCookieHeader(array $header): array
    {
        $header['X-Request-Cookie'] = '🍪';

        return $header;
    }
}
