<?php

namespace spec\Siapi\IndexerBundle\Gallery;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SizeManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Siapi\IndexerBundle\Gallery\SizeManager');
    }

    function it_should_find_the_crop_command()
    {
        $this->find('large')->shouldHaveType('Siapi\IndexerBundle\Gallery\Strategy\Large');
    }

    function it_should_throw_an_exception_when_a_command_does_not_exist()
    {
        $this->shouldThrow('\LogicException')->duringFind('test');
    }
}
