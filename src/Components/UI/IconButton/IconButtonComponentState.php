<?php

namespace W4\UiFramework\Components\UI\IconButton;

enum IconButtonComponentState: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
    case LOADING = 'loading';
    case READONLY = 'readonly';
    case ACTIVE = 'active';
}
