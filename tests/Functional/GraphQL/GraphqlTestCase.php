<?php


namespace App\Tests\Functional\GraphQL;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class GraphqlTestCase extends WebTestCase
{
    protected function assertQuery($query, $jsonExpected, $jsonVariables = '{}')
    {
        $client = static::makeClient();
        $path = $this->getUrl('overblog_graphql_endpoint');

        $client->request(
            'GET', $path, ['query' => $query, 'variables' => $jsonVariables], [], ['CONTENT_TYPE' => 'application/graphql']
        );
        $result = $client->getResponse()->getContent();
        $this->assertStatusCode(200, $client);
        $this->assertEquals(json_decode($jsonExpected, true), json_decode($result, true), $result);
    }
}