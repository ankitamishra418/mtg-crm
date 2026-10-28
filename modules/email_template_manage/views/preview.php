<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Email Template Manage</title>
</head>
<body>

<?php
$image_path = "http://localhost/perfex_crm/modules/email_template_manage/images/";
?>

<div class="container mt-5">
    <h1>Email Template Manage</h1>
    <div class="d-flex align-items-center mb-4 text-muted author-info">
        <a class="d-flex align-items-center text-muted text-decoration-none" href="https://codecanyon.net/user/halilaltndg" target="_blank" rel="noopener">
            By <span>@halilaltndg</span>
        </a>
        <span class="d-flex align-items-center ms-3" title="14 Sep 23 14:30 UTC">

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="me-2" viewBox="0 0 16 16" role="img" fill="currentColor">
              <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"></path>
              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
            </svg>

            1 February 2024
        </span>
    </div>

    <div class="alert alert-primary" role="alert">
        Bu modül müşterileriniz ve potansiyel müşterileriniz ile iletişiminizi güçlendirmek için geliştirildi.
    </div>


    <p>Öncelikle modülü aktif hale getirin.</p>

    <p>
        <img src="<?php echo $image_path?>email-template-modul-active.jpg" class="d-block img-fluid mb-2 rounded border" alt="New homepage" loading="lazy">
    </p>

    <p> E-posta şablonları oluşturarak aynı e-postayı tekrar tekrar yazma derdinden kurtulun.</p>

    <p>
        <img src="<?php echo $image_path?>add_template.jpg" class="d-block img-fluid mb-2 rounded border" alt="New homepage" loading="lazy">
    </p>

    <p> Şablon oluştururken "Available merge fields" alanından sisteme kayıtlı verileri kullanabilirsiniz. </p>
    <p> Örneğin {client_phonenumber} alanını seçtiğinizde müşterinin telefon numarası eklenecektir. </p>

    <p>
        <img src="<?php echo admin_url("email_template_manage/images/available.jpg")?>" class="d-block img-fluid mb-2 rounded border" alt="New homepage" loading="lazy">
    </p>

    <p>Oluşturduğunuz şablona "Attach File" ile belge yükleyebilirsiniz.</p>

    <p>
        <img src="<?php echo admin_url("email_template_manage/images/attach_file.jpg")?>" class="d-block img-fluid mb-2 rounded border" alt="New homepage" loading="lazy">
    </p>

    <p>Şablonunuzu küçük değişikliklerle yeniden oluşturmak istediğinizde "Duplicate" butonunu kullanabilir ve kolaylıkla yeni şablon oluşturabilirsiniz. </p>

    <p>Böylece benzer bir mail oluşturmak için vakit harcamazsınız.</p>

    <p>
        <img src="<?php echo admin_url("email_template_manage/images/attach_file.jpg")?>" class="d-block img-fluid mb-2 rounded border" alt="New homepage" loading="lazy">
    </p>

    <p>Bu şablonları müşterilerinize ve potansiyel müşterilerinize istediğiniz zaman gönderebilirsiniz.</p>

    <p>İleri tarihli e-posta tanımlayabilirsiniz.</p>

    <p>Müşteri grubu seçebilir ve bu grupta mail göndermek istemediğiniz müşterileri de seçebilirsiniz.</p>

    <p>Bu sayede müşterilerinizle iletişiminizi güçlü tutarsınız.</p>

    <p>
        <img src="<?php echo admin_url("email_template_manage/images/email_timer.jpg")?>" class="d-block img-fluid mb-2 rounded border" alt="New homepage" loading="lazy">
    </p>





</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
