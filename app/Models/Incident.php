<?php

namespace App\Models;

use App\Enums\IncidentPriority;
use App\Enums\IncidentStatus;
use App\Traits\HasActivityLog;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Incident extends Model
{
  use HasActivityLog, HasFactory, HasUuids, LogsActivity, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'title',
    'description',
    'status',
    'priority',
    'user_id',
    'department_id',
    'closed_at',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'status' => IncidentStatus::class,
      'priority' => IncidentPriority::class,
      'closed_at' => 'datetime',
    ];
  }

  public function reporter(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function department(): BelongsTo
  {
    return $this->belongsTo(Department::class);
  }

  public function moderators(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'incident_user')
             ->withPivot('assigned_at');
  }
}

