<?php namespace Modules\Accounts\Models;

use Illuminate\Auth\UserTrait;
use Ill\Core\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Account extends Model
{
    use EventGenerator;
    use SoftDeletingTrait;


    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function users()
    {
        $this->hasMany('User');
    }

}
