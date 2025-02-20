@extends('layouts.layout')
@section('content')
    <div class="main">

        <div class="content">
            <div class="about-text">
                <h2>about <span> us</span></h2>
                <p id="short-text"> Carzone is an innovative online platform designed to transform the way cars are bought and sold. By leveraging cutting-edge technology, Carzone offers a secure, user-friendly, and efficient solution for automotive transactions. With a focus on trust and transparency, the platform bridges the gap between buyers and sellers, creating a seamless and trustworthy experience.


            </div>
            <div class="image">
                <img src="{{ asset('assets/img/banner-img.png') }}" alt="">
            </div>
        </div>
        <!-- end about us -->
        <section class="offers-section">
            <h1>our best offers</h1>
            <div class="offers-container">
                <div class="card">
                    <img src="{{ asset('assets/img/img-1.png') }}" alt="Toyota Car">
                    <h2>Mercedes CAR</h2>
                    <p>Starting price from 5,500,000EGP</p>
                    <button class="book-btn" onclick="bookNow()">Book Now</button>
                </div>
                <div class="card">
                    <img src="{{ asset('assets/img/img-2.png') }}" alt="Toyota Car">
                    <h2>Mercedes CAR</h2>
                    <p>Starting price from 6,250,000EGP</p>
                    <button class="book-btn" id="book2" onclick="bookNow()">Book Now</button>
                </div>
                <div class="card">
                    <img src="{{ asset('assets/img/img-3.png') }}" alt="Toyota Car" class="ig3">
                    <h2>Mercedes CAR</h2>
                    <p>Starting price from 7,000,000EGP</p>
                    <button class="book-btn" onclick="bookNow()">Book Now</button>
                </div>
                <div class="card">
                    <img src="{{ asset('assets/img/img-1.png') }}" alt="Toyota Car">
                    <h2>Mercedes CAR</h2>
                    <p>Starting price from 5,500,000EGP</p>
                    <button class="book-btn" onclick="bookNow()">Book Now</button>
                </div>
                <div class="card">
                    <img src="{{ asset('assets/img/img-2.png') }}" alt="Toyota Car">
                    <h2>Mercedes CAR</h2>
                    <p>Starting price from 6,250,000EGP</p>
                    <button class="book-btn" id="book4" onclick="bookNow()">Book Now</button>
                </div>
                <div class="card">
                    <img src="{{ asset('assets/img/img-3.png') }}" alt="Toyota Car">
                    <h2>Mercedes CAR</h2>
                    <p>Starting price from 7,500,000EGP</p>
                    <button class="book-btn" onclick="bookNow()">Book Now</button>
                </div>
            </div>
        </section>


    
@endsection
@section('endFooter')
    </div>
@endsection
