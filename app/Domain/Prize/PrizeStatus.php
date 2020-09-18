<?php


namespace App\Domain\Prize;


abstract class PrizeStatus
{
    const OPEN = 'OPEN';
    const PENDING = 'PENDING';
    const DENIED = 'DENIED';
    const PUBLISHED = 'PUBLISHED';
    const DELIVERED = 'DELIVERED';
}
