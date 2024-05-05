
<?php include "functions.php"?>

<?php require_once "partials/_header.php"?>
<?php include "partials/_navbar.php"?>


<?php 
    // Gerekli dosyaların çağrılması
    require_once("functions.php");
    
    // Eğer form gönderildiyse işlemleri gerçekleştirelim
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        // Silinecek ürünün adını alalım
        $silinecekUrun = $_POST['delete'];

        // JSON dosyasını okuyup içeriğini bir değişkene aktaralım
        $jsonDosya = file_get_contents("menu.json");

        // JSON içeriğini PHP dizisine dönüştürelim
        $veriler = json_decode($jsonDosya, true);

        // Kategorileri kontrol edelim ve ilgili ürünü kaldıralım
        foreach ($veriler['categories'] as &$category) {
            foreach ($category['items'] as $key => $item) {
                if ($item['name'] == $silinecekUrun) {
                    // Ürünü listeden çıkaralım
                    unset($category['items'][$key]);
                    break; // Döngüyü sonlandıralım, çünkü ürün bulundu ve işlem tamamlandı
                }
            }
        }

        // JSON içeriğini güncelleyelim
        $guncelVeri = json_encode($veriler, JSON_PRETTY_PRINT);
        file_put_contents("menu.json", $guncelVeri);

        // Veri silindikten sonra kullanıcıyı başka bir sayfaya yönlendirebilirsiniz
        header("Location: admin.php");
    }
?>



<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <div class="border p-2 mb-1 d-flex align-items-start">
                <a href="course-create.php" class="btn btn-primary mr-1">Ürün Ekle</a>
                <span style="margin-right: 1%;"></span> 
                <a href="category-create.php" class="btn btn-primary">Kategori Ekle</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:50px;">Id</th>
                        <th style="width:120px;">Resim</th>
                        <th>Başlık</th>
                        <th style="width:50px;">Kategori</th>
                        <th style="width:50px;">Onay</th>
                        <th style="width:130px;"></th>
                    </tr>
                </thead>    
                <tbody>
                    <?php foreach (readData()['categories'] as $category): ?>
                        <?php foreach ($category['items'] as $item): ?>
                            <tr>
                                <td></td>
                                <td><img class="img-fluid" src="<?php echo $category['image']; ?>" alt=""></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $category['name']; ?></td>
                                <td>
                                    <i class="fas fa-check"></i>
                                    <i class="fas fa-times"></i>
                                </td>
                                <td>
                                <a href="course-edit.php?id=<?php echo $item["name"]?>" class="btn btn-primary btn-sm">Edit</a>                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: inline;">
                                        <input type="hidden" name="delete" value="<?php echo $item['name']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>  
        </div>
    </div>
</div>

