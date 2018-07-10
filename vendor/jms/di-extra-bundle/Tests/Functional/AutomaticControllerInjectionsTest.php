<?php

namespace JMS\DiExtraBundle\Tests\Functional;

class AutomaticControllerInjectionsTest extends BaseTestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testInjections()
    {
        $client = $this->createClient(array(
            'config' => class_exists('Symfony\Component\Security\Core\Authorization\AuthorizationChecker') ? 'automatic_controller_injections.yml' : 'bc_automatic_controller_injections.yml'
        ));
        $client->request('GET', '/automatic-controller-injection-test');

        $expected = '';
        $expected .= "\$context injection: OK\n";
        $expected .= "\$templating injection: OK\n";
        $expected .= "\$router injection: OK\n";
        $expected .= "\$foo injection: OK\n";

        $this->assertEquals($expected, $client->getResponse()->getContent());
    }
}
