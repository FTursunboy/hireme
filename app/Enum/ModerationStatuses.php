<?php

namespace App\Enum;

enum ModerationStatuses :string
{
    case Moderation = 'На модерации';

    case Published = 'Опубликован';

    case UnPublished = 'Не опубилкован';


}
