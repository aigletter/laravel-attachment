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

    public function attach(\SplFileInfo $file, Model $model, $name = null)
    {
        if (!method_exists($model, 'attachments')) {
            throw new \Exception('Method attachments not exists');
        }

        $config = config('attachment.driver');
        $driver = Storage::disk($config);
        $path = $driver->putFile('uploads', $file);
        $url = $driver->url($path);
        $className = config('attachment.model');

        $attachment = new $className();
        $attachment->path = $path;
        $attachment->url = $url;
        $attachment->name = $name;

        return $model->attachments()->save($attachment);
    }
}