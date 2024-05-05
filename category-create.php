<?php include "partials/_header.php"?>
<?php include "partials/_navbar.php"?>


<?php 
    // Gerekli dosyaların çağrılması
    require_once("functions.php");
    
    // Eğer form gönderildiyse işlemleri gerçekleştirelim
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen verileri alalım
        $kategori = $_POST['baslik']; // Kategori adını alıyoruz
        $resim = $_FILES["imageFile"]["name"]; // Yüklenen resmin adını alıyoruz

        // Yeni kategori oluşturalım
        $yeniKategori = array(
            "name" => $kategori,
            "image" => "images/".$resim,
            "items" => array()
        );

        // JSON dosyasını okuyup içeriğini bir değişkene aktaralım
        $jsonDosya = file_get_contents("menu.json");

        // JSON içeriğini PHP dizisine dönüştürelim
        $veriler = json_decode($jsonDosya, true);

        // Yeni kategoriyi mevcut kategoriler listesine ekleyelim
        $veriler['categories'][] = $yeniKategori;

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
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="baslik">Kategori Adı</label>
                        <input type="text" name="baslik" class="form-control" value="<?php echo isset($_POST['baslik']) ? $_POST['baslik'] : ''; ?>">
                        <!-- Kategori adı alanı -->
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="imageFile" id="imageFile" class="form-control">
                        <label for="imageFile" class="input-group-text">Yükle</label>
                        <!-- Resim yükleme alanı -->
                    </div>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>
