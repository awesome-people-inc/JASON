<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class ProfileCard extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    public $reloadTimeout = 10;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run($user)
    {
        return view('widgets.profile_card', [
            'user' => $user,
        ]);
    }

    public function placeholder()
    {
        return 'Loading...';
    }
}
