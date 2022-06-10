<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Infrastructure\Persistence\Eloquent\Entity;

use Api\Common\Application\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class EntityEloquent extends Model
{
    use ValidationTrait;

    public $incrementing = false;
    protected $table = 'entities';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'uuid_club',
        'type',
        'name',
        'surname',
        'email',
        'phone',
        'salary',
    ];

    /** Scopes */

    public function scopeType($query, $type)
    {
        if (!is_null($type))
            return $query->where('type', "$type");
    }

    public function scopeSurname($query, $surname)
    {
        if (!is_null($surname))
            return $query->where('surname', 'LIKE', "%$surname%");
    }

}
