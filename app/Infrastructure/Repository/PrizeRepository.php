<?php


namespace App\Infrastructure\Repository;


use App\Domain\Prize\Prize;

class PrizeRepository
{
    public function save(Prize $prize): Prize
    {
        try {
            $prize->save();
        } catch (\Exception $e) {
            throw new \Exception("ERROR_WHEN_SAVING_PRIZE", $e);
        }

        return $prize;
    }

    public function findById(int $id): ?Prize
    {
        try {
            $prize = Prize::find($id);
        } catch (\Exception $e) {
            throw new \Exception("ERROR_WHEN_FINDING_PRIZE");
        }

        return $prize;
    }

    public function delete(Prize $prize): void
    {
        try {
            $prize->delete();
        } catch (\Exception $e) {
            throw new \Exception("ERROR_WHEN_DELETING_PRIZE");
        }
    }
}
