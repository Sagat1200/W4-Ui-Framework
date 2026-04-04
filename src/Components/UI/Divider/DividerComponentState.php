<?php

namespace W4\UiFramework\Components\UI\Divider;

enum DividerComponentState: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
    case ACTIVE = 'active';
    case HIDDEN = 'hidden';
}