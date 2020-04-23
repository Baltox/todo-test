<?php

namespace App\Tests;

use App\Repository\PostRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostRepositoryTest extends KernelTestCase
{
    use FixturesTrait;

    public function testCount()
    {
        self::bootKernel();

        $this->loadFixtureFiles([__DIR__."/PostRepositoryTestFixtures.yaml"]);

        $nbPosts = self::getContainer()->get(PostRepository::class)->count([]);

        $this->assertEquals(10, $nbPosts);
    }
}
