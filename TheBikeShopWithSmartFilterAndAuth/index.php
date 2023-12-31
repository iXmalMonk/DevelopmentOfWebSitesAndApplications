<html lang="en">
    <head>
        <link rel="stylesheet" href="css/margin-padding.css">
        <link rel="stylesheet" href="css/styles.css">
        <title>The Bike Shop</title>
    </head>
    <body>
        <div class="header-slider">
            <!-- MODAL -->
            <?php
            if (!isset($_COOKIE["auth_token"]))
            {
                echo '
                <div id="auth-modal">
                    <form class="form" id="auth-form" method="POST">
                        <h3>AUTHORIZATION</h3>
                        <label>LOGIN:</label>
                        <input type="text" id="auth-login" name="auth-login" required>
                        <label>PASSWORD:</label>
                        <input type="password" id="auth-password" name="auth-password" required>
                        <button type="submit">SEND</button>
                        <button id="auth-exit">EXIT</button>
                    </form>
                </div>
                <div id="reg-modal">
                    <form class="form" id="reg-form" method="POST">
                        <h3>REGISTRATION</h3>
                        <label>LOGIN:</label>
                        <input type="text" id="reg-login" name="reg-login" required>
                        <label>PASSWORD:</label>
                        <input type="password" id="reg-password" name="reg-password" required>
                        <label>FULL NAME:</label>
                        <input type="text" id="reg-full-name" name="reg-full-name" required>
                        <label>EMAIL:</label>
                        <input type="email" id="reg-email" name="reg-email" required>
                        <label>AVATAR:</label>
                        <input type="file" id="reg-avatar" name="reg-avatar" accept="image/*" required>
                        <button type="submit">SEND</button>
                        <button id="reg-exit">EXIT</button>
                    </form>
                </div>
                <div id="fyp-modal">
                    <form class="form" id="fyp-form" method="POST">
                        <h3>FORGOT YOUR PASSWORD</h3>
                        <label>EMAIL:</label>
                        <input type="email" id="fyp-email" name="fyp-email" required>
                        <button type="submit">SEND</button>
                        <button id="fyp-exit">EXIT</button>
                    </form>
                </div>
                ';
            }
            else
            {
                session_start();
                echo '
                <div id="acc-modal">
                    <form class="form" id="acc-form" method="POST">
                        <h3>ACCOUNT</h3>
                        <label>PASSWORD:</label>
                        <input type="password" id="acc-password" name="acc-password">
                        <label>FULL NAME:</label>
                        <input type="text" id="acc-full-name" name="acc-full-name" value="'.$_SESSION["fullName"].'" required>
                        <label>EMAIL:</label>
                        <input type="email" id="acc-email" name="acc-email" value="'.$_SESSION["email"].'" required>
                        <label>AVATAR:</label>
                        <img class="img" src="avatars/'.$_SESSION["avatar"].'">
                        <input type="file" id="acc-avatar" name="acc-avatar" accept="image/*">
                        <button type="submit">SEND</button>
                        <button id="acc-exit">EXIT</button>
                    </form>
                </div>
                ';
            }
            ?>
            <!-- HEADER -->
            <div class="header p-t-15">
                <img class="header-logo" src="images/header-slider/header/logo-h.png" alt="logo-h">
                <nav class="header-nav">
                    <ul class="header-nav-ul p-t-25">
                        <!-- MODAL -->
                        <?php
                        if (!isset($_COOKIE["auth_token"]))
                        {
                            echo '
                            <li class="header-nav-ul-li p-t-5 p-r-30">
                                <button id="auth">AUTHORIZATION</button>
                            </li>
                            <li class="header-nav-ul-li p-t-5 p-r-30">
                                <button id="reg">REGISTRATION</button>
                            </li>
                            <li class="header-nav-ul-li p-t-5 p-r-30">
                                <button id="fyp">FORGOT YOUR PASSWORD</button>
                            </li>
                            ';
                        }
                        else
                        {
                            echo '
                            <li class="header-nav-ul-li p-t-5 p-r-30">
                                <a href="page.php">PAGE</a>
                            </li>
                            <li class="header-nav-ul-li p-t-5 p-r-30">
                                <button id="acc">ACCOUNT</button>
                            </li>
                            <li class="header-nav-ul-li p-t-5 p-r-30">
                                <button id="exit">EXIT</button>
                            </li>
                            ';
                        }
                        ?>
                        <li class="header-nav-ul-li p-t-5 p-r-30">
                            <a class="header-nav-ul-li-a header-hover" href="index.html">BICYCLES</a>
                            <ul class="header-hover-ul p-t-25">
                                <li class="header-hover-ul-li p-b-20">
                                    <a class="header-hover-ul-li-a" href="index.html">FIXED / SINGLE SPEED</a>
                                </li>
                                <li class="header-hover-ul-li p-b-20">
                                    <a class="header-hover-ul-li-a" href="index.html">CITY BIKES</a>
                                </li>
                                <li class="header-hover-ul-li">
                                    <a class="header-hover-ul-li-a" href="index.html">PREMIUM SERIES</a>
                                </li>
                            </ul>
                        </li>
                        <li class="header-nav-ul-li p-t-5 p-r-30">
                            <a class="header-nav-ul-li-a" href="index.html">PARTS</a>
                        </li>
                        <li class="header-nav-ul-li p-t-5 p-r-30">
                            <a class="header-nav-ul-li-a" href="index.html">ACCESSORIES</a>
                        </li>
                        <li class="header-nav-ul-li p-t-5 p-r-30">
                            <a class="header-nav-ul-li-a" href="index.html">EXTRAS</a>
                        </li>
                        <li class="header-nav-ul-li">
                            <a class="header-nav-ul-li-a" href="index.html">
                                <img src="images/header-slider/header/basket-h.png" alt="basket-h">
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- SLIDER -->
            <div class="slider">
                <h1 class="slider-h1">HANDMADE BICYCLE</h1>
                <div class="slider-block">
                    <a class="p-l-25" href="index.html">
                        <img class="slider-block-img-left" src="images/header-slider/slider/arrow-left-non-active-s.png" alt="arrow-left-s">
                    </a>
                    <h2 class="slider-block-h2">
                        You 
                        <span class="slider-block-h2-span">create </span>
                        the 
                        <span class="slider-block-h2-span">journey, </span>
                        we supply the 
                        <span class="slider-block-h2-span">parts.</span>
                    </h2>
                    <a class="p-r-25" href="index.html">
                        <img class="slider-block-img-right" src="images/header-slider/slider/arrow-right-non-active-s.png" alt="arrow-right-s">
                    </a>
                </div>
                <a class="slider-a-first p-t-15 p-b-15 p-l-25 p-r-25" href="index.html">SHOP BIKES</a>
                <a class="slider-a-second" href="index.html">
                    <img class="slider-a-second-img" src="images/header-slider/slider/anchor-non-active-s.png">
                </a>
                <img class="slider-img" src="images/header-slider/slider/stick-s.png" alt="stick-s">
            </div>
        </div>
        <!-- CATEGORIES -->
        <div class="categories">
            <h2 class="categories-h2">CATEGORIES</h2>
            <div class="categories-block">
                <div class="categories-block-first p-r-25">
                    <h4 class="categories-block-h4">FIXED / SINGLE SPEED</h4>
                    <h3 class="categories-block-h3">Are You ready for the 27.5 Revolution?</h3>
                    <a class="categories-block-a p-t-10 p-b-10" href="index.html">GO TO STORE</a>
                </div>
                <div class="categories-block-second p-r-25">
                    <h4 class="categories-block-h4">PREMIUM SERIES</h4>
                    <h3 class="categories-block-h3">Exclusive  Bike Components</h3>
                    <a class="categories-block-a p-t-10 p-b-10" href="index.html">GO TO STORE</a>
                </div>
                <div class="categories-block-third">
                    <h4 class="categories-block-h4">CITY BIKES</h4>
                    <h3 class="categories-block-h3">Street Playground</h3>
                    <a class="categories-block-a p-t-10 p-b-10" href="index.html">GO TO STORE</a>
                </div>
            </div>
        </div>
        <!-- GALLERY -->
        <div class="gallery">
            <h2 class="gallery-h2">POPULAR BIKES</h2>
            <div class="gallery-blocks">
                <div class="gallery-block-print-first">
                    <img class="gallery-blocks-img-first" src="images/gallery/first-photo-g.png" alt="first-photo-g">
                    <div class="gallery-block p-l-25">
                        <div>
                            <h4 class="gallery-block-first-h4">FIXED GEAD</h4>
                            <h4 class="gallery-block-second-h4">$249.00</h4>
                        </div>
                        <div>
                            <select class="gallery-block-select p-t-10 p-b-10 p-l-20 p-r-30">
                                <option>OPTION</option>
                                <option>OPTION 0</option>
                                <option>OPTION 1</option>
                            </select>
                            <a class="gallery-block-a p-t-10 p-b-10 p-l-30 p-r-30" href="index.html">BUY</a>
                        </div>
                    </div>
                </div>
                <div class="gallery-block-print-second">
                    <img class="gallery-blocks-img-second" src="images/gallery/second-photo-g.png" alt="second-photo-g">
                    <div class="gallery-block">
                        <div>
                            <h4 class="gallery-block-first-h4">BIG BOY ULTRA</h4>
                            <h4 class="gallery-block-second-h4">$249.00</h4>
                        </div>
                        <div>
                            <select class="gallery-block-select p-t-10 p-b-10 p-l-20 p-r-30">
                                <option>OPTION</option>
                                <option>OPTION 0</option>
                                <option>OPTION 1</option>
                            </select>
                            <a class="gallery-block-a p-t-10 p-b-10 p-l-30 p-r-30" href="index.html">BUY</a>
                        </div>
                    </div>
                </div>
                <div class="gallery-block-print-third">
                    <img class="gallery-blocks-img-third" src="images/gallery/third-photo-g.png" alt="third-photo-g">
                    <div class="gallery-block p-r-25">
                        <div>
                            <h4 class="gallery-block-first-h4">SANCHAEZ</h4>
                            <h4 class="gallery-block-second-h4">$249.00</h4>
                        </div>
                        <div>
                            <select class="gallery-block-select p-t-10 p-b-10 p-l-20 p-r-30">
                                <option>OPTION</option>
                                <option>OPTION 0</option>
                                <option>OPTION 1</option>
                            </select>
                            <a class="gallery-block-a p-t-10 p-b-10 p-l-30 p-r-30" href="index.html">BUY</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SMART FILTER -->
        <?php
        if (isset($_COOKIE["auth_token"]))
        {
            echo '
            <div class="smart-filter">
                <h2 class="smart-filter-h2 p-t-25 p-b-20">BIKES</h2>
                <div class="space-around" id="checkboxes"></div>
                <ul class="space-around flex-wrap" id="checkboxes_result"></ul>
            </div>
            ';
        }
        ?>
        <!-- CONTACT US -->
        <div class="contact-us">
            <h2 class="contact-us-h2 p-t-60">CONTACT US</h2>
            <h4 class="contact-us-h4 p-t-40">Please contact us for all inquiries and purchase options.</h4>
            <div class="contact-us-name-surname p-t-60">
                <input class="contact-us-input-name m-r-20 p-t-10 p-b-10 p-l-20 p-r-20" placeholder="NAME">
                <input class="contact-us-input-surname p-t-10 p-b-10 p-l-20 p-r-20" placeholder="SURNAME">
            </div>
            <div class="contact-us-email m-t-20">
                <input class="contact-us-input-email p-t-10 p-b-10 p-l-20 p-r-220" placeholder="USER@DOMAIN.COM">
            </div>
            <div class="contact-us-message m-t-20">
                <input class="contact-us-input-message p-t-20 p-b-150 p-l-20 p-r-220" placeholder="MESSAGE">
            </div>
            <div class="contact-us-block m-t-20">
                <a class="contact-us-block-a m-b-70 p-t-10 p-b-10 p-l-175 p-r-175" href="index.html">SEND</a>
            </div>
        </div>
        <!-- FOOTER -->
        <div class="footer p-t-20 p-b-20">
            <img class="footer-logo" src="images/footer/logo-f.png" alt="logo-f">
            <nav class="footer-nav p-t-10">
                <ul class="footer-nav-ul">
                    <li class="footer-nav-ul-li p-r-30">
                        <a class="footer-nav-ul-li-a" href="index.html">BICYCLES</a>
                    </li>
                    <li class="footer-nav-ul-li p-r-30">
                        <a class="footer-nav-ul-li-a" href="index.html">PARTS</a>
                    </li>
                    <li class="footer-nav-ul-li p-r-30">
                        <a class="footer-nav-ul-li-a" href="index.html">ACCESSORIES</a>
                    </li>
                    <li class="footer-nav-ul-li">
                        <a class="footer-nav-ul-li-a" href="index.html">EXTRAS</a>
                    </li>
                </ul>
            </nav>
        </div>
    </body>
    <script src="script.js"></script>
</html>