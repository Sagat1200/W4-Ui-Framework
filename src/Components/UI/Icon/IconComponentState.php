<?php

namespace W4\UiFramework\Components\UI\Icon;

enum IconComponentState: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
    case ACTIVE = 'active';
    case HIDDEN = 'hidden';
}