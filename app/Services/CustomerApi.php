<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class CustomerApi
{
    const EXTERNAL_DATA = [
        [
            'id' => 1000,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com'
        ],
        [
            'id' => 2000,
            'name' => 'Jane Doe',
            'email' => 'Jane.doe@example.com'
        ],
        [
            'id' => 3000,
            'name' => 'Acme Company',
            'email' => 'acme@example.com'
        ],
    ];

    public function get()
    {
        return collect(static::EXTERNAL_DATA);
    }

    public function find(int $id): ?object
    {
        return (object) self::get()
            ->first(fn($item) => $item['id'] === $id) ?? null;
    }

    public function search(string $search): Collection
    {
        return self::get()
            ->filter(fn($item) => Str::is(
                '*' . $search . '*',
                $item['name'],
                true
            ));
    }
}
