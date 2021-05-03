<?php


namespace Aigletter\LaravelAttachment;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;

class LaravelAttachment
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function attach(\SplFileInfo $file, Model $model, $path = null)
    {
        if (!method_exists($model, 'attachments')) {
            throw new \Exception('Method attachments not exists');
        }

        $config = config('attachment.driver');
        $driver = Storage::disk($config);
        $path = $driver->putFile('uploads', $file);
        $url = $driver->url($path);
        $className = config('attachment.model');

        $attachmentModel = new $className();
        $attachmentModel->path = $path;
        $attachmentModel->url = $url;

        $model->attachments()->save($attachmentModel);
    }
}