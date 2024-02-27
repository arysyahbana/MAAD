<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>

{{-- Axios CDN --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- end Axios CDN --}}

<script src="{{ asset('dist_frontend/js/iziToast.min.js') }}"></script>

{{-- download button --}}
<script>
    $(document).ready(function() {
        $('.download-btn').click(function(e) {
            e.preventDefault(); // membatalkan tindakan default tombol download

            // URL untuk mendownload file
            var file_url = $(this).attr('href');

            // membuat elemen link untuk proses download
            var link = document.createElement("a");
            link.href = file_url;
            link.download = true;

            // mengklik elemen link untuk memulai proses download
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // menampilkan modal setelah proses download selesai
            $('#exampleModal').modal('show');
        });
    });
</script>
{{-- end download button --}}

{{-- copy --}}
<script>
    function copyText() {
        var copyText = document.getElementById("salin");
        copyText.select();
        document.execCommand("copy");
        $('#exampleModal').modal('hide');
        $('#modalCopy').modal('show');
        // alert("Teks berhasil dicopy");
    }
</script>
{{-- end copy --}}
