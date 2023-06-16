<?php

namespace App\Dynamic;

class Entry
{
    /** @return Entry */
    public static function create()
    {
        $entry = new Entry();
        return $entry;
    }
    public mixed $config = [];
    public Updates $updates;

    public function __construct() {
        $this->config = config('dynamic');
        $this->updates = new Updates();
        $this->updates->load();
        $this->updates->generate_changes();
    }

    public function get_users()
    {
        return [
            'administrator' => [
                'name' => 'Administrator',
                'entry' => route('web.administrator.login_show'),
                'template' => session('template_administrator', $this->config['application']['template']),
                'account' => [
                    'name' => 'admin',
                    'password' => 'admin',
                    'remember' => true,
                ],
                'demo' => true,
            ],
        ];
    }
}
