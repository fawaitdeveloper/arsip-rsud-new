<?php

namespace App\Helpers;

use App\Models\JobPosition;

class FlowHelper
{
    private $data;
    private $number = 1;
    private $sender = null;
    private $receiver = null;

    public function __construct()
    {
        $this->data = collect([]);
        $this->number = 1;
    }


    function where($from, $to)
    {
        $sender = JobPosition::with('parent')->where('id', $from)->first();
        $receiver = JobPosition::with('parent')->where('id', $to)->first();
        $this->sender = $sender->name;
        $this->receiver = $receiver->name;

        $this->data->push([
            'id' => $sender->id,
            'name' => $sender->name,
            'parent_id' => $sender->parent_id,
            'number' => $this->number,
            'parent_name' => $sender->parent->name ?? null,
            'access' => 'R'
        ]);
        $this->number = $this->number + 1;
        if ($sender->prefix != $receiver->prefix) {
            $getParentSender = static::getParent($sender->parent_id);
            $getParentReceiver = static::getParent($receiver->parent_id);
            $this->data = $this->data->merge($getParentSender->toArray());
            $this->data = $this->data->merge($getParentReceiver->toArray());
        } else if ($sender->prefix == $receiver->prefix && $sender->parent_id == $receiver->id) {
            $this->data->push([
                'id' => $receiver->id,
                'name' => $receiver->name,
                'parent_id' => $receiver->parent_id,
                'number' => $this->number,
                'parent_name' => $receiver->parent->name ?? null,
                'access' => 'RFT'
            ]);
        } else if ($sender->prefix == $receiver->prefix && $sender->id == $receiver->parent_id) {
            $this->data->push([
                'id' => $sender->id,
                'name' => $sender->name,
                'parent_id' => $sender->parent_id,
                'number' => $this->number,
                'parent_name' => $sender->parent->name ?? null,
                'access' => 'RFT'
            ]);
        } else if ($sender->prefix == $receiver->prefix && $sender->parent_id == $receiver->parent_id) {
            $findParent =  JobPosition::with('parent')->where('id', $sender->parent_id)->first();
            $this->data->push([
                'id' => $findParent->id,
                'name' => $findParent->name,
                'parent_id' => $findParent->parent_id,
                'number' => $this->number,
                'parent_name' => $findParent->parent->name ?? null,
                'access' => 'RF'
            ]);
            $this->number = $this->number + 1;
        } else if ($sender->prefix == $receiver->prefix && $sender->parent_id != $receiver->parent_id) {
            $getParentSender = static::getParent($sender->parent_id, $sender->prefix == "right" ? 15 : 2);
            $getParentReceiver = static::getParent($receiver->parent_id, $receiver->prefix == "right" ? 15 : 2);
            $this->data = $this->data->merge($getParentSender->toArray());
            $this->data = $this->data->merge($getParentReceiver->toArray());
        }

        $this->data->push([
            'id' => $receiver->id,
            'name' => $receiver->name,
            'parent_id' => $receiver->parent_id,
            'number' => $this->number - 1,
            'parent_name' => $receiver->parent->name ?? null,
            'access' => 'RFT'
        ]);

        return $this;
    }

    public function sortBy()
    {
        $this->data = $this->data->sortBy('number');
        return $this;
    }

    public function unique()
    {
        $this->data = $this->data->unique('id');
        return $this;
    }

    public function get()
    {
        return collect([
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'flow' => $this->data
        ]);
    }

    public function limit($value)
    {
        return collect([
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'flow' => $this->data->take($value)
        ]);
    }

    private function getParent($parentID, $max = 1)
    {
        $newData = collect([]);
        // query get parent
        $findData = JobPosition::with('parent')->where('id', $parentID)->first();
        $newData->push([
            'id' => $findData->id,
            'name' => $findData->name,
            'parent_id' => $findData->parent_id,
            'number' => $this->number,
            'parent_name' => $findData->parent->name ?? null,
            'access' => 'RF'
        ]);
        $this->number = $this->number + 1;

        while (true) {
            if ($findData->id == $max) {
                break;
            } else {
                $findData = JobPosition::with('parent')->where('id', $findData->parent_id)->first();
                $newData->push([
                    'id' => $findData->id,
                    'name' => $findData->name,
                    'parent_id' => $findData->parent_id,
                    'number' => $this->number,
                    'parent_name' => $findData->parent->name ?? null,
                    'access' => 'RF'
                ]);
                $this->number = $this->number + 1;
            }
        }


        return $newData;
    }
}
