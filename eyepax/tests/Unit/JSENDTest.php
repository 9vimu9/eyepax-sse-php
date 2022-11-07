<?php

namespace Tests\Unit;

use App\Core\JSEND\JsendResponse;
use PHPUnit\Framework\TestCase;

class JSENDTest extends TestCase
{
    protected array $data = ["key1" => "value1", "key2" => "value2"];

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_success_response(): void
    {
        $response = JsendResponse::success($this->data);
        $this->assertIsArray($response);
        $this->assertArrayHasKey("status", $response);
        $this->assertEquals("success", $response["status"]);
        $this->assertArrayHasKey("data", $response);
        $this->assertEquals($response["data"], $this->data);
    }

    public function test_fail_response(): void
    {
        $response = JsendResponse::fail($this->data);
        $this->assertIsArray($response);
        $this->assertArrayHasKey("status", $response);
        $this->assertEquals("fail", $response["status"]);
        $this->assertArrayHasKey("data", $response);
        $this->assertEquals($response["data"], $this->data);
    }

    public function test_error_response(): void
    {
        $message = "test message";
        $response = JsendResponse::error($message);
        $this->assertIsArray($response);
        $this->assertArrayHasKey("status", $response);
        $this->assertEquals("error", $response["status"]);
        $this->assertArrayHasKey("message", $response);
        $this->assertEquals($response["message"], $message);

    }

    public function test_error_response_with_data(): void
    {
        $message = "test message";
        $response = JsendResponse::error($message,$this->data);
        $this->assertIsArray($response);
        $this->assertArrayHasKey("data", $response);
        $this->assertEquals($response["data"], $this->data);
    }
    public function test_error_response_with_no_arguments(): void
    {
        $response = JsendResponse::error();
        $this->assertIsArray($response);
        $this->assertArrayHasKey("status", $response);
        $this->assertEquals("error", $response["status"]);
        $this->assertArrayHasKey("message", $response);
        $this->assertEquals("Something went wrong.", $response["message"]);
    }
}
