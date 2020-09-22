<?php

namespace App\Domain\Artist;

use App\Domain\Prize\Prize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $lastName
 * @property string $bio
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
class Artist extends Model
{
    public function prizes(): HasMany
    {
        return $this->hasMany(Prize::class);
    }
}
