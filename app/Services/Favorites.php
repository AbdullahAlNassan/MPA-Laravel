<?php

namespace App\Services;

class Favorites
{
    private string $key = 'favorites';

    public function all(): array
    {
        return session()->get($this->key, []);
    }

    public function has(int $bookId): bool
    {
        return in_array($bookId, $this->all(), true);
    }

    public function add(int $bookId): void
    {
        $ids = $this->all();
        if (!in_array($bookId, $ids, true)) {
            $ids[] = $bookId;
        }
        session()->put($this->key, $ids);
    }

    public function remove(int $bookId): void
    {
        $filtered = array_values(array_filter($this->all(), fn ($id) => (int)$id !== $bookId));
        session()->put($this->key, $filtered);
    }

    public function clear(): void
    {
        session()->forget($this->key);
    }

    public function count(): int
    {
        return count($this->all());
    }
}

