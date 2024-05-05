const menuContainer = document.getElementById('ogeler');
let categoryID = 1;

/*
fetch('menu.json')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        data.categories.forEach(function (category) {
            const categoryTitle = document.createElement('h2');
            categoryTitle.textContent = category.name;
            categoryTitle.id = 'kategori-' + categoryID;
            menuContainer.appendChild(categoryTitle);

            category.items.forEach(function (item) {
                const menuItem = document.createElement('div');
                menuItem.className = 'menu-item';

                const name = document.createElement('p');
                name.className = 'menu-item-name';
                name.textContent = item.name;

                const price = document.createElement('p');
                price.className = 'menu-item-price';
                price.textContent = 'Fiyat: ₺' + item.price;

                menuItem.appendChild(name);
                menuItem.appendChild(price);

                menuContainer.appendChild(menuItem);
            });

            categoryID++;
        });
    })
    .catch(function (error) {
        console.log('Veri alınamadı:', error);
    });
*/    

const SCROLL_THRESHOLD = 400;
const scrollToTopButton = document.querySelector(".scroll-to-top");
window.addEventListener("scroll", () => {
    if (window.scrollY > SCROLL_THRESHOLD) {
        scrollToTopButton.style.position = "fixed";
        scrollToTopButton.style.display = "flex";
    } else {
        scrollToTopButton.style.display = "none";
    }
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}
