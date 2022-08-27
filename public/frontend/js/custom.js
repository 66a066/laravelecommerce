$(document).ready(function() {

    loadcart();
    loadwishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadcart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function(response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    function loadwishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-data",
            success: function(response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.wishlist);
            }
        });
    }

    $('.addToCartBtn').click(function(e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var product_quantity = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_quantity,
            },
            success: function(response) {
                swal(response.status);
                loadcart();
            }
        });
    });

    $('.addToWishlist').click(function(e) {
        e.preventDefault();
        var p_id = $(this).closest('.product_data').find('.product_id').val();

        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id': p_id,
            },
            success: function(response) {
                swal(response.status);
                loadwishlist();
            }
        });
    });

    //$('.increament-btn').click(function(e) {
    $(document).on('click', '.increament-btn', function(e) {
        e.preventDefault();
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    //$('.decreament-btn').click(function(e) {
    $(document).on('click', '.decreament-btn', function(e) {
        e.preventDefault();
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    //$('.changeQunatity').click(function(e) {
    $(document).on('click', '.changeQunatity', function(e) {
        e.preventDefault();
        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var prod_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: "POST",
            url: "/update-cart",
            data: {
                'prod_id': prod_id,
                'prod_qty': prod_qty,
            },
            success: function(response) {
                //window.location.reload();
                $('.cartitems').load(location.href + " .cartitems");
            }
        });
    });

    //$('.delete-cart-item').click(function(e) {
    $(document).on('click', '.delete-cart-item', function(e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            method: "POST",
            url: "/delete-cart-item",
            data: {
                'prod_id': prod_id,
            },
            success: function(response) {
                //window.location.reload();
                loadcart();
                $('.cartitems').load(location.href + " .cartitems");
                swal("", response.status, "success");
            }
        });
    });

    //$('.delete-wishlist-item').click(function(e) {
    $(document).on('click', '.delete-wishlist-item', function(e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.product_id').val();

        $.ajax({
            method: "POST",
            url: "/delete-wishlist-item",
            data: {
                'prod_id': prod_id,
            },
            success: function(response) {
                //window.location.reload();
                loadwishlist();
                $('.wishitems').load(location.href + " .wishitems");
                swal("", response.status, "success");
            }
        });

    });
});