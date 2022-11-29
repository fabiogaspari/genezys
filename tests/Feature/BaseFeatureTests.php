<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BaseFeatureTests extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
}
