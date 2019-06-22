<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditLogs extends Model
{
    protected $table = 'audit_logs';

    protected $fillable = [
        'admin_id', 'soon_to_wed_id', 'vendor_id', 'subject_id', 'subject_type', 'description', 'properties'
    ];

    protected $casts = [
        'properties' => 'collection',
    ];
}
