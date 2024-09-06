<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'phone',
        'status',
        'logged_in',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lastSeen()
    {
        if ($this->logged_in) {
            return 'Online';
        } else {
            return 'Offline';
            // $lastLogin = \Carbon\Carbon::parse($this->last_login_at);
            // return $lastLogin->diffForHumans();
        }
    }

    public function unread_messages_count()
    {
        return $this->messages()
            ->whereIn('status', ['sent', 'delivered'])
            ->count();
    }


    public function latest_message()
    {
        // return 
    }

    public function conversationsAsUser1()
    {
        return $this->hasMany(Conversation::class, 'user1_id');
    }

    public function conversationsAsUser2()
    {
        return $this->hasMany(Conversation::class, 'user2_id');
    }

    // public function conversations()
    // {
    //     return $this->hasMany(Conversation::class, 'user1_id')
    //                 ->orWhere('user2_id', $this->id);
    // }    

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
