<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar_path','confirmed','confirmation_token'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'confirmed' => 'boolean'
    ];
    public function getRouteKeyName(){
        return 'name';
    }
    public function questions(){
        return $this->hasMany(Question::class)->latest();
    }
    public function activity(){
        return $this->hasMany(Activity::class)->latest();
    }

    public function read($question){
        $key = sprintf("users.%s.visits.%s",auth()->id(),$question->id);
     cache()->forever($key,\Carbon\Carbon::now());
    }
    public function avatars(){
        return $this->avatar_path ?: 'avatars/default.jpeg';
    }
        public function confirm()
    {
        $this->confirmed = true;
        $this->save();
    }
    

}