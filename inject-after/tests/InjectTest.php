<?php

use PHPUnit\Framework\TestCase;
use App\Inject;

class InjectTest extends TestCase
{
    protected $inject;

    protected function setUp(): void
    {
        $this->inject = new Inject();
    }

    /** @test */
    public function checkCorrectArrayReturn()
    {
        $array = ["foo" => 3, "bar" => 1];
        $afterKey = 'foo';
        $newKey = 'baz';
        $newValue = 42;

        $afterKeyNotExists = 'test';

        $checkCorrect = $this->inject->injectAfter($array, $afterKey, $newKey, $newValue);
        $checkAfterKeyAlreadyExists = $this->inject->injectAfter(["baz" => 52,"foo" => 3, "bar" => 1], $afterKey, $newKey, $newValue);
        $checkAfterKeyNotExists = $this->inject->injectAfter(["foo" => 3, "bar" => 1], $afterKeyNotExists, $newKey, $newValue);
        $checkEmptyArray = $this->inject->injectAfter([], $afterKeyNotExists, $newKey, $newValue);

        $this->assertEquals(["foo" => 3, "baz" => 42, "bar" => 1], $checkCorrect);
        $this->assertEquals(["foo" => 3, "bar" => 1, "baz" => 42], $checkAfterKeyAlreadyExists);
        $this->assertEquals(["foo" => 3, "bar" => 1, "baz" => 42], $checkAfterKeyNotExists);
        $this->assertEquals($checkEmptyArray, []);
    }

    /** @test */
    public function checkTypeError()
    {
        try {
            $this->inject->injectAfter('string', 'string', 'string', 41);
            $this->fail('A typeError');

        } catch (TypeError $error) {
            $this->assertStringStartsWith('Argument 1 passed to App\Inject::injectAfter()', $error->getMessage());
        }

        try {
            $this->inject->injectAfter([], [], 'string', 41);
            $this->fail('A typeError');

        } catch (TypeError $error) {
            $this->assertStringStartsWith('Argument 2 passed to App\Inject::injectAfter()', $error->getMessage());
        }
        try {
            $this->inject->injectAfter([], 'string', [], 41);
            $this->fail('A typeError');

        } catch (TypeError $error) {
            $this->assertStringStartsWith('Argument 3 passed to App\Inject::injectAfter()', $error->getMessage());
        }
    }
}
