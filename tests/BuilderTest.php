<?php namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use KBussche\Dweet\URLBuilder;

class BuilderTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testBuilderSetup()
    {
        $builder = new UrlBuilder();

        $this->assertTrue(is_string($builder->build()));
    }
}
