<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APIC | AI Clinical Decision Support - Coming Soon</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>

    <header class="hero-section text-center">
        <div class="overlay"></div>

        <div class="d-flex justify-content-between align-items-start w-100 position-absolute top-0 start-0 p-3 px-md-4 pt-md-3" style="z-index: 1050;">
            
            <div data-aos="fade-down">
                <img src="{{asset('images/logo.png')}}" alt="APIC Logo" class="top-logo">
            </div>

            <div class="d-flex flex-column gap-2" data-aos="fade-down">
                <img src="{{asset('images/ios.png')}}" alt="iOS App" class="top-store-btn">
                
                <a href="https://play.google.com/store/apps/details?id=com.savethefeet" target="_blank">
                    <img src="{{asset('images/android.png')}}" alt="Android App" class="top-store-btn">
                </a>
            </div>
        </div>

        <div class="container position-relative z-index-2">
            <div class="launch-badge mb-3 mt-5" data-aos="zoom-in" data-aos-delay="100">
                <i class="fas fa-rocket me-2"></i> Launching Soon - 1st April (Part 1)
            </div>

            <h1 class="display-4 fw-bold text-dark mb-3 mt-5" data-aos="fade-up" data-aos-delay="200">
                Transforming Clinical Decisions with AI
            </h1>
            <p class="lead text-secondary mb-5 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="300">
                APIC is an advanced AI clinical decision support tool designed specifically for diabetic foot ulcer patients, empowering healthcare professionals with real-time insights.
            </p>

            <div class="swiper mySwiper mt-4 mb-5" data-aos="fade-up" data-aos-delay="400">
                <div class="swiper-wrapper align-items-center">
                    {{-- <div class="swiper-slide"><img src="{{asset('images/slide1.jpg')}}" alt="Slide 1" class="img-fluid rounded shadow-sm"></div> --}}
                    <div class="swiper-slide"><img src="{{asset('images/slide2.jpg')}}" alt="Slide 2" class="img-fluid rounded shadow-sm"></div>
                    <div class="swiper-slide"><img src="{{asset('images/slide3.jpg')}}" alt="Slide 3" class="img-fluid rounded shadow-sm"></div>
                    <div class="swiper-slide"><img src="{{asset('images/slide4.jpg')}}" alt="Slide 4" class="img-fluid rounded shadow-sm"></div>
                    <div class="swiper-slide"><img src="{{asset('images/slide5.jpg')}}" alt="Slide 5" class="img-fluid rounded shadow-sm"></div>
                    <div class="swiper-slide"><img src="{{asset('images/slide6.jpg')}}" alt="Slide 6" class="img-fluid rounded shadow-sm"></div>
                    <div class="swiper-slide"><img src="{{asset('images/slide7.jpg')}}" alt="Slide 7" class="img-fluid rounded shadow-sm"></div>
                </div>
                <div class="swiper-pagination mt-4 position-relative"></div>
            </div>
        </div>
    </header>

    <section class="about-section py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 theme-text" data-aos="fade-up">How APIC Assists Healthcare Professionals</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card h-100 p-4 text-center">
                        <div class="icon-wrapper mb-3"><i class="fas fa-microscope"></i></div>
                        <h5>Analyze Severity</h5>
                        <p class="text-muted small">Determine the precise size and severity of the diabetic foot ulcer using advanced AI image processing.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card h-100 p-4 text-center">
                        <div class="icon-wrapper mb-3"><i class="fas fa-chart-line"></i></div>
                        <h5>Real World Evidence</h5>
                        <p class="text-muted small">Backed by comprehensive real-world evidence to ensure reliable outcomes for diabetic foot ulcer patients.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card h-100 p-4 text-center">
                        <div class="icon-wrapper mb-3"><i class="fas fa-search-plus"></i></div>
                        <h5>Exudates Analysis</h5>
                        <p class="text-muted small">Accurately analyze the size of the wound as well as exudate levels to track healing progression.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card h-100 p-4 text-center">
                        <div class="icon-wrapper mb-3"><i class="fas fa-stopwatch"></i></div>
                        <h5>Faster Decisions</h5>
                        <p class="text-muted small">Streamline the treatment workflow, enabling faster, data-driven decision making for better patient care.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="interact-section dark-gradient-section py-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                
                <div class="col-lg-7 mb-5 mb-lg-0 text-center text-lg-start" data-aos="fade-right">
                    <h3 class="fw-bold text-white mb-4">Discover More</h3>
                    <div class="video-box mt-4">
                        <p class="fw-semibold text-light mb-2"><i class="fas fa-play-circle text-info me-2"></i>APIC Process Flow</p>
                        <div class="ratio ratio-16x9 shadow-lg rounded overflow-hidden border border-light border-opacity-25">
                            <iframe src="https://www.youtube.com/embed/zuqIF1HLX2Y?si=FrTDHsjHT3_piB1F" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left">
                    <div class="registration-card p-4 p-md-5 rounded shadow-lg">
                        <h3 class="fw-bold mb-3 theme-text">Our team will contact you soon!</h3>
                        <p class="text-muted mb-4">Register now to be notified the moment APIC goes live.</p>
                        <form id="registrationForm" method="POST" action="{{ route('doctor.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="fullName" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control custom-input" id="fullName" name="fullName" placeholder="Enter your full name">
                            </div>
                            <div class="mb-3">
                                <label for="emailAddress" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control custom-input" id="emailAddress" name="emailAddress" placeholder="Enter your email address">
                            </div>
                            <div class="mb-3">
                                <label for="mobileNumber" class="form-label fw-semibold">Mobile Number</label>
                                <input type="tel" class="form-control custom-input" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number">
                            </div>
                            <div class="mb-3">
                                <label for="speciality" class="form-label fw-semibold">Speciality</label>
                                <select class="form-select custom-input" id="speciality" name="speciality">
                                    <option value="" selected disabled>Select your speciality...</option>
                                    <option value="Diabetologist">Diabetologist</option>
                                    <option value="Endocrinologist">Endocrinologist</option>
                                    <option value="General Surgeon">General Surgeon</option>
                                    <option value="Podiatrist">Podiatrist</option>
                                    <option value="Wound Care Specialist">Wound Care Specialist</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="clinicName" class="form-label fw-semibold">Clinic / Hospital Name</label>
                                <input type="text" class="form-control custom-input" id="clinicName" name="clinicName" placeholder="Enter your clinic or hospital name">
                            </div>
                            <div class="mb-4">
                                <label for="city" class="form-label fw-semibold">City</label>
                                <input type="text" class="form-control custom-input" id="city" name="city" placeholder="Enter your city">
                            </div>
                            <button type="submit" class="btn btn-theme w-100 py-2 fw-bold">Register Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-4 bg-dark text-white">
        <p class="mb-2 small">&copy; 2026 APIC. All Rights Reserved. Transforming healthcare.</p>
        <p class="mb-0 small">
            <a href="mailto:kuldeep@swarnimtouch.com" class="text-white text-decoration-none">
                <i class="fas fa-envelope me-2"></i>kuldeep@swarnimtouch.com
            </a>
        </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>