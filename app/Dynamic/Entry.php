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
                'register' => route('web.administrator.register_show'),
                'forgot' => route('web.administrator.login_show'),
                'tos' => route('web.administrator.login_show'),
                'template' => session('template_administrator', $this->config['application']['template']),
                'account' => [
                    'name' => 'admin',
                    'email' => 'admin@host.local',
                    'password' => 'admin',
                    'remember' => true,
                    'aggrement' => true,
                ],
                'demo' => true,
            ],
            'patient' => [
                'name' => 'Patient',
                'entry' => route('web.patient.login_show'),
                'register' => route('web.patient.register_show'),
                'forgot' => route('web.patient.login_show'),
                'tos' => route('web.patient.login_show'),
                'template' => session('template_patient', $this->config['application']['template']),
                'account' => [
                    'name' => 'patient',
                    'email' => 'patient@host.local',
                    'password' => 'patient',
                    'remember' => true,
                    'aggrement' => true,
                ],
                'demo' => true,
                'landing' => route('web.patient.landing'),
            ],
            'midwife' => [
                'name' => 'Midwife',
                'entry' => route('web.midwife.login_show'),
                'register' => route('web.midwife.register_show'),
                'forgot' => route('web.midwife.login_show'),
                'tos' => route('web.midwife.login_show'),
                'template' => session('template_midwife', $this->config['application']['template']),
                'account' => [
                    'name' => 'midwife',
                    'email' => 'midwife@host.local',
                    'password' => 'midwife',
                    'remember' => true,
                    'aggrement' => true,
                ],
                'demo' => true,
            ],
        ];
    }
}
