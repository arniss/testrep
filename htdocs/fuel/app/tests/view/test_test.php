<?php namespace Fuel\Core;

/**
 * Arr class tests
 *
 * @group Core
 * @group Arr
 */
class Tests_Arr extends TestCase {

    /**
     * Tests Arr::flatten_assoc()
     *
     * @test
     */
    public function test_flatten_assoc()
    {
        $people = array(
            array(
                "name" => "Jack",
                "age" => 21
            ),
            array(
                "name" => "Jill",
                "age" => 23
            )
        );

        $expected = array(
            "0:name" => "Jack",
            "0:age" => 21,
            "1:name" => "Jill",
            "1:age" => 23
        );

        $output = Arr::flatten_assoc($people);
        $this->assertEquals($expected, $output);
    }

}
?>