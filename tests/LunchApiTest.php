<?php

use App\Http\Models\Lunch;
use \Laravel\Lumen\Testing\DatabaseMigrations;

class LunchTest extends TestCase
{
    private $lunch;
    private $lastIdInserted;

    public function setUp()
    {
        parent::setUp();
        $this->lunch = factory(Lunch::class)->make();
        try {
            $this->lastIdInserted = Lunch::withTrashed()->orderBy('id')->get()->last()->id;
        } catch (Exception $e) {
            $this->lastIdInserted = 0;
        }
    }

    /**
     * should test required fields lunch.
     *
     * @return void
     */
    public function testShouldTestRequiredFiledLunch()
    {
        $this->json('POST', '/api/lunch', [])
            ->seeJson([
                'name' => ["The name field is required."]
            ]);
    }

    /**
     * should test create lunch.
     *
     * @return void
     */
    public function testShouldTestCreateLunch()
    {
        $expect = $this->lastIdInserted + 1;
        $this->json('POST', '/api/lunch', $this->lunch->toArray())
            ->seeJson(['id' => $expect]);
    }

    /**
     * should test update lunch.
     *
     * @return void
     */
    public function testShouldUpdateLunch()
    {
        $updateLunch = factory(Lunch::class)->make();
        $this->json('PUT', '/api/lunch/' . $this->lastIdInserted, $updateLunch->toArray())
            ->dontSeeJson(['name' => $this->lunch->name])
            ->seeJson(['name' => $updateLunch->name]);
    }

    /**
     * should test delete lunch.
     *
     * @return void
     */
    public function testShouldTestDeleteLunch()
    {
        $expect = ["DESTROY " => $this->lastIdInserted . ""];
        $this->json('DELETE', '/api/lunch/' . $this->lastIdInserted)
            ->seeJson($expect);
    }
}
