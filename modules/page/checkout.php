<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Grocery Mart'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle'])?$data['pageTitle']:'Grocery Mart' ?></title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo _WEB_HOST_ASSETS?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo _WEB_HOST_ASSETS?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo _WEB_HOST_ASSETS?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="./assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ASSETS?>/fonts/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ASSETS?>/css/main.css">

    <!-- Script --> 
    <script src="<?php echo _WEB_HOST_ASSETS?>/js/scripts.js"></script>
</head>
    <body>
    <?php
        if(isLogin()):
            layouts('header-logined',$data);
            ?>
                <!-- MAIN -->
                <main class="checkout-page">
                    <div class="container">
                        <!-- Search bar -->
                        <div class="checkout-container">
                            <div class="search-bar d-none d-md-flex">
                                <input type="text" name="" id="" placeholder="Search for item" class="search-bar__input" />
                                <button class="search-bar__submit">
                                    <img src="./assets/icons/search.svg" alt="" class="search-bar__icon icon" />
                                </button>
                            </div>
                        </div>

                        <!-- Breadcrumbs -->
                        <div class="checkout-container">
                            <ul class="breadcrumbs checkout-page__breadcrumbs">
                                <li>
                                    <a href="./" class="breadcrumbs__link">
                                        Home
                                        <img src="./assets/icons/arrow-right.svg" alt="" />
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" class="breadcrumbs__link breadcrumbs__link--current">Checkout</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Checkout content -->
                        <div class="checkout-container">
                            <div class="row gy-xl-3">
                                <div class="col-8 col-xl-12">
                                    <div class="cart-info">
                                        <div class="cart-info__list">
                                            <!-- Cart item 1 -->
                                            <article class="cart-item">
                                                <a href="./product-detail.html">
                                                    <img
                                                        src="./assets/img/product/item-1.png"
                                                        alt=""
                                                        class="cart-item__thumb"
                                                    />
                                                </a>
                                                <div class="cart-item__content">
                                                    <div class="cart-item__content-left">
                                                        <h3 class="cart-item__title">
                                                            <a href="./product-detail.html">
                                                                Coffee Beans - Espresso Arabica and Robusta Beans
                                                            </a>
                                                        </h3>
                                                        <p class="cart-item__price-wrap">
                                                            $47.00 | <span class="cart-item__status">In Stock</span>
                                                        </p>
                                                        <div class="cart-item__ctrl cart-item__ctrl--md-block">
                                                            <div class="cart-item__input">
                                                                LavAzza
                                                                <img
                                                                    class="icon"
                                                                    src="./assets/icons/arrow-down-2.svg"
                                                                    alt=""
                                                                />
                                                            </div>
                                                            <div class="cart-item__input">
                                                                <button class="cart-item__input-btn" id="decrease-btn">
                                                                    <img class="icon" src="./assets/icons/minus.svg" alt="Decrease" />
                                                                </button>
                                                                <input type="number" class="cart-item__input-quantity" id="quantity-input" value="1" min="1">
                                                                <button class="cart-item__input-btn" id="increase-btn">
                                                                    <img class="icon" src="./assets/icons/plus.svg" alt="Increase" />
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-item__content-right">
                                                        <p class="cart-item__total-price">$47.00</p>
                                                        <div class="cart-item__ctrl">
                                                            <button class="cart-item__ctrl-btn">
                                                                <img src="./assets/icons/heart-2.svg" alt="" />
                                                                Save
                                                            </button>
                                                            <button
                                                                class="cart-item__ctrl-btn js-toggle"
                                                                toggle-target="#delete-confirm"
                                                            >
                                                                <img src="./assets/icons/trash.svg" alt="" />
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Cart item 2 -->
                                            <article class="cart-item">
                                                <a href="./product-detail.html">
                                                    <img
                                                        src="./assets/img/product/item-2.png"
                                                        alt=""
                                                        class="cart-item__thumb"
                                                    />
                                                </a>
                                                <div class="cart-item__content">
                                                    <div class="cart-item__content-left">
                                                        <h3 class="cart-item__title">
                                                            <a href="./product-detail.html">
                                                                Lavazza Coffee Blends - Try the Italian Espresso
                                                            </a>
                                                        </h3>
                                                        <p class="cart-item__price-wrap">
                                                            $53.00 | <span class="cart-item__status">In Stock</span>
                                                        </p>
                                                        <div class="cart-item__ctrl cart-item__ctrl--md-block">
                                                            <div class="cart-item__input">
                                                                LavAzza
                                                                <img
                                                                    class="icon"
                                                                    src="./assets/icons/arrow-down-2.svg"
                                                                    alt=""
                                                                />
                                                            </div>
                                                            <div class="cart-item__input">
                                                                <button class="cart-item__input-btn">
                                                                    <img class="icon" src="./assets/icons/minus.svg" alt="" />
                                                                </button>
                                                                <span>1</span>
                                                                <button class="cart-item__input-btn">
                                                                    <img class="icon" src="./assets/icons/plus.svg" alt="" />
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-item__content-right">
                                                        <p class="cart-item__total-price">$106.00</p>
                                                        <div class="cart-item__ctrl">
                                                            <button class="cart-item__ctrl-btn">
                                                                <img src="./assets/icons/heart-2.svg" alt="" />
                                                                Save
                                                            </button>
                                                            <button
                                                                class="cart-item__ctrl-btn js-toggle"
                                                                toggle-target="#delete-confirm"
                                                            >
                                                                <img src="./assets/icons/trash.svg" alt="" />
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Cart item 3 -->
                                            <article class="cart-item">
                                                <a href="./product-detail.html">
                                                    <img
                                                        src="./assets/img/product/item-3.png"
                                                        alt=""
                                                        class="cart-item__thumb"
                                                    />
                                                </a>
                                                <div class="cart-item__content">
                                                    <div class="cart-item__content-left">
                                                        <h3 class="cart-item__title">
                                                            <a href="./product-detail.html">
                                                                Qualità Oro Mountain Grown - Espresso Coffee Beans
                                                            </a>
                                                        </h3>
                                                        <p class="cart-item__price-wrap">
                                                            $38.65 | <span class="cart-item__status">In Stock</span>
                                                        </p>
                                                        <div class="cart-item__ctrl cart-item__ctrl--md-block">
                                                            <div class="cart-item__input">
                                                                LavAzza
                                                                <img
                                                                    class="icon"
                                                                    src="./assets/icons/arrow-down-2.svg"
                                                                    alt=""
                                                                />
                                                            </div>
                                                            <div class="cart-item__input">
                                                                <button class="cart-item__input-btn">
                                                                    <img class="icon" src="./assets/icons/minus.svg" alt="" />
                                                                </button>
                                                                <span>1</span>
                                                                <button class="cart-item__input-btn">
                                                                    <img class="icon" src="./assets/icons/plus.svg" alt="" />
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-item__content-right">
                                                        <p class="cart-item__total-price">$38.65</p>
                                                        <div class="cart-item__ctrl">
                                                            <button class="cart-item__ctrl-btn">
                                                                <img src="./assets/icons/heart-2.svg" alt="" />
                                                                Save
                                                            </button>
                                                            <button
                                                                class="cart-item__ctrl-btn js-toggle"
                                                                toggle-target="#delete-confirm"
                                                            >
                                                                <img src="./assets/icons/trash.svg" alt="" />
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="cart-info__bottom d-md-none">
                                            <div class="row">
                                                <div class="col-8 col-xxl-7">
                                                    <div class="cart-info__continue">
                                                        <a href="./" class="cart-info__continue-link">
                                                            <img
                                                                class="cart-info__continue-icon icon"
                                                                src="./assets/icons/arrow-down-2.svg"
                                                                alt=""
                                                            />
                                                            Continue Shopping
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-xxl-5">
                                                    <div class="cart-info__row">
                                                        <span>Subtotal:</span>
                                                        <span>$191.65</span>
                                                    </div>
                                                    <div class="cart-info__row">
                                                        <span>Shipping:</span>
                                                        <span>$10.00</span>
                                                    </div>
                                                    <div class="cart-info__separate"></div>
                                                    <div class="cart-info__row cart-info__row--bold">
                                                        <span>Total:</span>
                                                        <span>$201.65</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-xl-12">
                                    <div class="cart-info">
                                        <div class="cart-info__row">
                                            <span>Subtotal <span class="cart-info__sub-label">(items)</span></span>
                                            <span>3</span>
                                        </div>
                                        <div class="cart-info__row">
                                            <span>Price <span class="cart-info__sub-label">(Total)</span></span>
                                            <span>$191.65</span>
                                        </div>
                                        <div class="cart-info__row">
                                            <span>Shipping</span>
                                            <span>$10.00</span>
                                        </div>
                                        <div class="cart-info__separate"></div>
                                        <div class="cart-info__row">
                                            <span>Estimated Total</span>
                                            <span>$201.65</span>
                                        </div>
                                        <a href="?module=page&action=shipping" class="cart-info__next-btn btn btn--primary btn--rounded">
                                            Continue to checkout
                                        </a>
                                    </div>
                                    <div class="cart-info">
                                        <a href="#!">
                                            <article class="gift-item">
                                                <div class="gift-item__icon-wrap">
                                                    <img src="./assets/icons/gift.svg" alt="" class="gift-item__icon" />
                                                </div>
                                                <div class="gift-item__content">
                                                    <h3 class="gift-item__title">Send this order as a gift.</h3>
                                                    <p class="gift-item__desc">
                                                        Available items will be shipped to your gift recipient.
                                                    </p>
                                                </div>
                                            </article>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <?php
            layouts('footer');
            ?>
                <!-- Modal: confirm remove shopping cart item -->
                <div id="delete-confirm" class="modal modal--small hide">
                    <div class="modal__content">
                        <p class="modal__text">Do you want to remove this item from shopping cart?</p>
                        <div class="modal__bottom">
                            <button class="btn btn--small btn--outline modal__btn js-toggle" toggle-target="#delete-confirm">
                                Cancel
                            </button>
                            <button
                                class="btn btn--small btn--danger btn--primary modal__btn btn--no-margin js-toggle"
                                toggle-target="#delete-confirm"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                    <div class="modal__overlay js-toggle" toggle-target="#delete-confirm"></div>
                </div>
            <?php
    ?>

    <?php
        else:
            redirect('?module=auth&action=login');
    ?>

    <?php
        endif;
    ?>
    </body>
</html>
