<div class="panel panel-default">
    <div class="panel-heading">reCAPTCHA</div>
    <div class="panel-body">

        @if (! (env('NOCAPTCHA_SITEKEY') && env('NOCAPTCHA_SECRET')))
            <div class="callout callout-info">
                <p>
                   Para utilizar o Google reCAPTCHA pegue <code>site key</code> e <code>secret key</code>
                    do <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank"><strong>site do reCAPTCHA</strong></a>,
                    e atualize <code>NOCAPTCHA_SITEKEY</code> e <code>NOCAPTCHA_SECRET</code> nas variáveis do ambiemte no arquivo <code>.env</code>.
                </p>
            </div>
        @else
            @if (setting('registration.captcha.enabled'))
                <form action="{{route('dashboard.settings.registration.captcha.disable')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times"></i>
                        Desabilitar
                    </button>
                </form>
            @else
                <form action="{{route('dashboard.settings.registration.captcha.enable')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-refresh"></i>
                        Habilitar
                    </button>
                </form>
            @endif
        @endif
    </div>
</div>
