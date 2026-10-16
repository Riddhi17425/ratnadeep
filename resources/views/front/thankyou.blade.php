@extends('front.layouts.main')

@section('content')
<section class="thankyou-section py-5">
    <div class="container text-center">
        <div class="thankyou-content mx-auto">

            <div class="thankyou-icon mb-4">
                <svg width="80" height="80" viewBox="0 0 80 80"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="40" r="38"
                            stroke="#198754" stroke-width="3"/>
                    <path d="M23 40L34 51L57 28"
                          stroke="#198754" stroke-width="4"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>

            <h1>Thank You!</h1>

            <h3>Your enquiry has been submitted successfully.</h3>

            <p>
                Our team has received your enquiry
                and will get back to you as soon as possible.
            </p>

            <a href="{{ url('/') }}" class="com_btn_red">
                Back to Home
            </a>

        </div>
    </div>
</section>

<style>
    .thankyou-section {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 70px 15px;
    }

    .thankyou-content {
        max-width: 650px;
    }

    .thankyou-icon {
        display: flex;
        justify-content: center;
    }

    .thankyou-content h1 {
        margin-bottom: 15px;
        font-size: 42px;
    }

    .thankyou-content h3 {
        margin-bottom: 15px;
        font-size: 23px;
    }

    .thankyou-content p {
        margin-bottom: 30px;
        line-height: 1.8;
    }

    .thankyou-content .com_btn_red {
        display: inline-block;
        text-decoration: none;
    }
</style>
@endsection