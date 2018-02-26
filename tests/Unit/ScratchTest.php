<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Code\Scratch;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScratchTest extends TestCase
{
    use RefreshDatabase;

    /** @var Scratch */
    protected $scratch;

    public function setUp()
    {
        parent::setUp();

        $this->scratch = new Scratch;
    }

    /** @test */
    public function it_shows_the_dividers_of_integer()
    {
        $this->assertEquals([4, 8], $this->scratch->divisions(1, 10, 4));
    }

    /** @test */
    public function it_shows_the_longest_string_length()
    {
        $longest = 'Alexander';

        $this->assertEquals(strlen($longest), $this->scratch->longestName('Maria', 'Greg', $longest, 'Ilon', 'Piter'));
    }

    /** @test */
    public function it_returns_abs_max_of_an_array()
    {
        $this->assertEquals(100, $this->scratch->absMax([10, 12, 1, [50, 45, 18], [22, 15, 100]]));
    }

    /** @test */
    public function it_fetches_the_penultimate_record()
    {
        factory(User::class, 20)->create();
        factory(User::class)->create(['name' => $required = 'Penultimate User']);
        factory(User::class)->create(['name' => 'Last User']);

        $user = $this->scratch->penultimateRecord();

        $this->assertEquals(22, User::count());
        $this->assertEquals($user->name, $required);
    }

    /**
     * @test
     *
     * @dataProvider cypherResults
     * @param $shift
     * @param $value
     */
    public function it_encodes_word_using_caesar_cypher($shift, $value)
    {
        $this->assertEquals(
            $value,
            $encoded = $this->scratch->caesarEncoder('CAESAR', $shift)
        );
    }

    /**
     * @return array
     */
    public function cypherResults(): array
    {
        return [
            [1, 'DBFTBS'],
            [2, 'ECGUCT'],
            [3, 'FDHVDU'],
            [4, 'GEIWEV'],
            [5, 'HFJXFW'],
            [6, 'IGKYGX'],
            [7, 'JHLZHY'],
            [8, 'KIMAIZ'],
            [9, 'LJNBJA'],
            [10, 'MKOCKB'],
            [11, 'NLPDLC'],
            [12, 'OMQEMD'],
            [13, 'PNRFNE'],
            [14, 'QOSGOF'],
            [15, 'RPTHPG'],
            [16, 'SQUIQH'],
            [17, 'TRVJRI'],
            [18, 'USWKSJ'],
            [19, 'VTXLTK'],
            [20, 'WUYMUL'],
            [21, 'XVZNVM'],
            [22, 'YWAOWN'],
            [23, 'ZXBPXO'],
            [24, 'AYCQYP'],
            [25, 'BZDRZQ'],
        ];
    }

}
