<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- boostrap icon --}}
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


 
    <!-- Vendor CSS Files -->
  
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  
    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
  

</head>
<body class="body">
  <div style="background-color: #fff">
    <main id="main" class="main">
      <section class="">
        <div class="row no-gutters">
            <!-- images -->
          <div class="col-lg-6 col-sm-6">
            <img src="/images/logo1.svg"  alt="">
          </div>
            <!-- end.images -->

            <!-- form.login -->
              <div class="col-lg-6 col-sm-6 align-content-center align-items-center h-100 block my-auto">

                <div class="login">
                  <div class="row">
                    <div class="fs-2 fw-bold">Reset Password</div>
                    <div class="fw-lighter text-muted mb-4">Silahkan klik link dibawah ini untuk resset password.</div>
                    <div class="form-sigin">
                        <div class="d-grid gap-2">
                            <a href="{{ route('password.reset', $token) }}">LINK RESSET PASSWORD</a>
                          </div>
                        
                        <div>
                            <img src="/images/logo.svg" alt="">
                            <p>Butuh Bantuan? Hubungi kami di:</p>
                            <p>email: developerintek2022@gmail.com</p>
                        </div>
                    </div>

                  </div>
                 
                </div>
              </div>
            <!-- end.form.login -->
  
        </div>
      </section>
    
    </main><!-- End #main -->
  </div>

  

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/assets/vendor/quill/quill.min.js"></script>
  <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>