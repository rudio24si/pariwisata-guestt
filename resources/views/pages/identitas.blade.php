@extends('layouts.guest.app')

@section('content')
    <div class="container py-5">
        <!-- Header dengan gradient -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-header text-white py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">
                            <i class="bi bi-person-badge me-2"></i>Identitas Pengembang Sistem
                        </h1>
                        <p class="mb-0 mt-1 opacity-75 small">Profil dan informasi akademik pengembang aplikasi</p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ url('/') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-house me-1"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- Avatar / Profile Picture Side -->
                    <div class="col-md-4 bg-light p-5 text-center border-end">
                        <div class="mb-4">
                            <div class=" mx-auto mb-3 position-relative">
                                <img src="{{asset('assets/img/profile.jpg')}}" alt="Foto Pengembang"
                                    class="rounded-circle w-100 h-100">
                            </div>
                            <h3 class="mb-1">Rudio Winaldo</h3>
                            <p class="text-muted mb-3">
                                Mahasiswa Politeknik Caltex Riau
                            </p>
                        </div>

                        <!-- Quick Actions -->
                        <div class="d-grid gap-2 mb-4">
                            <a href="https://wa.me/6285265488368" target="_blank" class="btn btn-outline-success">
                                <i class="bi bi-whatsapp me-2"></i> Chat WhatsApp
                            </a>
                        </div>

                        <!-- Social Media Quick -->
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="text-muted mb-3">Temukan Saya</h6>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="https://www.linkedin.com/in/rudio-winaldo-80105139b/" target="_blank"
                                    class="btn btn-outline-primary btn-sm rounded-circle p-2">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="https://github.com/rudio24si" target="_blank"
                                    class="btn btn-outline-dark btn-sm rounded-circle p-2">
                                    <i class="bi bi-github"></i>
                                </a>
                                <a href="https://www.instagram.com/rudio.wnl?igsh=cG81eXdnZmU5bHJ4" target="_blank"
                                    class="btn btn-outline-danger btn-sm rounded-circle p-2">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="https://www.youtube.com/@KIDYOO999" target="_blank"
                                    class="btn btn-outline-danger btn-sm rounded-circle p-2">
                                    <i class="bi bi-youtube"></i>
                                </a>
                                <a href="https://open.spotify.com/artist/6nqUaZnhyELFxyEwZ3rtr0?si=sXMf2CFXQOeggRAMchJkZw"
                                    target="_blank" class="btn btn-outline-success btn-sm rounded-circle p-2">
                                    <i class="bi bi-spotify"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Data Details -->
                    <div class="col-md-8 p-5">
                        <div class="row">
                            <!-- Identitas Akademik Section -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-mortarboard me-2"></i>Identitas Akademik
                                </h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-person-vcard me-1"></i> NIM
                                        </span>
                                        <span class="text-dark fw-bold">2457301128</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-person me-1"></i> Nama Lengkap
                                        </span>
                                        <span class="text-dark">Rudio Winaldo</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-book me-1"></i> Program Studi
                                        </span>
                                        <span class="text-dark">Sistem Informasi</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-calendar me-1"></i> Angkatan
                                        </span>
                                        <span class="text-dark">2024</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-geo-alt me-1"></i> Kampus
                                        </span>
                                        <span class="text-dark">Politeknik Caltex Riau</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak Section -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-success mb-3 border-bottom pb-2">
                                    <i class="bi bi-telephone me-2"></i>Kontak & Media Sosial
                                </h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-envelope me-1"></i> Email
                                        </span>
                                        <span class="text-muted">rudio24si@mahasiswa.pcr.ac.id</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                        </span>
                                        <span class="text-muted">+62 852 6548 8368</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-linkedin me-1"></i> LinkedIn
                                        </span>
                                        <a href="https://www.linkedin.com/in/rudio-winaldo-80105139b/" target="_blank"
                                            class="text-decoration-none">
                                            <small
                                                class="text-primary">https://www.linkedin.com/in/rudio-winaldo-80105139b/</small>
                                        </a>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">
                                            <i class="bi bi-github me-1"></i> GitHub
                                        </span>
                                        <a href="https://github.com/rudio24si" target="_blank" class="text-decoration-none">
                                            <span class="text-dark">github.com/rudio24si</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Platform Media Sosial -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-info mb-3 border-bottom pb-2">
                                    <i class="bi bi-share me-2"></i>Platform Media Sosial
                                </h5>
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <a href="https://www.instagram.com/rudio.wnl?igsh=cG81eXdnZmU5bHJ4"
                                                    target="_blank" class="text-decoration-none">
                                                    <div class="p-3 bg-white rounded-3 border text-center hover-lift">
                                                        <div
                                                            class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-circle d-inline-flex p-3 mb-2">
                                                            <i class="bi bi-instagram text-white fs-4"></i>
                                                        </div>
                                                        <p class="mb-1 fw-medium text-dark">Instagram</p>
                                                        <p class="mb-0 text-muted small">@rudio.wnl</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="https://www.youtube.com/@KIDYOO999" target="_blank"
                                                    class="text-decoration-none">
                                                    <div class="p-3 bg-white rounded-3 border text-center hover-lift">
                                                        <div class="bg-danger rounded-circle d-inline-flex p-3 mb-2">
                                                            <i class="bi bi-youtube text-white fs-4"></i>
                                                        </div>
                                                        <p class="mb-1 fw-medium text-dark">YouTube</p>
                                                        <p class="mb-0 text-muted small">KIDYOO</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="https://open.spotify.com/artist/6nqUaZnhyELFxyEwZ3rtr0?si=sXMf2CFXQOeggRAMchJkZw"
                                                    target="_blank" class="text-decoration-none">
                                                    <div class="p-3 bg-white rounded-3 border text-center hover-lift">
                                                        <div class="bg-success rounded-circle d-inline-flex p-3 mb-2">
                                                            <i class="bi bi-spotify text-white fs-4"></i>
                                                        </div>
                                                        <p class="mb-1 fw-medium text-dark">Spotify</p>
                                                        <p class="mb-0 text-muted small">KIDYOO</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="https://github.com/rudio24si" target="_blank"
                                                    class="text-decoration-none">
                                                    <div class="p-3 bg-white rounded-3 border text-center hover-lift">
                                                        <div class="bg-dark rounded-circle d-inline-flex p-3 mb-2">
                                                            <i class="bi bi-github text-white fs-4"></i>
                                                        </div>
                                                        <p class="mb-1 fw-medium text-dark">GitHub</p>
                                                        <p class="mb-0 text-muted small">rudio24si</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-pink {
            background-color: #f783ac;
        }

        .text-pink {
            color: #f783ac;
        }

        .avatar-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 5px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .list-group-item {
            background: transparent;
            border-color: rgba(0, 0, 0, .125);
            transition: all 0.3s;
        }

        .list-group-item:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }

        .hover-lift {
            transition: all 0.3s;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary:hover,
        .btn-outline-success:hover {
            transform: translateY(-2px);
            transition: all 0.3s;
        }

        .bg-gradient-to-r {
            background: linear-gradient(to right, var(--tw-gradient-stops));
        }

        .from-blue-50 {
            --tw-gradient-from: #eff6ff;
            --tw-gradient-to: rgb(239 246 255 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        }

        .to-cyan-50 {
            --tw-gradient-to: #ecfeff;
        }

        .from-purple-500 {
            --tw-gradient-from: #a855f7;
            --tw-gradient-to: rgb(168 85 247 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        }

        .to-pink-500 {
            --tw-gradient-to: #ec4899;
        }
    </style>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Optional: JavaScript for interactivity -->
    <script>
        // Copy to clipboard functionality
        function copyToClipboard(text, elementId) {
            navigator.clipboard.writeText(text).then(() => {
                const element = document.getElementById(elementId);
                if (element) {
                    const original = element.innerHTML;
                    element.innerHTML = '<i class="bi bi-check"></i> Tersalin!';
                    setTimeout(() => {
                        element.innerHTML = original;
                    }, 2000);
                }
            });
        }

        // Add click to copy for contact info
        document.addEventListener('DOMContentLoaded', function () {
            // Add click to copy for email
            const emailElement = document.querySelector('[href^="mailto:"]');
            if (emailElement) {
                emailElement.style.cursor = 'pointer';
                emailElement.addEventListener('click', function (e) {
                    const email = this.href.replace('mailto:', '');
                    copyToClipboard(email, 'email-copy');
                });
            }

            // Add click to copy for WhatsApp
            const waElement = document.querySelector('[href*="wa.me"]');
            if (waElement) {
                waElement.style.cursor = 'pointer';
                waElement.addEventListener('click', function (e) {
                    const number = this.href.split('/').pop();
                    copyToClipboard(number, 'wa-copy');
                });
            }

            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all cards for animation
            document.querySelectorAll('.card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
@endsection