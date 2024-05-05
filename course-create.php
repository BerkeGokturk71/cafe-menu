<?php include "partials/_header.php"?>

<?php include "partials/_navbar.php"?>
<?php 
      
    $baslikErr = $baslik = "";
    $altBaslikErr = $altBaslik = "";
    $resimErr = $resim = "";     
?>

<?php 
    // Gerekli dosyaların çağrılması
    require_once("functions.php");
    
    // JSON dosyasını okuyup içeriğini bir değişkene aktaralım
    $jsonDosya = file_get_contents("menu.json");

    // JSON içeriğini PHP dizisine dönüştürelim
    $veriler = json_decode($jsonDosya, true);

    // Eğer form gönderildiyse işlemleri gerçekleştirelim
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen verileri alalım
        $baslik = $_POST['baslik'];
        $kategori = $_POST['category'];
        uploadImage($_FILES["imageFile"]);
        $resim = $_FILES["imageFile"]["name"];
        // Resim dosyasını yükleme işlemini burada gerçekleştirebilirsiniz
        
        // Yeni veriyi oluşturalım
        $yeniVeri = array(
            "name" => $baslik,
            "image" => "images/".$resim, // Örnek bir resim yolu, bu kısmı resim dosyasını yükleme işlemine göre değiştirebilirsiniz
            "price" => 0 // Fiyat gibi başka bir bilgi varsa buraya ekleyebilirsiniz
        );

        // Kategoriyi bulalım
        foreach ($veriler['categories'] as &$category) {
            if ($category['name'] == $kategori) {
                // Kategorinin altındaki veriler dizisine yeni veriyi ekleyelim
                $category['items'][] = $yeniVeri;
                break; // Döngüyü sonlandıralım, çünkü kategori bulundu ve işlem tamamlandı
            }
        }

        // JSON içeriğini güncelleyelim
        $guncelVeri = json_encode($veriler, JSON_PRETTY_PRINT);
        file_put_contents("menu.json", $guncelVeri);

        // Veri eklendikten sonra kullanıcıyı başka bir sayfaya yönlendirebilirsiniz
        header("Location: admin.php");
    }
?>


    <div class="container my-3">

        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                <form  method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="category">Başlık</label>
                        <input type="text" name="baslik" class="form-control" value="<?php echo $baslik;?>">
                        <div class="text-danger"><?php echo $baslikErr;?></div>
                    </div>
                   
                    <div class="input-group mb-3">
                        <input type="file" name="imageFile" id="imageFile" class="form-control">
                        <label for="imageFile" class="input-group-text">Yükle</label>
                    </div>
                    <div class="text-danger"><?php echo $resimErr;?></div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select name="category" id="category" class="form-select">
                        <option value="0" selected>Seçiniz</option>
                            <?php foreach (readData()["categories"] as $kategori): ?>
                                <option value="<?php echo $kategori['name'];?>"><?php echo $kategori['name'];?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

