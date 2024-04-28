<?php

namespace App\Services;

class FlashMessage
{
    public function success($message)
    {
        session()->flash('success', $message);
    }

    public function error($message)
    {
        session()->flash('error', $message);
    }

    public function info($message)
    {
        session()->flash('info', $message);
    }

    public function has($type)
    {
        return session()->has($type);
    }

    public function get($type, $default = null)
    {
        return session()->get($type, $default);
    }

    public function clear($type = null)
    {
        if ($type) {
            session()->forget($type);
        } else {
            session()->forget('success');
            session()->forget('error');
            session()->forget('info');
        }
    }
}