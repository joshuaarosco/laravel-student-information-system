<?php

namespace App\Laravel\Models;

use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, DateFormatterTrait;

    protected $table = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','lname', 'username', 'email', 'contact',
        'password', 'type', 'gender', 'birthdate',
        'description', 'path', 'directory', 'filename',
        'address', 'last_notification_check'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Get the devices for this user.
     */
    public function devices() {
        return $this->hasMany("App\Laravel\Models\UserDevice");
    }

    /**
     * Get the facebook account for this user.
     */
    public function facebook() {
        return $this->hasOne("App\Laravel\Models\UserSocial", "user_id")->where('provider', "facebook");
    }

    /**
     * Get the wishlist for this user.
     */
    public function wishlist() {
        return $this->hasMany("App\Laravel\Models\Wishlist", "user_id");
    }

    /**
     * Get the gifts sent by this user.
     */
    public function sent_gifts() {
        return $this->hasMany("App\Laravel\Models\WishlistTransaction", "sender_id");
    }

    /**
     * Get the gifts received by this user.
     */
    public function received_gifts() {
        return $this->hasMany("App\Laravel\Models\WishlistTransaction", "owner_id")->where('status', "completed");
    }

    /**
     * Get the followers for this user.
     */
    public function followers() {
        return $this->hasMany("App\Laravel\Models\Follower", "user_id");
    }

    /**
     * Get the users followed by this user.
     */
    public function following() {
        return $this->hasMany("App\Laravel\Models\Follower", "follower_id");
    }

    /**
     * Search users that match a keyword.
     */
    public function scopeKeyword($query, $keyword) {
        if($keyword){
            return $query->where(function($query) use($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('username', 'like', "%{$keyword}%");
                // ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
    }

    /**
     * Route notifications for the FCM channel.
     *
     * @return string
     */
    public function routeNotificationForFcm()
    {
        return $this->devices()->where('is_login', '1')->pluck('reg_id')->toArray();
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return array
     */
    public function receivesBroadcastNotificationsOn()
    {
        // return [
        //     new PrivateChannel("USER.{$this->id}"),
        // ];

        return "private-user.{$this->id}";
    }

    /**
     * Get user's avatar
     */
    public function getAvatar() {

        if($this->filename) {
            return "{$this->directory}/thumbnails/{$this->filename}";
        }

        if($this->facebook) {
            return "https://graph.facebook.com/{$this->facebook->provider_user_id}/picture?type=large";
        }
        
        return "/";
    }

}
