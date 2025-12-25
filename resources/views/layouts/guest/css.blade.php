<link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

<!-- meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="view-transition" content="same-origin">
<meta name="theme-color" content="">
<meta property="og:site_name" content="Hawaa">
<meta property="og:url" content="https://themeforest.net/user/spreethemes/portfolio">
<meta property="og:title" content="Creative Travelling Template">
<meta property="og:description"
    content="A versatile template designed for travel agencies, tour operators, and adventure websites.">
<meta name="description"
    content="Hawaa is a creative travelling template designed for travel agencies, tour operators, and adventure websites.">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Satisfy&display=swap"
    rel="stylesheet">

<!-- all css -->
<link rel="stylesheet" href="{{ asset('assets/css/vendor.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .user-dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-toggle {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 8px 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        color: #374151;
        transition: background 0.2s, box-shadow 0.2s;
    }

    .dropdown-toggle:hover {
        background: #f9fafb;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .icon-20 {
        width: 20px;
        height: 20px;
    }

    .icon-14 {
        width: 14px;
        height: 14px;
    }

    .dropdown-menu {
        position: absolute;
        top: 110%;
        right: 0;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        min-width: 160px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 1000;
    }

    .user-dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        width: 100%;
        padding: 10px 16px;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        color: #374151;
        font-size: 14px;
        transition: background 0.2s;
    }

    .dropdown-item:hover {
        background: #f3f4f6;
    }

    .btn-login {
        display: flex;
        align-items: center;
        gap: 8px;
        color: inherit;
        text-decoration: none;
    }

    .floating-whatsapp {
        position: fixed;
        bottom: 30px;
        right: 30px;
        display: flex;
        align-items: center;
        text-decoration: none;
        z-index: 9999;
        transition: all 0.3s ease;
    }

    .whatsapp-icon {
        width: 60px;
        height: 60px;
        background-color: #25D366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 35px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 2;
    }

    /* Efek Animasi Berdenyut */
    .whatsapp-icon::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #25D366;
        border-radius: 50%;
        z-index: -1;
        animation: pulse-wa 2s infinite;
    }

    @keyframes pulse-wa {
        0% {
            transform: scale(1);
            opacity: 0.7;
        }

        100% {
            transform: scale(1.6);
            opacity: 0;
        }
    }

    .whatsapp-text {
        background-color: white;
        color: #444;
        padding: 8px 15px 8px 30px;
        border-radius: 30px;
        margin-left: -20px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.3s ease;
        pointer-events: none;
    }

    /* Hover Effect */
    .floating-whatsapp:hover .whatsapp-text {
        opacity: 1;
        transform: translateX(0);
    }

    .floating-whatsapp:hover .whatsapp-icon {
        transform: scale(1.1);
        background-color: #128C7E;
    }

    /* Responsive Mobile */
    @media (max-width: 768px) {
        .whatsapp-text {
            display: none;
            /* Sembunyikan teks di HP agar tidak memenuhi layar */
        }

        .floating-whatsapp {
            bottom: 20px;
            right: 20px;
        }

        .whatsapp-icon {
            width: 50px;
            height: 50px;
            font-size: 30px;
        }
    }
</style>