<?php

namespace App\Models;
use App\Models\Kerusakan;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Activity extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'activity_log';

    protected $guarded = [];

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'kerusakan';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }

}
