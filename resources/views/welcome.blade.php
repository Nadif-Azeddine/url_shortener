@extends('layouts.app')

@section('title')
    <title>squaHR-Welcome</title>
@endsection

@section('content')
    <section class="all" >

        <div class="txt-img">
            <div class="img">
                <img src="{{ url('/asset/www.svg') }}" alt="illustration">
            </div>
            <div class="txt">
                <h1 class="sp-title">squahr code shortener</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat eveniet impedit quibusdam non
                    perspiciatis ad mollitia rerum dicta nisi consequuntur.</p>
            </div>
            <a href="/squahr_code_shortener" class="squahr_btn" style="width: 400px;max-width: 100%">get started</a>
        </div>

    </section>
    <div class="txt_bf_serv">
        <h3>Check Our Other Services !</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda sequi, ad molestias quae laudantium et?</p>
    </div>
   <div class="services">
    <div class="service">
        <h3>service</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, debitis!</p>
    </div>
    <div class="service">
        <h3>service</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, debitis!</p>
    </div>
    <div class="service">
        <h3>service</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, debitis!</p>
    </div>
   </div>
    
    <footer id="footer">
        <div class="sec">
            <h2>Lorem ipsum dolor.
            </h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste minima cumque debitis. Expedita eos fugiat
                itaque ex quod natus? Nesciunt.</p>
        </div>
        <div class="sec">
            <h2>Lorem ipsum dolor.
            </h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste minima cumque debitis. Expedita eos fugiat
                itaque ex quod natus? Nesciunt.</p>
        </div>
        <div class="sec">
            <h2>Lorem ipsum dolor.
            </h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste minima cumque debitis. Expedita eos fugiat
                itaque ex quod natus? Nesciunt.</p>
        </div>

    </footer>
@endsection
