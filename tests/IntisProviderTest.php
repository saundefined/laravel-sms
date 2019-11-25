<?php

namespace Saundefined\LaravelSMS\Test;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Saundefined\LaravelSMS\Exceptions\ApiException;
use Saundefined\LaravelSMS\Test\Stubs\IntisProviderStub;
use stdClass;

class IntisProviderTest extends TestCase
{
    private $provider;

    private $response;

    /** @test */
    public function it_should_return_balance()
    {
        $data = [
            'money' => 100,
            'currency' => ''
        ];

        $this->response->shouldReceive('getBody')
            ->once()
            ->andReturn(json_encode($data));

        $this->assertEquals($data['money'], $this->provider->getBalance()->getAmount());
        $this->assertEquals($data['currency'], $this->provider->getBalance()->getCurrency());
    }

    /** @test */
    public function it_should_return_sender_list()
    {
        $data = [
            'TEST1' => 'completed',
            'TEST2' => 'completed',
            'TEST3' => 'rejected'
        ];

        $this->response->shouldReceive('getBody')
            ->once()
            ->andReturn(json_encode($data));

        $senderList = $this->provider->getSenderList();

        $this->assertCount(3, $senderList);
        $this->assertCount(2, $senderList->getValidCollection());
        $this->assertEquals('TEST1', $senderList->first()->getName());
        $this->assertTrue($senderList->get(0)->isValid());
        $this->assertFalse($senderList->get(2)->isValid());
    }

    /** @test */
    public function it_should_return_auth_error()
    {
        $data = [
            'error' => 6,
        ];

        $this->response->shouldReceive('getBody')
            ->once()
            ->andReturn(json_encode($data));

        $this->expectException(ApiException::class);
        $this->provider->getBalance();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->provider = new IntisProviderStub([
            'login' => 'test',
            'password' => 'test'
        ]);

        $this->provider->getHttpClient()
            ->shouldReceive('get', 'request')
            ->once()
            ->andReturn($this->response = m::mock(stdClass::class));
    }
}
