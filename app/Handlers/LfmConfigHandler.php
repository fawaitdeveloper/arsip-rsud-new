<?php

namespace App\Handlers;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        return auth()->user()->job_position_id == null ? auth()->user()->id :  auth()->user()->job_position_id;
    }
}
