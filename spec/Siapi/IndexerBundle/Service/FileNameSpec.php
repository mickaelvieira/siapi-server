<?php

namespace spec\Siapi\IndexerBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileNameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Siapi\IndexerBundle\Service\FileName');
    }

    function it_should_retreive_the_file_name_in_the_url()
    {
        $this->getFileNameFromUrl('http://photojournal.jpl.nasa.gov/jpeg/PIA18295.jpg')->shouldBeEqualTo('PIA18295.jpg');
    }

    function it_should_ignore_malformed_url()
    {
        $this->getFileNameFromUrl('whatever')->shouldBeNull();
    }

    function it_should_ignore_missing_file_name()
    {
        $this->getFileNameFromUrl('http://photojournal.jpl.nasa.gov/jpeg/')->shouldBeNull();
    }

    function it_should_ignore_missing_path()
    {
        $this->getFileNameFromUrl('http://photojournal.jpl.nasa.gov')->shouldBeNull();
    }

    function it_should_ignore_non_jpeg_extension()
    {
        $this->getFileNameFromUrl('http://photojournal.jpl.nasa.gov/jpeg/PIA18295.php')->shouldBeNull();
    }

    function it_should_append_a_suffix()
    {
        $this->appendSuffix('file.Name.php', 'suffix')->shouldBeEqualTo('file.Name-suffix.php');
    }
}
