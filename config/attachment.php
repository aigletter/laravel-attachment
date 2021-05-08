<?php

use Aigletter\LaravelAttachment\Models\Attachment;

return [
    'model' => Attachment::class,
    'driver' => 'public',
    'path' => 'uploads',
];