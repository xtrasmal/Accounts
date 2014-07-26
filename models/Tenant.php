<?php namespace Modules\Accounts\Models;

use Ill\System\Base\UuidTrait;
use Ill\Core\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Tenant extends Model
{
    use UuidTrait;
    use EventGenerator;
    use SoftDeletingTrait;

    protected $table        = 'tenants';
    protected $guarded      = [];
    protected $dates        = ['deleted_at'];
//    public    $incrementing = false;

    public static function register($owner_id)
    {

        $tenant = new static([
            'owner_id'  => $owner_id
        ]);

        return $tenant;

    }

    public function users()
    {

        return $this->belongsToMany('User');

    }

    public function owner()
    {

        return $this->hasOne('User', 'owner_id');

    }

}
