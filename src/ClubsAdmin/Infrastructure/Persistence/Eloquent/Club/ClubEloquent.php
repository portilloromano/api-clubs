<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Infrastructure\Persistence\Eloquent\Club;

use Api\Common\Application\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class ClubEloquent extends Model
{
    use ValidationTrait;

    public $incrementing = false;
    protected $table = 'clubs';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'budget',
        'expense',
    ];
}
