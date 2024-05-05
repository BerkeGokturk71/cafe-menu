<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEK Cafe Menü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Mobil uyumlu CSS -->
    <link rel="stylesheet" href="assets/css/product.css">
    

</head>

<body>
    <?php include "functions.php"?>
    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="menu.php">Anasayfa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      
    </div>
  </div>
</nav>
    
    <main>
        <section id="giris">
            <h1 ><?php echo $_GET["kategori"]?></h1>
            <p>aile ve arkadaşlarınızla zaman geçirebileceğiniz harika bir dünya!</p>
            <div class="container product-container">
                <div class="row mb-0">
                    <?php foreach(readData()['categories'] as $data): ?>
                        <?php if($_GET["kategori"]==$data["name"]):?>
                            <?php foreach($data["items"] as $items):?>
                                
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <img style="padding: 8%;border-radius:20px; "  src="<?php echo $items['image']?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text"><?php echo $items['name']?></p>
                                <p class="price"><?php echo '$' . rand(10, 100)?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php endif;?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="sosyal">
                <a href="#" aria-label="mikaileneskaya Instagram" target="_blank">
                    <i class="fa-brands fa-instagram"></i> Coffe </a>
                <p>Hikayelerinizde bizden bahsetmeyi unutmayın 😋</p>
            </div>
        </section>
        <i class="scroll-to-top fa-solid fa-angle-up" onclick="scrollToTop()"></i>

        <section id="ogeler">

        </section>

       <?php include "partials/_footer.php"?>
    </main>
    <script src="menu.js"></script>
    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
