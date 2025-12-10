<!-- Modal and Drawer Overlay -->
<drawer-opener id="drawer-overlay"></drawer-opener>

<!-- Scroll to Top Button -->
<scroll-top>
    <div class="scroll-to-top">
        <div class="svg-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                <rect width="256" height="256" fill="none" />
                <path
                    d="M152,96l80,40v32l-80-16v32l16,16v32l-40-16L88,232V200l16-16V152L24,168V136l80-40V48a24,24,0,0,1,48,0Z"
                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="16" />
            </svg>
        </div>
    </div>
</scroll-top>

<!-- all js -->
<script src="assets/js/vendor.js" defer></script>
<script src="assets/js/main.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            const dropdownMenu = toggle.nextElementSibling;

            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                // Tutup semua dropdown lain
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.style.display = 'none';
                    }
                });
                // Toggle dropdown ini
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function () {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        });

        // Mencegah dropdown tertutup saat klik di dalam dropdown
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
    });
</script>