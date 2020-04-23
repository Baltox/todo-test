<?php

namespace App\Tests\Entity;

use App\Entity\Post;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostTest extends KernelTestCase
{
    use FixturesTrait;

    public function getEntity() : Post
    {
        $post = (new Post())
            ->setTitle("Titre")
        ;

        return $post;
    }

    public function assertHasErrors(Post $post, int $number)
    {
        self::bootKernel();

        $errors = self::$container
            ->get(ValidatorInterface::class)
            ->validate($post)
        ;

        $messages = [];

        /**
         * @var ConstraintViolation $error
         */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath().' => '.$error->getMessage();
        }

        $this->assertCount($number, $errors, implode(' ', $messages));
    }

    public function testValidEntity()
    {
        $post = $this->getEntity();

        $this->assertHasErrors($post, 0);
    }

    public function testInvalidTitleEntity()
    {
        self::bootKernel();

        $post = $this
            ->getEntity()
            ->setTitle('')
        ;

        $this->assertHasErrors($post, 2);
    }

    public function testInvalidUsedTitle()
    {
        $this->loadFixtureFiles([__DIR__.'/PostTestFixtures.yaml']);

        $post = $this
            ->getEntity()
            ->setTitle('duplicated_code')
        ;

        $this->assertHasErrors($post, 1);
    }
}