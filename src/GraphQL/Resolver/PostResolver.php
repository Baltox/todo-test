<?php

namespace App\GraphQL\Resolver;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use Overblog\GraphQLBundle\Relay\Connection\Paginator;

class PostResolver
{
    protected $postRepository;
    protected $userRepository;

    public function __construct(PostRepository $postRepository, UserRepository $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function resolveLikes(Post $post): array
    {
        return $post->getLikes()->toArray();

        //return $this->userRepository->findUsersLikingPost($post);
        //return $this->userRepository->findAll();
    }

    public function resolveAll(Argument $args): Connection
    {
        $posts = $this->postRepository->findAll();

        $paginator = new Paginator(function ($offset, $limit) use ($posts) {
            return array_slice($posts, $offset, $limit ?? 10);
        });
        return $paginator->auto($args, count($posts));

        //return $this->postRepository->findAll();
    }
}