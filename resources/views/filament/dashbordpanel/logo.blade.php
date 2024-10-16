<style>
    img.logo {
        /*height: 5.5rem;*/
        color: #DC2626;
        /*filter: saturate(200%) drop-shadow(0 0 10px);*/

    }

    .alink {
        color: rgb(0 135 81);
        font-weight: bold;
        font-family: 'Sora', sans-serif;
        display: inline-flex;
    }

    .alink:hover {
        text-decoration: underline;
    }

    .alink svg {
        margin-right: 5px;
        /*font-size: 1.2rem;*/
    }

    @-webkit-keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-20px, 0, 0);
            transform: translate3d(-20px, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-20px, 0, 0);
            transform: translate3d(-20px, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInLeft {
        -webkit-animation-name: fadeInLeft;
        animation-name: fadeInLeft;
    }

    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    .animated.delay-2s {
        -webkit-animation-delay: 2s;
        animation-delay: 2s;
    }


</style>
@if (request()->is('dashboard/login')||request()->is('dashboard/register') || request()->isMethod('post')||request()->is('dashboard/two-factor-authentication') )
    <a href="{{url('/')}}" wire:navigate.hover class="alink">
        <svg style="--c-400:var(--primary-400);--c-600:var(--primary-600);"
             class="fi-link-icon h-5 w-5 text-custom-600 dark:text-custom-400" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
            <path fill-rule="evenodd"
                  d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                  clip-rule="evenodd"></path>
        </svg>

        {!! __('Back to home page') !!}l</a>
@elseif(request()->is('dashboard/email-verification/prompt')||request()->is('dashboard/password-reset/request'))

@else
    <!-- Code pour afficher le logo de la marque -->
    <img src="{{asset('images/Logo_IUT_Douala.png')}}" title="iut de douala" class="logo h-20"
         alt="Logo iut">
@endif

