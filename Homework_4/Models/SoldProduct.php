<?php

class SoldProduct
{
    private string $time;
    private string $description;
    private int $sessionId;

    public function __construct($time,$description, $sessionId)
    {
        $this->time = $time;
        $this->description = $description;
        $this->sessionId = $sessionId;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSessionId(): int
    {
        return $this->sessionId;
    }
}