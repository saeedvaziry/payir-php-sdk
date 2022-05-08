<?php

namespace SaeedVaziry\PayirSDK\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SaeedVaziry\PayirSDK\Services\Wallet;
use SaeedVaziry\PayirSDK\Utils\Http;

class WalletTest extends TestCase
{
    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\GetWalletsListException
     */
    public function testGetWalletsList()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "wallets" => [
                        [
                            "id" => 123,
                            "name" => 123,
                            "balance" => 123,
                            "cashoutableAmount" => 123
                        ]
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $wallet = new Wallet("test");
        $res = $wallet->getList();

        $this->assertEquals(123, $res->wallets[0]->id);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SaeedVaziry\PayirSDK\Exceptions\GetWalletException
     */
    public function testGetWallet()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "wallet" => [
                        "id" => 123,
                        "name" => 123,
                        "balance" => 123,
                        "cashoutableAmount" => 123
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $wallet = new Wallet("test");
        $res = $wallet->get(123);

        $this->assertEquals(123, $res->id);
    }
}
