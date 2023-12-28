<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likeCategories()
    {
        return $this->HasMany(UserLikeCategories::class);
    }

    public function transformLikeCategories(): AnonymousResourceCollection
    {
        $categoryIds = $this->likeCategories->map(function ($elem) {
            return $elem->category_id;
        });

        $findCategories = Category::whereIn('id', $categoryIds)->get();
        return CategoryResource::collection($findCategories);

    }


    public static function hash($pass)
    {
        $hashed = Hash::make($pass, [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
        return $hashed;
    }

    public static function checkPassHash($password, $passwordHash): bool
    {
        return Hash::check($password, $passwordHash, [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
    }

}
