<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'image',
        'qrcode',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    ///////////////////////////////////////// HTML /////////////////////////////
    public function getActionButtonsAttribute()
    {
        $button = '';
            $button .= '<a href="' . route('admin.users.edit', $this->id) . '" class="btn btn-icon btn-xs btn-info"><i class="flaticon2-edit"></i></a>';

            $button .= '&nbsp;&nbsp;<button  title="Delete User" type="button" data-id="' . $this->id . '" data-name="' . $this->name . '" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon btn-xs btn-danger delete-item"><i class="flaticon2-trash"></i></button>';

            $button .= '&nbsp;&nbsp;<button  title="Show QRCode User" type="button" data-id="' . $this->id . '" data-name="' . $this->name . '" data-toggle="modal" data-target="#showQRCode" class="btn btn-icon btn-xs btn-success qrcode-item"><i class="fas fa-qrcode "></i></button>';

            if($this->active === 0){
            $button .= '&nbsp;&nbsp;<button  title="Active User" type="button" data-id="' . $this->id . '" data-active="' . $this->active . '"data-name="' . $this->name . '"  class="btn btn-icon btn-xs btn-success active-item"><i class="flaticon2-check-mark"></i></button>';
            }else{
                $button .= '&nbsp;&nbsp;<button  title="Not Active User" type="button" data-id="' . $this->id . '" data-active="' . $this->active . '"data-name="' . $this->name . '"  class="btn btn-icon btn-xs btn-danger active-item"><i class="flaticon2-cross"></i></button>';
            }
        return $button;
    }
}
