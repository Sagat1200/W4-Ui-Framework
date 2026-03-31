<?php

namespace W4\UiFramework\Support;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use W4\UiFramework\Contracts\ComponentInterface;
use W4\UiFramework\Core\RuntimeRenderer;

class W4UiManager
{
    public function __construct(
        protected RuntimeRenderer $runtimeRenderer,
        protected ViewFactory $viewFactory
    ) {}

    public function render(ComponentInterface $component, ?string $renderer = null): string
    {
        $payload = $this->runtimeRenderer->render($component, $renderer);

        if (! is_array($payload)) {
            return (string) $payload;
        }

        $viewName = $payload['view'] ?? null;

        if (! is_string($viewName) || $viewName === '') {
            return '';
        }

        return $this->viewFactory->make($viewName, [
            'data' => $payload['data'] ?? [],
            'theme' => $payload['theme'] ?? [],
            'component' => $component,
            'payload' => $payload,
        ])->render();
    }

    public function view(ComponentInterface $component, ?string $renderer = null): View|string
    {
        $payload = $this->runtimeRenderer->render($component, $renderer);

        if (! is_array($payload)) {
            return (string) $payload;
        }

        $viewName = $payload['view'] ?? null;

        if (! is_string($viewName) || $viewName === '') {
            return '';
        }

        return $this->viewFactory->make($viewName, [
            'data' => $payload['data'] ?? [],
            'theme' => $payload['theme'] ?? [],
            'component' => $component,
            'payload' => $payload,
        ]);
    }

    public function payload(ComponentInterface $component, ?string $renderer = null): mixed
    {
        return $this->runtimeRenderer->render($component, $renderer);
    }
}
