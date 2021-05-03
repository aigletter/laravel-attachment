<?php


namespace Aigletter\LaravelAttachment;


use Aigletter\LaravelAttachment\Models\Attachment;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait AttachmentTrait
 * @package Aigletter\LaravelAttachment
 * @mixin Model
 */
trait AttachmentTrait
{
    public function attachments()
    {
        return $this->morphToMany(Attachment::class, 'attachmentable');
    }
}