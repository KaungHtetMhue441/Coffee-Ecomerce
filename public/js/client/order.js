const HOST_URL = "http://localhost:8000/";
const productsInCard = [
    {
        id: null,
        quantity: 1
    }
];


function addCartCount() {
    products = localStorage.getItem("productsInCard");
    if (!!products) {
        products = JSON.parse(products)
        $("#cart_count").html(products.length);

    } else {
        $("#cart_count").html(0);
    }

}
addCartCount()
// localStorage.setItem("productsInCard", "");
// [1, 2, 3, 4].forEach((item) => {
//     setProductToCart({ id: item, quantity: 1 });
// })


function getProductsInCart() {
    let products = localStorage.getItem("productsInCard");
    if (!!products) {
        return JSON.parse(localStorage.getItem("productsInCard"));
    }
    return [];
}

function setProductToCart(product) {

    let products = getProductsInCart();
    let found = products.find((item) => {
        return item.id == product.id
    });
    if (!!found) {
        alert("Product alerady added");
        return;
    }
    products.push(product);

    localStorage.setItem("productsInCard", JSON.stringify(products));
    addCartCount();
    alert("Product successfully added!");
}

function updateProductInCart(product) {
    let products = getProductsInCart();
    products = products.map((item) => {
        return product.id == item.id ? { ...item, ...product } : item;
    })
    console.log(products);
    localStorage.setItem("productsInCard", JSON.stringify(products));
}
function getUserId() {
    return window.user_id;
}

function addToCard(productId) {
    if (!user_id) {
        alert("Please login First");
        window.location.href = "login";
        return;
    }
    const product = { id: productId, quantity: 1 };
    setProductToCart(product)
}

function updateToCardMenu() {
}