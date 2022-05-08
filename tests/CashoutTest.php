<?php

namespace SaeedVaziry\PayirSDK\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SaeedVaziry\PayirSDK\Services\Cashout;
use SaeedVaziry\PayirSDK\Utils\Http;

class CashoutTest extends TestCase
{
    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\CreateCashoutException
     */
    public function testCreate()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "cashout" => [
                        "id" => 1,
                        "transactionId" => 1,
                        "amount" => 100000,
                        "name" => "name",
                        "bankAccountNumber" => "XXX-XXX-XXXXX-X",
                        "bankIbanNumber" => "XXXXXXXXXXXXXXXXXXXXXXXX",
                        "depositReferrerNumber" => "XXXXXXXXXXXX",
                        "status" => "1",
                        "statusLabel" => "TRANSFERRED",
                        "rejectReason" => "",
                        "createdAt" => "2021-03-21 00:00:00",
                        "jalaliCreatedAt" => "1400-01-01 00:00:00"
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $cashout = new Cashout("test");
        $res = $cashout->create(1, 100000, "name", "XXXXXXXXXXXXXXXXXXXXXXXX", "123");

        $this->assertEquals(1, $res->id);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\DeleteCashoutException
     */
    public function testDelete()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => null
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $cashout = new Cashout("test");
        $res = $cashout->delete(1);

        $this->assertTrue($res);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\GetCashoutsListException
     */
    public function testGetList()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "cashouts" => [
                        [
                            "id" => 1,
                            "transactionId" => 1,
                            "amount" => 100000,
                            "name" => "name",
                            "bankAccountNumber" => "XXX-XXX-XXXXX-X",
                            "bankIbanNumber" => "XXXXXXXXXXXXXXXXXXXXXXXX",
                            "depositReferrerNumber" => "XXXXXXXXXXXX",
                            "status" => "1",
                            "statusLabel" => "TRANSFERRED",
                            "rejectReason" => "",
                            "createdAt" => "2021-03-21 00:00:00",
                            "jalaliCreatedAt" => "1400-01-01 00:00:00"
                        ]
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $cashout = new Cashout("test");
        $res = $cashout->getList();

        $this->assertEquals(1, $res->cashouts[0]->id);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\GetCashoutException
     */
    public function testGet()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "cashout" => [
                        "id" => 1,
                        "transactionId" => 1,
                        "amount" => 100000,
                        "name" => "name",
                        "bankAccountNumber" => "XXX-XXX-XXXXX-X",
                        "bankIbanNumber" => "XXXXXXXXXXXXXXXXXXXXXXXX",
                        "depositReferrerNumber" => "XXXXXXXXXXXX",
                        "status" => "1",
                        "statusLabel" => "TRANSFERRED",
                        "rejectReason" => "",
                        "createdAt" => "2021-03-21 00:00:00",
                        "jalaliCreatedAt" => "1400-01-01 00:00:00"
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $cashout = new Cashout("test");
        $res = $cashout->get(1);

        $this->assertEquals(1, $res->id);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\TrackCashoutException
     */
    public function testTrack()
    {
        $mock = new MockHandler([
            new Response(422, [], json_encode([
                "success" => false,
                "data" => null
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $cashout = new Cashout("test");
        $res = $cashout->track("test-uid");

        $this->assertFalse($res);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\IbanInquiryException
     */
    public function testIbanInquiry()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "iban" => [
                        "name" => "name",
                        "bank" => "bank",
                        "acc" => "111-111-1111111-1",
                        "comment" => "comment"
                    ]
                ],
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $cashout = new Cashout("test");
        $res = $cashout->ibanInquiry("IR111111111111111111111111");

        $this->assertEquals("name", $res->name);
        $this->assertEquals("bank", $res->bank);
        $this->assertEquals("111-111-1111111-1", $res->acc);
    }
}
