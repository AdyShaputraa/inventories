<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        var pages = [
            'Dashboard', 'Barang', 'Kerusakan', 'Tambah Kerusakan', 'User', 'User Profile'
        ];
        var url = '{{ url(""); }}';
        $('.menu-search-input-autocomplete').autocomplete({
            source: pages,
            select: function (event, ui) {
                if (ui.item.label == 'Dashboard') {
                    window.location = url + '/dashboard';
                } else if (ui.item.label == 'Barang') {
                    window.location = url + '/barang';
                } else if (ui.item.label == 'Kerusakan') {
                    window.location = url + '/kerusakan';
                } else if (ui.item.label == 'Tambah Kerusakan') {
                    window.location = url + '/kerusakan/create';
                } else if (ui.item.label == 'User') {
                    window.location = url + '/user';
                } else if (ui.item.label == 'User Profile') {
                    window.location = url + '/user/profile';
                }
            }
        });
    });
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>