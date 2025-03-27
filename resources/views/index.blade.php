<?php //echo phpinfo(); ?>



@extends('layouts.layout')
@section('content')
<div class="main">

        <div class="content">
            <div class="about-text">
                <h2>about <span> us</span></h2>
                <p id="short-text">Car Zone is a well-established automotive service center with three branches offering
                    top-tier services across various locations We specialize in car display
                    and parts replacement to ensure your vehicle runs smoothly. Our mission is to provide
                    customer-oriented solutions, combining professionalism with a passion for cars...<a
                        href="javascript:void(0);" id="read-more" onclick="showText()">Read More</a></p>
                <p id="full-text" style="display:none;">
                    Our vision is to be the trusted partner for all your automotive needs,
                    equipped with a skilled team, state-of-the-art tools,
                    and dedication to offering reliable and efficient services.
                    Whether you're in need of quick repairs or routine maintenance,
                    Car Zone ensures a safe and seamless experience for all car owners.
                    Visit us today to experience the best in automotive care!</p>

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

</div>
        
@endsection