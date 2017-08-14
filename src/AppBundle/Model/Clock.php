<?php

namespace AppBundle\Model;

interface Clock
{
    public function now() : \DateTimeImmutable;
}