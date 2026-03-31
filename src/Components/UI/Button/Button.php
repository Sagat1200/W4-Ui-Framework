<?php

namespace W4\UiFramework\Components\UI\Button;

use W4\UiFramework\Components\UI\Button\ButtonComponentState;
use W4\UiFramework\Components\UI\Button\ButtonInteractState;
use W4\UiFramework\Core\BaseComponent;
use W4\UiFramework\Support\Traits\InteractsWithSize;
use W4\UiFramework\Support\Traits\InteractsWithState;
use W4\UiFramework\Support\Traits\InteractsWithVariant;

class Button extends BaseComponent
{
    use InteractsWithVariant;
    use InteractsWithSize;
    use InteractsWithState;

    protected ?string $icon = null;

    protected ButtonInteractState $interactState;

    public function __construct()
    {
        parent::__construct();

        $this->variant = 'primary';
        $this->size = 'md';
        $this->state = ButtonComponentState::ENABLED;
        $this->interactState = new ButtonInteractState();
    }

    public function componentName(): string
    {
        return 'button';
    }

    public function icon(?string $icon = null): string|static|null
    {
        if ($icon === null) {
            return $this->icon;
        }

        $this->icon = $icon;

        return $this;
    }

    public function interactState(?ButtonInteractState $state = null): ButtonInteractState|static
    {
        if ($state === null) {
            return $this->interactState;
        }

        $this->interactState = $state;

        return $this;
    }

    public function toThemeContext(): array
    {
        return array_merge(parent::toThemeContext(), [
            'variant' => $this->variant(),
            'size' => $this->size(),
            'icon' => $this->icon(),
            'state' => $this->stateValue(),
            'interact_state' => $this->interactState()->toArray(),
        ]);
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'variant' => $this->variant(),
            'size' => $this->size(),
            'icon' => $this->icon(),
            'state' => $this->stateValue(),
            'interact_state' => $this->interactState()->toArray(),
        ]);
    }
}