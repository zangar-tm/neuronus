<?php

namespace app\controllers;

class Controller
{

    public function render(string $view, array $data = []): void
    {
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}