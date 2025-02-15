<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<title>SIPANDU | Register Masyarakat</title>
<!-- Custom CSS -->
<style>
    /* Styling untuk menempatkan form register di tengah dan sedikit geser ke kanan */
    .login-container {
        display: flex;
        justify-content: center;
        /* Menyelaraskan form ke tengah */
        align-items: center;
        height: 110vh;
        /* Mengurangi tinggi container */
        padding-left: 23%;
        /* Menambah padding kiri untuk memindahkan form lebih ke kanan */
        padding-right: 10%;
        /* Padding kanan agar tidak terlalu lebar */
    }

    .card {
        width: 100%;
        max-width: 500px;
        /* Mengurangi lebar form */
        padding: 15px;
        /* Mengurangi padding untuk membuat form lebih padat */
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-size: 20px;
        /* Menurunkan ukuran font header */
        font-weight: bold;
        text-align: center;
    }

    .form-control {
        padding: 8px;
        /* Mengurangi padding input untuk memberi ruang lebih kecil */
        font-size: 14px;
        /* Menurunkan ukuran font pada input */
    }

    .btn {
        padding: 8px 16px;
        /* Mengurangi padding tombol */
        font-size: 12px;
        /* Menurunkan ukuran font pada tombol */
        width: 100%;
        border-radius: 20px;
        background-color: #28a745;
        /* Latar belakang hijau */
        color: #fff;
        text-align: center;
    }

    .btn:hover {
        background-color: #218838;
        /* Hijau gelap saat hover */
    }

    .input-group-text {
        background-color: #f1f1f1;
        padding: 8px;
        /* Menyesuaikan padding ikon dengan input */
        font-size: 14px;
        /* Menurunkan ukuran font ikon */
        display: flex;
        align-items: center;
        /* Vertically align icons */
    }

    .input-group {
        margin-bottom: 10px;
        /* Mengurangi jarak antar input grup */
    }

    .sign-up-text {
        text-align: center;
        margin-top: 10px;
        /* Menurunkan jarak antara tombol dan teks */
    }

    .sign-up-text a {
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
        /* Mengurangi ukuran font link */
    }

    .sign-up-text a:hover {
        text-decoration: underline;
    }

</style>

<!-- Konten Register -->
<div class="container login-container">
    <div class="row w-100">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Form Register</h4>
                </div>
                <div class="card-body">
                    <!-- Form Register -->
                    <form action="{{ route('masyarakat.register') }}" method="POST">
                        @csrf
                        <!-- Input NIK dengan ikon -->
                        <!-- Input NIK dengan ikon -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control" placeholder="NIK" name="textNik" required>
                        </div>

                        <!-- Input Nama dengan ikon -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="textNama" required>
                        </div>

                        <!-- Input Jenis Kelamin -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                            <select name="selectJenisKelamin" id="selectJenisKelamin" class="form form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <!-- Input Nomor Telepon dengan ikon -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                            <input type="text" class="form-control" placeholder="Nomor Telepon" name="textNomorTelepon" required>
                        </div>

                        <!-- Input Alamat dengan ikon -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" placeholder="Alamat" name="textAlamat" required>
                        </div>

                        <!-- Input Email dengan ikon -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" placeholder="Email" name="textEmail" required>
                        </div>

                        <!-- Input Password dengan ikon -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="textPassword" required>
                        </div>

                        <!-- Tombol Register -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-secondary btn-block">
                                    <i class="fa fa-user-plus"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Tautan Login -->
                    <div class="sign-up-text">
                        <p>Sudah punya akun? <a href="/loginmasyarakat">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
