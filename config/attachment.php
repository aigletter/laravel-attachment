<?php

use Aigletter\LaravelAttachment\Models\Attachment;

return [
    'model' => Attachment::class,
    'driver' => 'local',
    'path' => 'uploads',
];