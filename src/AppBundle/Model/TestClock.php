<?php

namespace AppBundle\Model;

use Symfony\Component\Filesystem\Filesystem;

class TestClock implements Clock
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $dir;

    /**
     * @var string
     */
    private $file;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        $this->dir = sys_get_temp_dir() . '/time';
        $this->file = $this->dir . '/timefile';
    }

    public function setTime(string $time)
    {
        $this->filesystem->mkdir($this->dir);

        if ($this->filesystem->exists($this->file)) {
            $this->filesystem->remove($this->file);
        }

        $isoDateTime = (new \DateTimeImmutable($time))
            ->format('c')
        ;

        $this->filesystem->dumpFile(
            $this->file,
            $isoDateTime
        );
    }    
    
    public function now(): \DateTimeImmutable
    {
        if (false === $this->filesystem->exists($this->file)) {
            throw new \RuntimeException('Must set the time file before doing this.');
        }

        return new \DateTimeImmutable(
            file_get_contents($this->file)
        );
    }
}