@extends('layouts.layout')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/location.css') }}">
@endsection
@section('content')
   

  <div class="locations">
    <h2>Our Branches</h2>
    <div class="branches-container">
      <!-- فرع القاهرة -->
      <div class="branch">
        <h3>Branch 1: Nasr City</h3>
        <p>Location: سوق ٢٥، محمد المقريف، مدينة نصر، محافظة القاهرة‬</p>
        <p>Phone: 01111439431</p>
        <p>Working Hours: 9 AM - 10 PM</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55259.941618342644!2d31.428740178320304!3d30.044134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583de07ea19089%3A0x7330cbfe8f466f9c!2z2YXYsdmD2LIg2KfZhNio2LfZhCDZiNin2YTYtNmK2K4g2YTYtdmK2KfZhtipINmI2KrYrNiv2YrYryDYp9mE2LPZitin2LHYp9iq!5e0!3m2!1sar!2seg!4v1736885815338!5m2!1sar!2seg" 
        loading="lazy"></iframe>
        <a href="https://maps.app.goo.gl/bhYtmybfqCNcxTZ7A" target="_blank" class="map-button">
          View Full Map
        </a>
      </div>
      
      <!-- فرع الإسكندرية -->
      <div class="branch">
        <h3>Branch 2: Giza</h3>
        <p>Location: ش عثمان احمد عثمان متفرع من المريوطية, الهرم</p>
        <p>Phone: 01200636446</p>
        <p>Working Hours: 11 AM - 9 PM</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d221040.0100314468!2d31.552353876300565!3d30.04402484493921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145847d59928294f%3A0xb39d8888ec9a0f2b!2z2KfZhNmF2LXYsdmK2Kkg2YTYtdmK2KfZhtipINin2YTYs9mK2KfYsdin2Kog2KfZhNit2K_Zitir2KkgQU1B!5e0!3m2!1sar!2seg!4v1736886165418!5m2!1sar!2seg"
        loading="lazy"></iframe>
        <a href="https://maps.app.goo.gl/My6AKMTAT8na78Z28" target="_blank" class="map-button">
          View Full Map
        </a>
      </div>

      <!-- فرع الجيزة -->
      <div class="branch center-branch">
        <h3>Branch 3: Heliopolis</h3>
        <p>Location:قباء، جسر السويس، قسم مصر الجديدة، محافظة القاهرة‬</p>
        <p>Phone: 01234567890</p>
        <p>Working Hours: 8 AM - 4 PM</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d221040.46849162993!2d31.55235501745788!3d30.043819376545184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583bcaa1cb2e3d%3A0x6c93516f19749a63!2sAuto%20Home%20Center!5e0!3m2!1sar!2seg!4v1736886409945!5m2!1sar!2seg" 
        loading="lazy" ></iframe>
        <a href="https://maps.app.goo.gl/ur5T3CkcBAQzdD5W8" target="_blank" class="map-button">
          View Full Map
        </a>
      </div>
    </div>
  </div>


<script src="{{asset('assetes/JS/script.js')}}"></script>
 @endsection