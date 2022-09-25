<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

trait ElasticSearchUtils
{
    public function prepareSearchText(?string $text): ?string
    {
        if (null === $text) {
            return null;
        }

        $parts = preg_split('/\s+/', $text);

        if (false === $parts) {
            return $text;
        }

        $finalParts = [];
        foreach ($parts as $i => $part) {
            if ($part === '') {
                continue;
            }

            if ($i === (sizeof($parts) - 1)) {
                $finalParts[] = $this->addPlusIfIsNotAlreadyInWord($part) . '*';
            } else {
                $finalParts[] = $this->addPlusIfIsNotAlreadyInWord($part);
            }
        }

        return join(' ', $finalParts);
    }

    private function addPlusIfIsNotAlreadyInWord(string $word): string
    {
        if (str_starts_with($word, '+')) {
            return $word;
        }
        return '+' . $word;
    }
}