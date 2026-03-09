<?php

namespace App\Contracts\Event;

interface EventService
{
    public function store();
    public function update();
    public function destroy();
    public function restore();
    public function forceDestroy();
    //public function ();
}
