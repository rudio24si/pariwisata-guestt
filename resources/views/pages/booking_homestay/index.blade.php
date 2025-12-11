@extends('layouts.guest.app')

@section('content')
    <!-- Main -->
    <main>
        <!-- Featured Tour -->
        <div class="featured-tour mt-100 mb-100">
            <new-tab>
                <div class="container">
                    <div class="section-headings section-headings-horizontal">
                        <div class="section-headings-left">
                            <h2 class="heading text-50" data-aos="fade-up">Booking</h2>
                            <div class="text text-18" data-aos="fade-up" data-aos-delay="50">Booking sekarang</div>
                        </div>
                        <a href="destination-list.html" class="button button--primary d-none d-md-flex" data-aos="fade-up"
                            data-aos-delay="100">View All Package</a>
                    </div>
                    <div class="tab-contents section-content">
                        <div class="tab-item group active">
                            <div class="row grid-gap">
                                @foreach ($kamars as $k)
                                    <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up">
                                        <div class="product-card radius16 hover-on-image">
                                            <div class="image">
                                                <img src="assets/img/product/1.jpg" width="734" height="534" loading="lazy"
                                                    alt="Product Image">
                                                <div class="review text text-14">
                                                    <svg class="icon-12" width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_58_3674)">
                                                            <path
                                                                d="M11.4485 4.58548C11.3733 4.35305 11.1672 4.18797 10.9233 4.16599L7.6103 3.86517L6.30026 0.798893C6.20367 0.574174 5.98368 0.428711 5.73925 0.428711C5.49483 0.428711 5.27484 0.574174 5.17825 0.799418L3.86821 3.86517L0.554701 4.16599C0.311242 4.1885 0.105615 4.35305 0.0300369 4.58548C-0.0455407 4.8179 0.0242569 5.07283 0.208428 5.23354L2.71265 7.42975L1.97421 10.6826C1.92018 10.9217 2.01301 11.169 2.21145 11.3124C2.31812 11.3895 2.44292 11.4287 2.56876 11.4287C2.67727 11.4287 2.7849 11.3994 2.88149 11.3416L5.73925 9.63368L8.59597 11.3416C8.80501 11.4674 9.06852 11.4559 9.26653 11.3124C9.46506 11.1685 9.55781 10.9212 9.50377 10.6826L8.76534 7.42975L11.2696 5.23397C11.4537 5.07283 11.524 4.81834 11.4485 4.58548Z"
                                                                fill="currentColor" />
                                                        </g>
                                                        <defs>
                                                            <clipPath>
                                                                <rect width="12" height="12" fill="currentColor" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <strong>4.96</strong> (672 reviews)
                                                </div>
                                                <div class="badge text text-16 fw-500">Top Rated</div>
                                                <toggle-btn>
                                                    <button type="button" class="wishlist-icon toogle-btn text-sky">
                                                        <span class="svg-wrapper icon-20">
                                                            <svg viewBox="0 0 20 17" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.0705 9.36168L11.4136 15.0186C10.6326 15.7996 9.36623 15.7996 8.58519 15.0186L2.92833 9.36168C0.975712 7.40908 0.975712 4.24326 2.92833 2.29064C4.88095 0.338014 8.04678 0.338014 9.9994 2.29064C11.952 0.338014 15.1178 0.338014 17.0705 2.29064C19.0231 4.24326 19.0231 7.40908 17.0705 9.36168Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </toggle-btn>
                                            </div>
                                            <div class="content">
                                                <a href="booking-details.html" class="no-underline product-title"
                                                    aria-label="Product title">
                                                    <h2 class="heading text-24">{{$k->nama_kamar}}</h2>
                                                </a>
                                                <ul class="card-person-time list-unstyled">
                                                    <li class="person-time-item text text-16">
                                                        <div class="svg-wrapper icon-16">
                                                            <svg viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_58_3659)">
                                                                    <path
                                                                        d="M8.00032 0.666992C6.54993 0.666992 5.1321 1.09709 3.92614 1.90289C2.72018 2.70868 1.78025 3.85399 1.22521 5.19398C0.670169 6.53398 0.524945 8.00846 0.807903 9.43099C1.09086 10.8535 1.78929 12.1602 2.81488 13.1858C3.84046 14.2114 5.14714 14.9098 6.56966 15.1928C7.99219 15.4757 9.46668 15.3305 10.8066 14.7755C12.1466 14.2204 13.2919 13.2805 14.0977 12.0745C14.9035 10.8686 15.3336 9.45073 15.3336 8.00033C15.3313 6.05611 14.558 4.19218 13.1832 2.81741C11.8084 1.44264 9.94454 0.669286 8.00032 0.666992ZM10.4716 10.4717C10.3466 10.5967 10.1771 10.6669 10.0003 10.6669C9.82355 10.6669 9.65401 10.5967 9.52899 10.4717L7.52899 8.47166C7.40396 8.34667 7.3337 8.17713 7.33366 8.00033V4.00033C7.33366 3.82352 7.4039 3.65395 7.52892 3.52892C7.65394 3.4039 7.82351 3.33366 8.00032 3.33366C8.17714 3.33366 8.34671 3.4039 8.47173 3.52892C8.59675 3.65395 8.66699 3.82352 8.66699 4.00033V7.72433L10.4716 9.529C10.5966 9.65401 10.6668 9.82355 10.6668 10.0003C10.6668 10.1771 10.5966 10.3467 10.4716 10.4717Z"
                                                                        fill="currentColor" fill-opacity="1" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath>
                                                                        <rect width="16" height="16" fill="currentColor" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </div>
                                                        2 days 3 nights
                                                    </li>
                                                    <li class="person-time-item text text-16">
                                                        <div class="svg-wrapper icon-16">
                                                            <svg viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M4.83341 4.66667C4.83341 2.92067 6.25408 1.5 8.00008 1.5C9.74608 1.5 11.1667 2.92067 11.1667 4.66667C11.1667 6.41267 9.74608 7.83333 8.00008 7.83333C6.25408 7.83333 4.83341 6.41267 4.83341 4.66667ZM10.0001 8.83333H6.00008C3.88675 8.83333 2.16675 10.5533 2.16675 12.6667C2.16675 13.678 2.98875 14.5 4.00008 14.5H12.0001C13.0114 14.5 13.8334 13.678 13.8334 12.6667C13.8334 10.5533 12.1134 8.83333 10.0001 8.83333Z"
                                                                    fill="currentColor" fill-opacity="1" />
                                                            </svg>
                                                        </div>
                                                        4-6 guest
                                                    </li>
                                                </ul>
                                                <div class="price-booking-wrap">
                                                    <div class="card-price">
                                                        <span class="heading text-24">$48.25</span>
                                                        <span class="text text-16">/ person</span>
                                                    </div>
                                                    <a href="{{ route('booking-homestay.create', ['kamar_id' => $k->kamar_id]) }}" class="button button--primary button--slim"
                                                        aria-label="Product card button">Book Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="destination.html" class="button button--primary d-md-none d-flex" aria-label="Button"
                            data-aos="fade-up" data-aos-delay="50">
                            View All Package
                        </a>
                    </div>
                </div>
            </new-tab>
        </div>
    </main>
@endsection