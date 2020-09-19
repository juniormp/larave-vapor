<?php


namespace App\Infrastructure\Repository;


use App\Domain\Prize\Prize;

class PrizeRepository
{
    public function save(Prize $prize): Prize
    {
        $prize->save();

        return $prize;
    }

    public function findById(int $id): ?Prize
    {
        return Prize::find($id);
    }

    public function delete(Prize $prize): void
    {
        $prize->delete();
    }
}
