<?php

namespace App\Traits;

use App\AuditLogs;
use Illuminate\Database\Eloquent\Model;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function (Model $model) {
            self::audit('Created', $model);
        });

        static::updated(function (Model $model) {
            self::audit('Updated', $model);
        });

        static::deleted(function (Model $model) {
            self::audit('Deleted', $model);
        });
    }

    protected static function audit($description, $model)
    {
        AuditLogs::create([
            'description'  => $description,
            'subject_id'   => $model->id ?? null,
            'subject_type' => get_class($model) ?? null,
            'soon_to_wed_id' => auth()->id() ?? null,
            'vendor_id' => auth()->guard('vendor')->user()->id ?? null,
            'admin_id' => auth()->guard('admin')->user()->id ?? null,
            'properties'   => $model ?? null,
        ]);
    }
}