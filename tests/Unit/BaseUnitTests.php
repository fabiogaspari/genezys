<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BaseUnitTests extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
}
