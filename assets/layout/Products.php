<?php

$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:10;
$current_page = !empty($_GET['page'])?$_GET['page']:1;
$offset = ($current_page - 1) * $item_per_page;
$productList = getRaw("SELECT id, title, brand, discount, thumbnail FROM product ORDER BY id ASC LIMIT $item_per_page OFFSET $offset");
$totalProduct = getRows("SELECT * FROM product");
$totalPages = ceil($totalProduct/$item_per_page);

?>
<!-- Browse Products -->
<section class="home__container">
    <div class="home__row">
        <h2 class="home__heading">Total LavAzza 1320</h2>
        <div class="filter-wrap">
            <button class="filter-btn js-toggle" toggle-target="#home-filter">
                Filter
                <img src="./assets/icons/filter.svg" alt="" class="filter-btn__icon icon" />
            </button>

            <div id="home-filter" class="filter hide">
                <img src="./assets/icons/arrow-up.png" alt="" class="filter__arrow" />
                <h3 class="filter__heading">Filter</h3>
                <form action="" class="filter__form form">
                    <div class="filter__row filter__content">
                        <!-- Filter column 1 -->
                        <div class="filter__col">
                            <label for="" class="form__label">Price</label>
                            <div class="filter__form-group">
                                <div
                                    class="filter__form-slider"
                                    style="--min-value: 10%; --max-value: 60%"
                                ></div>
                            </div>
                            <div class="filter__form-group filter__form-group--inline">
                                <div>
                                    <label for="" class="form__label form__label--small"> Minimum </label>
                                    <div class="filter__form-text-input filter__form-text-input--small">
                                        <input
                                            type="text"
                                            name=""
                                            id=""
                                            class="filter__form-input"
                                            value="$30.00"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="form__label form__label--small"> Maximum </label>
                                    <div class="filter__form-text-input filter__form-text-input--small">
                                        <input
                                            type="text"
                                            name=""
                                            id=""
                                            class="filter__form-input"
                                            value="$100.00"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="filter__separate"></div>

                        <!-- Filter column 2 -->
                        <div class="filter__col">
                            <label for="" class="form__label">Size/Weight</label>
                            <div class="filter__form-group">
                                <div class="form__select-wrap">
                                    <div class="form__select" style="--width: 158px">
                                        500g
                                        <img
                                            src="./assets/icons/select-arrow.svg"
                                            alt=""
                                            class="form__select-arrow icon"
                                        />
                                    </div>
                                    <div class="form__select">
                                        Gram
                                        <img
                                            src="./assets/icons/select-arrow.svg"
                                            alt=""
                                            class="form__select-arrow icon"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="filter__form-group">
                                <div class="form__tags">
                                    <button class="form__tag">Small</button>
                                    <button class="form__tag">Medium</button>
                                    <button class="form__tag">Large</button>
                                </div>
                            </div>
                        </div>

                        <div class="filter__separate"></div>

                        <!-- Filter column 3 -->
                        <div class="filter__col">
                            <label for="" class="form__label">Brand</label>
                            <div class="filter__form-group">
                                <div class="filter__form-text-input">
                                    <input
                                        type="text"
                                        name=""
                                        id=""
                                        placeholder="Search brand name"
                                        class="filter__form-input"
                                    />
                                    <img
                                        src="./assets/icons/search.svg"
                                        alt=""
                                        class="filter__form-input-icon icon"
                                    />
                                </div>
                            </div>
                            <div class="filter__form-group">
                                <div class="form__tags">
                                    <button class="form__tag">Lavazza</button>
                                    <button class="form__tag">Nescafe</button>
                                    <button class="form__tag">Starbucks</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter__row filter__footer">
                        <button class="btn btn--text filter__cancel js-toggle" toggle-target="#home-filter">
                            Cancel
                        </button>
                        <button
                            class="btn btn--primary filter__submit js-toggle"
                            toggle-target="#home-filter"
                        >
                            Show Result
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row row-cols-5 row-cols-lg-2 row-cols-sm-1 g-3">
        <?php
            if(!empty($productList)):
                $count = 0;
                foreach($productList as $item):
                    $count++;
        ?>
            <!-- Product card <?php echo $count ?> -->
            <div class="col">
                <article class="product-card">
                    <div class="product-card__img-wrap">
                        <a href="<?php echo _WEB_HOST; ?>?module=page&action=product-detail&id=<?php echo $item['id'] ?>">
                            <img src="<?php echo $item['thumbnail'] ?>" alt="" class="product-card__thumb" />
                        </a>
                        <button class="like-btn product-card__like-btn">
                            <img src="./assets/icons/heart.svg" alt="" class="like-btn__icon icon" />
                            <img src="./assets/icons/heart-red.svg" alt="" class="like-btn__icon--liked" />
                        </button>
                    </div>
                    <h3 class="product-card__title">
                        <a href="<?php echo _WEB_HOST; ?>?module=page&action=product-detail&id=<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a>
                    </h3>
                    <p class="product-card__brand"><?php echo $item['brand'] ?></p>
                    <div class="product-card__row">
                        <span class="product-card__price"><?php echo number_format($item['discount'], 0, ',', '.'); ?>đ</span>
                        <img src="./assets/icons/star.svg" alt="" class="product-card__star" />
                        <span class="product-card__score">4.3</span>
                    </div>
                </article>
            </div>
        <?php
                endforeach;
            endif;
        ?>
    </div>
    <div class="pagination-wrap">
        <ul class="pagination">
            <?php if($current_page > 3) { ?>
                <li class="pagenation__chenvron">
                    <a href="?per_page=<?php echo $item_per_page ?>&page=1" class="pagenation__chenvron-link">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>
            <?php } ?>

            <?php if($current_page > 1) { 
                $prev_page = $current_page - 1;?>
                <li class="pagination__num">
                    <a href="?per_page=<?php echo $item_per_page ?>&page=<?php echo $prev_page ?>" class="pagination__num-link">Prev</a>
                </li>
            <?php } ?>
            
            <?php
                for($num = 1; $num<=$totalPages; $num++){?>
                    <?php if($num != $current_page){ ?>
                        <?php if($num > $current_page - 3 && $num < $current_page + 3) { ?>
                            <li class="pagination__num">
                                <a href="?per_page=<?php echo $item_per_page ?>&page=<?php echo $num ?>" class="pagination__num-link"><?php echo $num ?></a>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <li class="pagination__num">
                            <a class="pagination__num-link pagination__num-link--active"><?php echo $num ?></a>
                        </li>
                    <?php } ?>
                <?php }
            ?>

            <?php if($current_page < $totalPages - 1) { 
                $prev_page = $current_page + 1;?>
                <li class="pagination__num">
                    <a href="?per_page=<?php echo $item_per_page ?>&page=<?php echo $prev_page ?>" class="pagination__num-link">Next</a>
                </li>
            <?php } ?>

            <?php if($current_page < $totalPages - 3) { ?>
                <li class="pagenation__chenvron">
                    <a href="?per_page=<?php echo $item_per_page ?>&page=<?php echo $totalPages ?>" class="pagenation__chenvron-link">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>
