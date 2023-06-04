@extends('layouts.app')

@section('homeContent')
    <div class="home-main" style="text-align: center">
        <img class="home-main-img" src="image/handsome-sucessful-buisnessman-is-posing-for-photographer-on-the-dark-background.jpg" alt="">
        <div class="home-main-text-on-image">
            Elevate your professional style with our business attire
        </div>
    </div>


    <div class="container">
        <p style="font-size:18px" class="p-3 p-home-page">Welcome to our business attire store, where professionalism meets style. Discover our collection of elegant and sophisticated clothing that will elevate your work wardrobe. From tailored suits to sleek dresses, we've got you covered for any occasion. Let us help you make a lasting impression with our high-quality pieces that exude confidence and class. Shop now and elevate your business look to the next level!</p>
        <h2 class="p-3" style="text-align: center; font-size: 35px;color: #D4D4D4; font-weight: 500; font-family: Montserrat">Category</h2>
        <hr style="border: 1px solid;">
        <div class="row text-center justify-content-around py-3">
            @foreach ($categories as $item)
            <a href="/cat/{{$item->slug}}" class="col-sm-5 category-image py-3">
                <img style="width: 90%" src="{{$item->image}}" alt="{{$item->name}}">
                <div>{{$item->content}}</div>
            </a>
            @endforeach
        </div>
        <hr style="border: 1px solid;">
        <h2 class="p-3" style="text-align: center; font-size: 35px;color: #D4D4D4; font-weight: 500; font-family: Montserrat">New Arrivals</h2>
        
        <div class="row justify-content-between">  
            @foreach ($new_arrivals as $item)
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 py-3" >
                    <a class="catalog-links" href="/catalog/readMore/{{$item->id}}" style="m-3">
                        <img src="{{$item->image}}" alt="{{$item->name}}">
                        <p>{{$item->short_title}}</p>
                        <p>{{$item->price}} $</p>
                    </a>
                </div>
            @endforeach
        </div>
        <hr>

        <h2 class="p-3" style="text-align: center; font-size: 35px;color: #D4D4D4; font-weight: 500; font-family: Montserrat">Clothes For Mens</h2>
        
        <div class="row justify-content-between">  
            @foreach ($mens_clothes as $item)
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 py-3" >
                    <a class="catalog-links" href="/catalog/readMore/{{$item->id}}" style="m-3">
                        <img src="{{$item->image}}" alt="{{$item->name}}">
                        <p>{{$item->short_title}}</p>
                        <p>{{$item->price}} $</p>
                    </a>
                </div>
            @endforeach
        </div>

        
        
        {{-- <hr style="border: 1px solid; mt-6"> --}}
        <h2 class="p-3" style="text-decoration: none; text-align: center; font-size: 30px;color: #D4D4D4; font-weight: 600; font-family: Montserrat; margin-bottom: -25px">
            <a class="see-more btn btn-outline-light" href="/catalogs">See More</a>
        </h2>
        
        {{-- <div class="container-fluid" style="background-color: #FFFFFF; width: 100%; left: 0; right: 0">
            <section class="featured section-padding position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                            <div class="banner-features wow fadeIn animated hover-up">
                                <img src="image/icons/feature-1.png" alt="">
                                <h4 class="btn-dark">Free Shipping</h4>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                            <div class="banner-features wow fadeIn animated hover-up">
                                <img src="image/icons/feature-2.png" alt="">
                                <h4 class="btn-dark">Online Order</h4>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                            <div class="banner-features wow fadeIn animated hover-up">
                                <img src="image/icons/feature-3.png" alt="">
                                <h4 class="btn-dark">Save Money</h4>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                            <div class="banner-features wow fadeIn animated hover-up">
                                <img src="image/icons/feature-4.png" alt="">
                                <h4 class="btn-dark">Promotions</h4>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                            <div class="banner-features wow fadeIn animated hover-up">
                                <img src="image/icons/feature-5.png" alt="">
                                <h4 class="btn-dark">Happy Sell</h4>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                            <div class="banner-features wow fadeIn animated hover-up">
                                <img src="image/icons/feature-6.png" alt="">
                                <h4 class="btn-dark">24/7 Support</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> --}}
        
        

        {{-- <hr style="border: 1px solid;">
        <h2 class="p-3" style="text-align: center; font-size: 40px;color: #D4D4D4; font-weight: 600; font-family: Montserrat">The Most Popular</h2> --}}
    
    
    </div>


@endsection

@section('title')
    Otomow Shop
@endsection