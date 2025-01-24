<x-client.app>
    <x-slot name="title">
        Menus
    </x-slot>
    <x-slot name="content">
        <div class="row mt-3 p-0">
            <div class="col-8 p-0 mb-3 bg-white">
                <div class="col-12  mb-1 p-2 rounded shadow justify-content-start" style="background-color: white;">
                    <h4 class="text_primary text-center">Your selected product in part</h4>
                </div>
                <div class=" row p-0" id="cart-data">

                </div>
            </div>
            <div class="col-4 p-0">
                <div class="card shadow ms-2">
                    <div class="card-header">
                        <h4 class="card-title text-center 
                        ">Cart List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripe" id="cart-table">
                            <thead>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                        <div class="row px-2"> 
                            <button class="btn btn-primary" onclick="checkout()">Order Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">

        <script type="text/javascript">
            // localStorage.setItem("productsInCard", "");
            //Deleting Product from cart
            function deleteProductFromCart($productId) {
                let products = getProductsInCart();
                products = products.filter(function(product) {
                    return product.id != $productId;
                })
                products = products.length > 0 ? JSON.stringify(products) : "";

                localStorage.setItem("productsInCard", products);
                alert("Succesully Remove product")
                window.location.href = "";
            }

            //Global Variable
            var total_amount = 0;
            fetchCartData()


            function checkout() {
                let products = getProductsInCart();
                products = products = products.map((product) => {
                    return {
                        product_id: product.id,
                        quantity: product.quantity,
                        price: product.price
                    };
                });
                console.log(HOST_URL + "order/create?user_id=" + user_id + "&&products=" + encodeURIComponent(JSON.stringify(products)))
                var request = $.ajax({
                    url: HOST_URL + "order/create?user_id=" + user_id + "&&products=" + encodeURIComponent(JSON.stringify(products)),
                    method: "get",
                });

                request.done(function(data) {
                    localStorage.setItem("productsInCard", "");
                    // localStorage.setItem("cart_count", "");
                    window.location.href = data.url;
                });

                request.fail(function(jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }

            function fetchCartData() {
                let products = getProductsInCart();
                const productsId = products.map((product) => product.id);
                // const productsId = [1, 2, 3, 4];
                var request = $.ajax({
                    url: HOST_URL + "get-products/?products=" + encodeURIComponent(JSON.stringify(productsId)),
                    method: "get",
                });
                request.done(function({
                    products
                }) {

                    var storageProducts = getProductsInCart();

                    products = products.map(function(product) {
                        let foundProduct = storageProducts.find((item) => item.id == product.id);
                        return {
                            quantity: foundProduct.quantity ? foundProduct.quantity : 1,
                            ...product
                        }
                    });


                    localStorage.setItem("productsInCard", JSON.stringify(products));
                    addProductToUICart(products);
                    calculateCartProduct(products);
                });

                request.fail(function(jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
            let product = {
                id: 1,
                name: "haha",
                image: "bla",
                price: 2000,
                desc: "blallslsllsl"
            };

            function calculateCartProduct(products) {
                products.forEach((product) => {
                    var newRow = ` <tr> 
                        <td>${product.name} </td>
                        <td><input type="number" class="quantity${product.id}" style="width:50px" value="${product.quantity}" disabled/>    </td>
                        <td align="right"> ${product.price}  </td>
                        <td align="right"> <span class="total_price" id="total_price${product.id}">${(product.price * product.quantity)}</span>  kyats </td>
                        </tr>
                        `;
                    $('#cart-table tbody').append(newRow);
                    total_amount += (product.price * product.quantity);
                })
                let tFoot = `
                        <tr>
                        <td colspan="3">Total Amount : </td>
                        <td><span id="total_amount">${total_amount}</span> Kyats</td>
                        </tr>
                    `;
                $('#cart-table tfoot').append(tFoot);

            }

            function addProductToUICart(products) {
                //clear cartData
                $("#cart-data").html("");
                products.forEach((product) => {
                    let productUi = `
                                <div class="col-12 col-md-4 mb-3 m-0">
                                    <div class="card shadow p-1">

                                    <img src="${product.image}" class="card-img-top rounded card_image" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title fs-6 mt-3">${product.name}</h5>
                                                <p class="card-text fs-6">Price - ${product.price} Kyats</p>
                                                <p class="card-text mb-5 fs-6">${product.desc}</p>
                                                <div class="position-absolute w-100 px-2 " style="bottom: 20px;left: 0px; z-index:2;">
                                                    <div class="d-flex justify-content-between">
                                                        <input type="number" min="0"  value="${product.quantity}" class="form-control quantity quantity${product.id}"style="width:40%;"
                                                        productid="${product.id}"
                                                        id="quantity${product.id}"
                                                        price="${product.price}"
                                                        >
                                                        <button class="btn btn-outline-primary btn" onclick="decreaseQty(${product.id},${product.price})">
                                                            <i class="fa fa-minus">
                                                            </i>
                                                        <button class="btn btn-outline-primary btn" onclick="increaseQty(${product.id},${product.price})">
                                                            <i class="fa fa-plus">
                                                            </i>
                                                        </button>
                                                        <button class="btn btn-outline-danger btn" onclick="deleteProductFromCart(${product.id})">
                                                            <i class="fa fa-trash">
                                                            </i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                    `;

                    $("#cart-data").append(productUi);

                });

                $(".quantity").each(function() {
                    $(this).on("keyup change", function() {
                        let productId = $(this).attr("productid");
                        let price = parseInt($(this).attr("price"));
                        let qty = $(this).val();
                        $(".quantity" + productId).each(function(item) {
                            $(this).val(qty);
                        });
                        $("#total_price" + productId).html(price * qty);
                        total_amount = 0;
                        $(".total_price").each(function() {
                            let total_price = parseInt($(this).html());
                            total_amount += total_price;
                        });

                        $("#total_amount").html("$" + total_amount);

                        updateProductInCart({
                            id: productId,
                            quantity: qty
                        });

                    });
                });
            }



            function increaseQty(id, price) {
                price = parseInt(price);
                let qty = parseInt($("#quantity" + id).val());
                ++qty;
                $(".quantity" + id).each(function(item) {
                    $(this).val(qty);
                });
                $("#total_price" + id).html(price * qty);

                total_amount = 0;
                $(".total_price").each(function() {
                    let total_price = parseInt($(this).html());
                    total_amount += total_price;
                });
                $("#total_amount").html(total_amount);

                updateProductInCart({
                    id: id,
                    quantity: qty
                });
            }

            function decreaseQty(id, price) {
                let qty = parseInt($("#quantity" + id).val());
                if (qty != 0)
                    --qty;
                $(".quantity" + id).each(function(item) {
                    $(this).val(qty);
                });
                $("#total_price" + id).html(price * qty);
                let total_amount = 0;
                $(".total_price").each(function() {
                    let total_price = parseInt($(this).html());
                    total_amount += total_price;
                });
                $("#total_amount").html("$" + total_amount);

                updateProductInCart({
                    id: id,
                    quantity: qty,
                });
            }
        </script>

    </x-slot>
</x-client.app>