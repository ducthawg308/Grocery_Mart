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
                <main class="profile">
                    <div class="container">
                        <!-- Search bar -->
                        <div class="profile-container">
                            <div class="search-bar d-none d-md-flex">
                                <input type="text" name="" id="" placeholder="Search for item" class="search-bar__input" />
                                <button class="search-bar__submit">
                                    <img src="./assets/icons/search.svg" alt="" class="search-bar__icon icon" />
                                </button>
                            </div>
                        </div>

                        <!-- Profile content -->
                        <div class="profile-container">
                            <div class="row gy-md-3">
                                <div class="col-3 col-xl-4 d-lg-none">
                                    <aside class="profile__sidebar">
                                        <!-- User -->
                                        <div class="profile-user">
                                            <img src="./assets/img/avatar/avatar-3.png" alt="" class="profile-user__avatar" />
                                            <h1 class="profile-user__name">Imran Khan</h1>
                                            <p class="profile-user__desc">Registered: 17th May 2022</p>
                                        </div>

                                        <!-- Menu 1 -->
                                        <div class="profile-menu">
                                            <h3 class="profile-menu__title">Manage Account</h3>
                                            <ul class="profile-menu__list">
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/profile.svg" alt="" class="icon" />
                                                        </span>
                                                        Personal info
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/location.svg" alt="" class="icon" />
                                                        </span>
                                                        Addresses
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/message-2.svg" alt="" class="icon" />
                                                        </span>
                                                        Communications & privacy
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Menu 2 -->
                                        <div class="profile-menu">
                                            <h3 class="profile-menu__title">My items</h3>
                                            <ul class="profile-menu__list">
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/download.svg" alt="" class="icon" />
                                                        </span>
                                                        Reorder
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/heart.svg" alt="" class="icon" />
                                                        </span>
                                                        Lists
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/gift-2.svg" alt="" class="icon" />
                                                        </span>
                                                        Registries
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Menu 3 -->
                                        <div class="profile-menu">
                                            <h3 class="profile-menu__title">Subscriptions & plans</h3>
                                            <ul class="profile-menu__list">
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/shield.svg" alt="" class="icon" />
                                                        </span>
                                                        Protection plans
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Menu 4 -->
                                        <div class="profile-menu">
                                            <h3 class="profile-menu__title">Customer Service</h3>
                                            <ul class="profile-menu__list">
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/info.svg" alt="" class="icon" />
                                                        </span>
                                                        Help
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#!" class="profile-menu__link">
                                                        <span class="profile-menu__icon">
                                                            <img src="./assets/icons/danger.svg" alt="" class="icon" />
                                                        </span>
                                                        Terms of Use
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </aside>
                                </div>
                                <div class="col-9 col-xl-8 col-lg-12">
                                    <div class="cart-info">
                                        <div class="row gy-3">
                                            <div class="col-12">
                                                <h2 class="cart-info__heading">
                                                    <a href="./profile.html">
                                                        <img
                                                            src="./assets/icons/arrow-left.svg"
                                                            alt=""
                                                            class="icon cart-info__back-arrow"
                                                        />
                                                    </a>
                                                    Personal info
                                                </h2>

                                                <form action="./profile.html" class="form form-card">
                                                    <!-- Form row 1 -->
                                                    <div class="form__row">
                                                        <div class="form__group">
                                                            <label for="full-name" class="form__label form-card__label">
                                                                Full name
                                                            </label>
                                                            <div class="form__text-input">
                                                                <input
                                                                    type="text"
                                                                    name=""
                                                                    id="full-name"
                                                                    placeholder="Full name"
                                                                    class="form__input"
                                                                    required
                                                                    autofocus
                                                                />
                                                                <img
                                                                    src="./assets/icons/form-error.svg"
                                                                    alt=""
                                                                    class="form__input-icon-error"
                                                                />
                                                            </div>
                                                            <p class="form__error">Please enter your full name</p>
                                                        </div>
                                                        <div class="form__group">
                                                            <label for="email-adress" class="form__label form-card__label">
                                                                Email address
                                                            </label>
                                                            <div class="form__text-input">
                                                                <input
                                                                    type="text"
                                                                    name=""
                                                                    id="email-adress"
                                                                    placeholder="Email address"
                                                                    class="form__input"
                                                                    required
                                                                />
                                                                <img
                                                                    src="./assets/icons/form-error.svg"
                                                                    alt=""
                                                                    class="form__input-icon-error"
                                                                />
                                                            </div>
                                                            <p class="form__error">Please enter a valid email address</p>
                                                        </div>
                                                    </div>

                                                    <!-- Form row 2 -->
                                                    <div class="form__row">
                                                        <div class="form__group">
                                                            <label for="phone-number" class="form__label form-card__label">
                                                                Phone Number
                                                            </label>
                                                            <div class="form__text-input">
                                                                <input
                                                                    type="text"
                                                                    name=""
                                                                    id="phone-number"
                                                                    placeholder="Phone Number"
                                                                    class="form__input"
                                                                    required
                                                                />
                                                                <img
                                                                    src="./assets/icons/form-error.svg"
                                                                    alt=""
                                                                    class="form__input-icon-error"
                                                                />
                                                            </div>
                                                            <p class="form__error">Please enter a valid phone number</p>
                                                        </div>
                                                        <div class="form__group">
                                                            <label for="passowrd" class="form__label form-card__label">
                                                                Password
                                                            </label>
                                                            <div class="form__text-input">
                                                                <input
                                                                    type="password"
                                                                    name=""
                                                                    id="passowrd"
                                                                    placeholder="Password"
                                                                    class="form__input"
                                                                    required
                                                                />
                                                                <img
                                                                    src="./assets/icons/form-error.svg"
                                                                    alt=""
                                                                    class="form__input-icon-error"
                                                                />
                                                            </div>
                                                            <p class="form__error">Please enter new password</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-card__bottom">
                                                        <a class="btn btn--text" href="./profile.html">Cancel</a>
                                                        <button class="btn btn--primary btn--rounded">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
