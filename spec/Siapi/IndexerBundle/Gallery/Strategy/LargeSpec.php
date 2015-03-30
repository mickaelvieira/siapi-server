<?php

namespace spec\Siapi\IndexerBundle\Gallery\Strategy;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LargeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Siapi\IndexerBundle\Gallery\Strategy\Large');
    }

    function it_should_return_its_name()
    {
        $this->getName()->shouldBeEqualTo('large');
    }
}
