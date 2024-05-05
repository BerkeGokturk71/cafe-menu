<?php include "partials/_header.php"; ?>
<?php include "partials/_navbar.php"?>

<?php
    // Gerekli dosyaların çağrılması
    require_once("functions.php");

    // Edit sayfasına yönlendirme yapıldığında ID'yi alalım
    $id = $_GET["id"];

    // JSON dosyasını okuyup içeriğini bir değişkene aktaralım
    $jsonDosya = file_get_contents("menu.json");

    // JSON içeriğini PHP dizisine dönüştürelim
    $veriler = json_decode($jsonDosya, true);

    // Düzenleme işlemi için ilgili ürünün bilgilerini alalım
    $selectedItem = null;
    foreach ($veriler['categories'] as $category) {
        foreach ($category['items'] as $item) {
            if ($item['name'] == $id) {
                $selectedItem = $item;
                break 2; // İç içe döngüden çık
            }
        }
    }

    // Eğer form gönderildiyse işlemleri gerçekleştirelim
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen verileri alalım
        $baslik = $_POST['baslik'];
        $altBaslik = $_POST['altBaslik'];
        $resim = $_FILES["imageFile"]["name"];

        // Resim dosyasını yükleme işlemini burada gerçekleştirebilirsiniz
        uploadImage($_FILES["imageFile"]);

        // Seçilen kategori ve ürünün bilgilerini güncelleyelim
        foreach ($veriler['categories'] as &$category) {
            foreach ($category['items'] as &$item) {
                if ($item['name'] == $id) {
                    $item['name'] = $baslik;
                    $item['image'] = "images/" . $resim;
                    break 2; // İç içe döngüden çık
                }
            }
        }

        // JSON içeriğini güncelleyelim
        $guncelVeri = json_encode($veriler, JSON_PRETTY_PRINT);
        file_put_contents("menu.json", $guncelVeri);

        // Veri güncellendikten sonra kullanıcıyı başka bir sayfaya yönlendirebilirsiniz
        header("Location: admin.php");
    }
?>

<?php include "partials/_header.php"; ?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="baslik">Başlık</label>
                        <input type="text" name="baslik" class="form-control" value="<?php echo $selectedItem['name']; ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="imageFile" id="imageFile" class="form-control">
                        <label for="imageFile" class="input-group-text">Yükle</label>
                    </div>
                    <img src="<?php echo $selectedItem['image']; ?>" style="width: 150px;" alt="">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

