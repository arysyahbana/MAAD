<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
{{-- dark mode --}}
<script>
    /*!
     * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
     * Copyright 2011-2023 The Bootstrap Authors
     * Licensed under the Creative Commons Attribution 3.0 Unported License.
     */

    (() => {
        'use strict'

        const getStoredTheme = () => localStorage.getItem('theme')
        const setStoredTheme = theme => localStorage.setItem('theme', theme)

        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
                return storedTheme
            }

            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = theme => {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        const showActiveTheme = (theme, focus = false) => {
            const themeSwitcher = document.querySelector('#bd-theme')

            if (!themeSwitcher) {
                return
            }

            const themeSwitcherText = document.querySelector('#bd-theme-text')
            const activeThemeIcon = document.querySelector('.theme-icon-active use')
            const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
            const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

            document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                element.classList.remove('active')
                element.setAttribute('aria-pressed', 'false')
            })

            btnToActive.classList.add('active')
            btnToActive.setAttribute('aria-pressed', 'true')
            activeThemeIcon.setAttribute('href', svgOfActiveBtn)
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
            themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

            if (focus) {
                themeSwitcher.focus()
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const storedTheme = getStoredTheme()
            if (storedTheme !== 'light' && storedTheme !== 'dark') {
                setTheme(getPreferredTheme())
            }
        })

        window.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme())

            document.querySelectorAll('[data-bs-theme-value]')
                .forEach(toggle => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value')
                        setStoredTheme(theme)
                        setTheme(theme)
                        showActiveTheme(theme, true)
                    })
                })
        })
    })()
</script>
{{-- end dark mode --}}


@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ $error }}',
            });
        </script>
    @endforeach

@endif
@if (session()->get('success'))
    <script>
        iziToast.success({
            title: '',
            position: 'topRight',
            message: '{{ session()->get('success') }}',
        });
    </script>
@endif

@if (session()->get('error'))
    <script>
        iziToast.error({
            title: '',
            position: 'topRight',
            message: '{{ session()->get('error') }}',
        });
    </script>
@endif

{{-- js aos --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
{{-- end js aos --}}

{{-- initialize aos --}}
<script>
    AOS.init();
</script>
{{-- end initialize aos --}}

{{-- pembayaran --}}
{{-- <script>
    var totalPajak;

    function subscribe() {
        const subscribe = document.getElementById('subscribe');
        const psubscribe = document.getElementById('psubscribe');
        const pajak = document.getElementById('pajak');
        const total = document.getElementById('total');
        var ppn = pajak.value;

        if (subscribe.value == 1) {
            psubscribe.value = "Rp. 1.200.000";
            pajak.value = 0.1 * 1200000;
            ppn = pajak.value;
            totalPajak = total.value = 1200000 + parseInt(ppn);
        } else if (subscribe.value == 2) {
            psubscribe.value = "Rp. 150.000";
            pajak.value = 0.1 * 150000;
            ppn = pajak.value;
            totalPajak = total.value = 150000 + parseInt(ppn);
        }
        // return totalPajak;
    }
</script> --}}
{{-- end pembayaran --}}

{{-- konfirmasi pembayaran --}}
{{-- <script>
    function test() {
        // Ambil referensi elemen select date
        // var date1 = document.getElementById('konfirmasi');
        var total = document.getElementById('total');
        var konfirmasi = document.getElementById('konfirmasi');
        if (total.value == '') {
            iziToast.error({
                // title: 'Error',
                message: 'Belum memilih Plan Subscribe',
                position: 'topRight'
            });

        } else {
            $('#bayar').modal('show');
        }

    }
</script> --}}
{{-- end konfirmasi pembayaran --}}

<script>
    function loginfail() {
        iziToast.error({
            // title: 'Notifikasi',
            message: 'Anda Belum Login',
            position: 'topRight',
            timeout: 5000, // Durasi tampilan alert dalam milidetik (ms)
            progressBar: true, // Menampilkan progress bar
            buttons: [
                ['<button class="rounded-pill">OK</button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast);
                }]
            ]
        });
    }
</script>

<script>
    function loginpending() {
        iziToast.error({
            // title: 'Notifikasi',
            message: 'Akun anda masih dalam status pending',
            position: 'topRight',
            timeout: 5000, // Durasi tampilan alert dalam milidetik (ms)
            progressBar: true, // Menampilkan progress bar
            buttons: [
                ['<button class="rounded-pill">OK</button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast);
                }]
            ]
        });
    }
</script>

{{-- radio --}}
{{-- <script>
    function getValue() {
        $('#bayar').modal('hide');
        $.ajax({
            url: "{{ route('noHp') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data == '') {
                    iziToast.error({
                        // title: 'Error',
                        message: 'anda belum mengisikan no HP',
                        position: 'topRight'
                    });
                } else {
                    var radioButton = $("input[name='pembayaran']:checked").val();
                    var virtual = document.getElementById('virtual');
                    var total2 = document.getElementById('total2');
                    $("#konBayar").modal("show");
                    virtual.value = radioButton + data;
                    total2.value = totalPajak;
                }

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // pesan kesalahan jika permintaan gagal
            }
        });

    }
</script> --}}
{{-- end radio --}}

{{-- tombol download video --}}
<script>
    var tombolLainnya = document.getElementsByClassName('tombol-lainnya');
    var tombolUtamaDitekan = false;

    function toggleTombolLainnya() {
        tombolUtamaDitekan = !tombolUtamaDitekan;

        if (tombolUtamaDitekan) {
            for (var i = 0; i < tombolLainnya.length; i++) {
                var delay = (i + 1) * 100; // Delay setiap tombol lain sebesar 100ms

                setTimeout(function(index) {
                    tombolLainnya[index].classList.add('muncul');
                }, delay, i);
            }
        } else {
            for (var i = 0; i < tombolLainnya.length; i++) {
                tombolLainnya[i].classList.remove('muncul');
            }
        }
    }
</script>
{{-- end tombol download video --}}

{{-- upload link --}}
<script>
    document.getElementById("button1").style.display = "none";
    document.getElementById("button1Container").style.display = "none";
    document.getElementById("button4").style.display = "none";
    document.getElementById("button4Container").style.display = "none";

    document.getElementById("button1").addEventListener("click", function() {
        document.getElementById("input1").style.display = "block";
        document.getElementById("input2").style.display = "none";
        document.getElementById("input3").style.display = "none";
        document.getElementById("input6").style.display = "block";
        document.getElementById("button1").style.display = "none";
        document.getElementById("button1Container").style.display = "none";
        document.getElementById("button2").style.display = "block";
        document.getElementById("button2Container").style.display = "flex";
        document.getElementById("button3").style.display = "block";
        document.getElementById("button3Container").style.display = "flex";
    });

    document.getElementById("button2").addEventListener("click", function() {
        document.getElementById("input1").style.display = "none";
        document.getElementById("input2").style.display = "block";
        document.getElementById("input3").style.display = "none";
        document.getElementById("input6").style.display = "none";
        document.getElementById("button1").style.display = "block";
        document.getElementById("button1Container").style.display = "flex";
        document.getElementById("button2").style.display = "none";
        document.getElementById("button2Container").style.display = "none";
        document.getElementById("button3").style.display = "block";
        document.getElementById("button3Container").style.display = "flex";
    });

    document.getElementById("button3").addEventListener("click", function() {
        document.getElementById("input1").style.display = "none";
        document.getElementById("input2").style.display = "none";
        document.getElementById("input3").style.display = "block";
        document.getElementById("input6").style.display = "block";
        document.getElementById("button1").style.display = "block";
        document.getElementById("button1Container").style.display = "flex";
        document.getElementById("button2").style.display = "block";
        document.getElementById("button2Container").style.display = "flex";
        document.getElementById("button3").style.display = "none";
        document.getElementById("button3Container").style.display = "none";
    });

    document.getElementById("button4").addEventListener("click", function() {
        document.getElementById("input4").style.display = "block";
        document.getElementById("input5").style.display = "none";
        document.getElementById("button4").style.display = "none";
        document.getElementById("button4Container").style.display = "none";
        document.getElementById("button5").style.display = "block";
        document.getElementById("button5Container").style.display = "flex";
    });

    document.getElementById("button5").addEventListener("click", function() {
        document.getElementById("input4").style.display = "none";
        document.getElementById("input5").style.display = "block";
        document.getElementById("button4").style.display = "block";
        document.getElementById("button4Container").style.display = "flex";
        document.getElementById("button5").style.display = "none";
        document.getElementById("button5Container").style.display = "none";
    });
</script>
{{-- end upload link --}}

{{-- loading btn --}}
<script>
    // Ketika form di-submit
    document.getElementById("uploadForm").addEventListener("submit", function(event) {
        // Menampilkan tombol dengan spinner
        document.getElementById("uploadingBtn").style.display = "block";
        document.getElementById("upBtn").style.display = "none";
    });
</script>
{{-- end loading btn --}}

{{-- button edit link --}}
<script>
    document.getElementById("buttonEdit1").style.display = "none";
    document.getElementById("buttonEdit1Container").style.display = "none";

    document.getElementById("buttonEdit1").addEventListener("click", function() {
        document.getElementById("inputEdit1").style.display = "block";
        document.getElementById("inputEdit2").style.display = "none";
        document.getElementById("buttonEdit1").style.display = "none";
        document.getElementById("buttonEdit1Container").style.display = "none";
        document.getElementById("buttonEdit2").style.display = "block";
        document.getElementById("buttonEdit2Container").style.display = "flex";
    });

    document.getElementById("buttonEdit2").addEventListener("click", function() {
        document.getElementById("inputEdit1").style.display = "none";
        document.getElementById("inputEdit2").style.display = "block";
        document.getElementById("buttonEdit1").style.display = "block";
        document.getElementById("buttonEdit1Container").style.display = "flex";
        document.getElementById("buttonEdit2").style.display = "none";
        document.getElementById("buttonEdit2Container").style.display = "none";
    });
</script>
{{-- end button edit link --}}
