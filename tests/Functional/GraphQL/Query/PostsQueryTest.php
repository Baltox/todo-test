<?php


namespace App\Tests\Functional;

use App\Tests\Functional\GraphQL\GraphqlTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class PostsQueryTest extends GraphqlTestCase
{
    use FixturesTrait;

    public function setUp() : void
    {
        $this->loadFixtureFiles([__DIR__.'/PostsQueryTestFixtures.yaml']);
    }

    public function testFetchesAllPostsWithTitle()
    {
        $query = <<<'EOF'
query {
  posts {
    edges {
      node {
        title
      }
    }
  }
}
EOF;

        $jsonExpected = <<<EOF
{
  "data": {
    "posts": {
      "edges": [
        {
          "node": {
            "title": "Titre 1"
          }
        },
        {
          "node": {
            "title": "Titre 2"
          }
        },
        {
          "node": {
            "title": "Titre 3"
          }
        }
      ]
    }
  }
}
EOF;

        $this->assertQuery($query, $jsonExpected);
    }

    public function testFetchesFirstPostsWithTitle()
    {
        $query = <<<'EOF'
query {
  posts(first:1) {
    edges {
      node {
        title
      }
    }
  }
}
EOF;

        $jsonExpected = <<<EOF
{
  "data": {
    "posts": {
      "edges": [
        {
          "node": {
            "title": "Titre 1"
          }
        }
      ]
    }
  }
}
EOF;

        $this->assertQuery($query, $jsonExpected);
    }

    public function testFetchesFirstPostsWithLikes()
    {
        $query = <<<'EOF'
query {
  posts(first:1) {
    edges {
      node {
        likes {
            name
        }
      }
    }
  }
}
EOF;

        $jsonExpected = <<<EOF
{
  "data": {
    "posts": {
      "edges": [
        {
          "node": {
            "likes": [
                {"name": "Utilisateur 2"},
                {"name": "Utilisateur 3"}
            ]
          }
        }
      ]
    }
  }
}
EOF;

        $this->assertQuery($query, $jsonExpected);
    }
}