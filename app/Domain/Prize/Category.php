<?php


namespace App\Domain\Prize;


class Category
{
    const FIRST = "FIRST";
    const SECOND = "SECOND";
    const THIRD = "THIRD";

    public static $categories = [self::FIRST, self::SECOND, self::THIRD];
}
