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

    public function attach(Model $model, string $name, \SplFileInfo $file)
    {
        if (!method_exists($model, 'attachments')) {
            throw new \Exception('Method attachments not exists in model class');
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

    public function detach(Model $model, string $name)
    {
        if (!method_exists($model, 'attachments')) {
            throw new \Exception('Method attachments not exists in model class');
        }

        $attachments = $model->attachments()->where('name', $name)->get();
        if ($attachments->count()) {
            foreach ($attachments as $attachment) {
                $config = config('attachment.driver');
                $driver = Storage::disk($config);
                $driver->delete($attachment->path);
                $attachment->delete();
            }
        }

    }
}