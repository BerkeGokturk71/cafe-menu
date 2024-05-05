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
    <link rel="stylesheet" href="assets/css/menu.css">
</head>

<body>
    <?php include "functions.php"?>
   
    <main>
        <section id="giris">
            <h1>MEK Cafe Menü</h1>
            <p>aile ve arkadaşlarınızla zaman geçirebileceğiniz harika bir dünya!</p>
            
            <div class="image-container">
                <div class="row">
                    <?php 
                    $count = 0; 
                    foreach(readData()['categories'] as $data):                         
                        if ($count % 2 == 0 && $count > 0) {
                            echo '</div><div class="row">';
                        }
                    ?>
                    <div class="image-with-text">
                        <a href="#" aria-label="<?php echo $data['name'];?> kategorisi">
                            <img src="<?php echo $data['image']?>" alt="<?php echo $data['image']?>" >
                            <span class="image-text"><?php echo $data['name'];?></span>
                        </a>
                    </div>
                    <?php 
                    $count++; // Sayaç artır
                    endforeach; 
                    ?>
                </div>
            </div>
            <div class="sosyal">
                <a href="#" aria-label="Mek Cafe Instagram" target="_blank">
                    <i class="fa-brands fa-instagram"></i> Coffe </a>
                <p>Hikayelerinizde bizden bahsetmeyi unutmayın 😋</p>
            </div>
        </section>
        <i class="scroll-to-top fa-solid fa-angle-up" onclick="scrollToTop()"></i>

        <section id="ogeler">

        </section>

        <?php include "partials/_footer.php"?>
    </main>
    <script >
            document.addEventListener("DOMContentLoaded", function() {
            var kategoriLinkleri = document.querySelectorAll('.image-with-text a');
            kategoriLinkleri.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var kategoriAdi = this.querySelector('.image-text').innerText; 
                    window.location.href = 'product.php?kategori=' + encodeURIComponent(kategoriAdi); 
                });
            });
        });
    </script>
    <script src="menu.js"></script>
</body>

</html>
