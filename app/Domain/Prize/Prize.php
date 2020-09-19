<?php

namespace App\Domain\Prize;

use App\Domain\Artist\Artist;
use App\Domain\Prize\Exceptions\PrizeAlreadyInReviewException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $category
 * @property string $description
 * @property string $image
 * @property string $status
 * @property int $artist_id
 * @property string $created_at
 * @property string $updated_at
 */
class Prize extends Model
{
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getArtist(): Artist
    {
        return $this->artist;
    }

    public function askToPublish(): void
    {
        throw_if($this->status === PrizeStatus::PENDING, new PrizeAlreadyInReviewException());

        $this->status = PrizeStatus::PENDING;
    }
}
