<x-dynamic.auth.signup :user="'patient'" :users="[
    'administrator' => route('web.administrator.register_show'),
    'patient' => route('web.patient.register_show'),
    'midwife' => route('web.midwife.register_show'),
]" :action="route('web.patient.register_perform')" :login="route('web.patient.login_show')"
    title="Sign Up for Patient" description="Sign Up for Patient Page" :name="'sistem informasi pemesanan layanan homecare'">
</x-dynamic.auth.signup>
