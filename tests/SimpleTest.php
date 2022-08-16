<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

class Model  {}

final class SimpleTest extends TestCase
{
    public function testSkills(): void
    {
        require './fuel/app/classes/model/Skills.php';
        $this->assertSame(6, count(\Model\Skills::skills()));
    }
}