<?php

namespace App\GraphQL\Mutation;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

/**
 * Class PostMutation
 * @package App\GraphQL\Mutation
 */
class PostMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * PostMutation constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(EntityManagerInterface $entityManager, PostRepository $postRepository)
    {
        $this->entityManager = $entityManager;
        $this->postRepository = $postRepository;
    }

    /**
     * @param string $postTitle
     * @return array
     */
    public function createPost(string $postTitle): array
    {
        $post = new Post();
        $post->setTitle($postTitle);

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return [
            'post' => $post
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['createPost' => 'create_post'];
    }
}