<x-dynamic.auth.signin user="patient" :users="[
    'administrator' => route('web.administrator.login_show'),
    'patient' => route('web.patient.login_show'),
    'midwife' => route('web.midwife.login_show'),
]" :action="route('web.patient.login_perform')" :register="route('web.patient.register_show', ['want_order' => request()->query('want_order')])" title="Sign In for Patient"
    description="Sign In for Patient Page" :name="'sistem informasi pemesanan layanan homecare'">
</x-dynamic.auth.signin>
