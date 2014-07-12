<?php namespace Modules\Accounts\Models;

use Illuminate\Auth\UserTrait;
use Ill\Core\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Tenant extends Model
{
    use EventGenerator;
    use SoftDeletingTrait;

    protected $table = 'tenants';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

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
