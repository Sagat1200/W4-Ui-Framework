<?php

namespace W4\UiFramework\Components\UI\Button;

enum ButtonComponentState: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
    case LOADING = 'loading';
    case ACTIVE = 'active';
    case READONLY = 'readonly';
}
