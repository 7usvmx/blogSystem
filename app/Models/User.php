<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
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
      'password' => 'hashed',
    ];
  }

  /*
  *
  *  public function blogs()
   * Get the blogs for the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Blog>
```

Actually, `Blog::class` is used, so I can use `Blog`.

```php
   * Get the blogs for the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany<Blog>
```

Wait, if I look at the existing `casts` method, it doesn't use FQNs in the return type (it uses `array<string, string>`).
But `HasMany` is a class.
  */

  public function blogs()
  {
    return $this->hasMany(Blog::class);
  }
}
