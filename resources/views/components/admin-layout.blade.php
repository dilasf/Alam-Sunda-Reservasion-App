<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Di bagian head -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>
        AlsundReserv
    </title>
</head>

<body x-data="{
    page: 'ecommerce',
    loaded: true,
    darkMode: true,
    stickyMenu: false,
    sidebarToggle: false,
    scrollTop: false
}">

    {{-- x-init="darkMode = JSON.parse(localStorage.getItem('darkMode')) || true;
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode }"> --}}
    <!-- ===== Preloader Start ===== -->
    <include src="./partials/preloader.html"></include>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        @include('layouts.sidebar')
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            @include('layouts.header')
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                {{ $slot }}
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    @vite('resources/js/app.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#tanggal", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minDate: "today",
                defaultHour: 12,
                minuteIncrement: 30,
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                        longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                    },
                    months: {
                        shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt',
                            'Nov', 'Des'
                        ],
                        longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                            'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ]
                    }
                }
            });
        });

        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');

            return `${day}/${month}/${year} ${hours}:${minutes}`;
        }

        function showDetail(idReservasi) {
            fetch(`/admin/reservasi/${idReservasi}/detail`)
                .then(response => response.json())
                .then(data => {
                    const content = `
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <p class="font-semibold">Nama Lengkap</p>
                                    <p>${data.nama_depan} ${data.nama_belakang}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-semibold">Email</p>
                                    <p>${data.email}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-semibold">No Telepon</p>
                                    <p>${data.no_telepon}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-semibold">Meja</p>
                                    <p>${data.meja ? data.meja.nama : 'Tidak tersedia'} (${data.meja.jumlahPengunjung} Orang)</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-semibold">Tanggal</p>
                                    <p>${data.formatted_tanggal}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-semibold">Jumlah Pengunjung</p>
                                    <p>${data.jumlahPengunjung} orang</p>
                                </div>
                                <div class="space-y-2 col-span-2">
                                    <p class="font-semibold">Status</p>
                                    <p>${data.status.charAt(0).toUpperCase() + data.status.slice(1)}</p>
                                </div>
                            </div>
                        `;
                    document.getElementById('detailContent').innerHTML = content;
                    document.getElementById('detailModal').classList.remove('hidden');
                    document.getElementById('detailModal').classList.add('flex');
                });
        }

        function closeModalReservasi() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        function showBukti(url) {
            const buktiImage = document.getElementById('buktiImage');
            if (buktiImage) {
                buktiImage.src = url;
            }
            document.getElementById('buktiModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('buktiModal').classList.add('hidden');
        }
    </script>
</body>

</html>
