@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6 p-abut-page">
                <h1 class="mb-4">About US</h1>
                <p>The Otomow business clothing store is located in Czestochowa, at 16 Adama Bienia street. Our store offers a wide selection of high-quality business clothing for both men and women, including suits, jackets, pants, shirts, and much more.</p>
                <p>We strive to provide our customers not only with top-quality products but also with the best service. Our team of experienced sales consultants is always ready to help you choose the suitable clothing that will highlight your individuality and satisfy all your needs.</p>
            </div>
            <div class="col-md-6">
                <img src="image/600x400.jpg" alt="Наша команда" class="img-fluid">
            </div>
        </div>
        <div class="row mt-5 mis-cen-com-about-page">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                    <h2 class="card-title">Company Description</h2>
                    <p class="card-text">Otomow Shop is a business clothing store located in the city of Czestochowa. We specialize in selling high-quality business attire that follows the latest fashion trends. Our team consists of professionals who are always ready to help our clients choose the best clothing for their business image.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Address</h2>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2523.228874318247!2d19.142283858221326!3d50.771330698793875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4710ca81825238c3%3A0x19b82ac314d2f9bb!2sAdama%20Bienia%2016%2C%2042-208%20Cz%C4%99stochowa!5e0!3m2!1suk!2spl!4v1681405117055!5m2!1suk!2spl" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Our Values</h2>
                        <ul class="list-unstyled">
                            <li>Quality - we offer only the best business attire.</li>
                            <li>Service - we strive to provide our customers with the best service.</li>
                            <li>Individuality - we help our customers find clothing that accentuates their individuality.</li>
                            <li>Professionalism - our team consists of experienced sales consultants who are ready to assist you with any questions.</li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mis-cen-com-about-page">
            <div class="col-md-6">
              <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Our mission</h2>
                    <p class="card-text">We want to help our customers feel confident and stylish in their business clothes by providing high-quality products and professional service.</p>
                    {{-- <p class="card-text">ул. Адама Беня 16, Ченстохова, Польша</p> --}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4">
                <div class="card-body">
                  <h2 class="card-title">Contact information</h2>
                  <ul class="list-unstyled">
                    <li>Phone: +48 536 286 013, +38 096 404 21 16</li>
                    <li>Email: info@otomowshop.com</li>
                  </ul>
                </div>
              </div>
            </div>
        </div>  
    </div>
@endsection

@section('title')
    Otomow About US 
@endsection