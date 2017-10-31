<?php
$auth= 0;
$stylesheets = "";
$title = "Accueil";
include('lib/includes.php');
if(isset($_SESSION['Auth']['user']['statut'])&&$_SESSION['Auth']['user']['statut']=='Admin'){
    require_once 'partials/admin_header_gen.php';
}elseif (isset($_SESSION['Auth']['user']['statut'])&& $_SESSION['Auth']['user']['statut']=='Simple utilisateur'){
    require_once 'partials/header.php';
}else{
    require_once 'partials/header_gen.php';
}
?>

<div class="bg">
    <!---- banner ---->
    <div class="banner wow fadeIn" data-wow-delay="0.5s" style="margin-top: -160px">
        <div class="container">
            <div class="banner-info text-center">
                <h1>LOGESTA</h1><br />
                <span> </span>
                <p>Application de Gestion et Statistiques</p>
            </div>
        </div>
    </div>

</div>
<!---- banner ---->
<!--- services --->
<div id="services" class="services">
    <div class="container">
        <div class="service-head text-center">
            <br>
            <h2>Fonctionnalités Principales</h2>
            <span> </span>
        </div>
        <!--- services-grids --->
        <div class="services-grids text-center">
            <div class="col-md-4">
                <div class="service-grid wow bounceInLeft" data-wow-delay="0.4s">
                    <i class="fa fa-5x fa-bar-chart"></i>
                    <h3><a href="#">Statistiques</a></h3>
                    <!--<p>Faites des statistiques avancées sur vos données</p>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-grid wow bounceIn" data-wow-delay="0.4s">
                    <i class="fa fa-5x fa-file-pdf-o"></i>
                    <h3><a href="#">Documents Administratifs</a></h3>
                    <!--<p>Vous pouvez générer des attestations et certificats</p>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-grid wow bounceInRight" data-wow-delay="0.4s">
                    <i class="fa fa-5x fa-address-book"></i>
                    <h3><a href="#">24/7 Contact</a></h3>
                    <!--<p>A tout moment, vous pouvez contacter vos étudiants</p>-->
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--- services-grids --->
    </div>
</div>
<!--- services --->
<div class="clearfix"> </div>
<!--- Other Expertise ---->
<!--<div id="port" class="expertise">
    <div class="expertice-grids">
        <div class="col-md-12 expertice-left-grid wow fadeInLeft" data-wow-delay="0.4s">
            <div class="expertise-head">
                <h3>Other Expertise</h3>
                <p>Proin iaculis purus consequat sem cure  digni ssim. Donec porttitora entum suscipit  aenean rhoncus posuere odio in tincidunt consequat sem cure  digni ssim. </p>
            </div>
            <div class="expertise-left-inner-grids">
                <div class="e-left-inner-grid">
                    <div class="e-left-inner-grid-left">
                        <span class="e-icon1"> </span>
                    </div>
                    <div class="e-left-inner-grid-right">
                        <h4>Exportation de Fichiers</h4>
                        <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="e-left-inner-grid">
                    <div class="e-left-inner-grid-left">
                        <span class="e-icon2"> </span>
                    </div>
                    <div class="e-left-inner-grid-right">
                        <h4>Saisie de données</h4>
                        <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="e-left-inner-grid">
                    <div class="e-left-inner-grid-left">
                        <span class="e-icon3"> </span>
                    </div>
                    <div class="e-left-inner-grid-right">
                        <h4>All star support team</h4>
                        <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="e-left-inner-grid">
                    <div class="e-left-inner-grid-left">
                        <span class="e-icon4"> </span>
                    </div>
                    <div class="e-left-inner-grid-right">
                        <h4>top notch security</h4>
                        <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <a class="leran-more" href="#">Learn more</a>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>-->
<!--- Other Expertise ---->
<!--- portfolio ---->
<div class="portfolio">
    <div class="portfolio-top">
        <div class="col-md-8">
            <div class="portfolio-top-left wow fadeInLeft" data-wow-delay="0.4s">
                <h3>Autres Fonctionnalités</h3>
                <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit.</p>
                <p>Iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat.</p>
                <div class="portfolio-top-left-grids">
                    <div class="portfolio-top-left-grid">
                        <div class="portfolio-top-left-grid-left">
                            <span class="p-icon1"> </span>
                        </div>
                        <div class="portfolio-top-left-grid-right">
                            <h5>Sail Away Your Worries</h5>
                            <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. </p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="portfolio-top-left-grid">
                        <div class="portfolio-top-left-grid-left">
                            <span class="p-icon2"> </span>
                        </div>
                        <div class="portfolio-top-left-grid-right">
                            <h5>All-star support team</h5>
                            <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. </p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="portfolio-top-left-grid">
                        <div class="portfolio-top-left-grid-left">
                            <span class="p-icon3"> </span>
                        </div>
                        <div class="portfolio-top-left-grid-right">
                            <h5>fully Integrated service</h5>
                            <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. </p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 portfolio-top-right-inner wow fadeInRight" data-wow-delay="0.4s">
            <div class="portfolio-top-right">

            </div>
        </div>
        <div class="clearfix"> </div>
        <!---- portfolio-works ---->
        <!---- portfolio-works ---->
    </div>
</div>
<!--- portfolio ---->
<!---- about ---->
<!---start-about---->
<div class="about">
    <div class="wrap">
        <div class="about-head">
            <h1>Comment ça marche?</h1>
            <span> </span>
        </div>
        <!---start-about-time-line---->
        <div class="about-time-line">
            <li>
                <div class="cbp_tmicon img1"> </div>
                <div class="cbp_tmlabel wow fadeInLeft" data-wow-delay="0.4s">
                    <h2>July 2010 Our Humble Beginnings</h2>
                    <p>Proin iaculis purus consequat sem cure  digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit.</p>
                </div>
            </li>
            <li>
                <div class="cbp_tmicon1 img2"> </div>
                <div class="cbp_tmlabel cbp_tmlabel1 wow fadeInRight" data-wow-delay="0.4s">
                    <h2>January 2011 Facing Startup Battles </h2>
                    <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt.</p>
                </div>
            </li><br />
            <li>
                <div class="cbp_tmicon2 img3"> </div>
                <div class="cbp_tmlabel wow fadeInLeft" data-wow-delay="0.4s">
                    <h2>December 2012 Enter The Dark Days </h2>
                    <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat sem cure digni.</p>
                </div>
            </li>
            <li>
                <div class="cbp_tmicon3 img4"> </div>
                <div class="cbp_tmlabel cbp_tmlabel1 wow fadeInRight" data-wow-delay="0.4s">
                    <h2>January 2013Our Triumph </h2>
                    <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean.</p>
                </div>
            </li>
            <li>
                <div class="cbp_tmicon4 img5"> </div>
            </li>
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!---//End-about-time-line---->
    <!---- about ---->
</div>
<!---- team --->
<!--<div id="team" class="team-members">
    <div class="wrap">
        <div class="tm-head">
            <h3>our amazing team</h3>
            <p>Proin iaculis purus consequat sem cure.</p>
        </div>
        <div class="tm-head-grids">
            <div class="tm-head-grid wow fadeInLeft" data-wow-delay="0.4s">
                <img src="images/team-member1.jpg" alt="">
                <h4>Kimberly Thompson</h4>
                <h5>Marketer</h5>
                <ul class="top-social-icons">
                    <li><a class="twitter" href="#"> </a></li>
                    <li><a class="facebook" href="#"> </a></li>
                    <li><a class="pin" href="#"> </a></li>
                    <div class="clear"> </div>
                </ul>
            </div>
            <div class="tm-head-grid wow fadeInUp" data-wow-delay="0.4s">
                <img src="images/team-member2.jpg" alt="">
                <h4>Rico Massimo</h4>
                <h5>Coder</h5>
                <ul class="top-social-icons">
                    <li><a class="twitter" href="#"> </a></li>
                    <li><a class="facebook" href="#"> </a></li>
                    <li><a class="pin" href="#"> </a></li>
                    <div class="clear"> </div>
                </ul>
            </div>
            <div class="tm-head-grid wow fadeInRight" data-wow-delay="0.4s">
                <img src="images/team-member3.jpg" alt="">
                <h4>Uku Mason</h4>
                <h5>Graphic Designer</h5>
                <ul class="top-social-icons">
                    <li><a class="twitter" href="#"> </a></li>
                    <li><a class="facebook" href="#"> </a></li>
                    <li><a class="pin" href="#"> </a></li>
                    <div class="clear"> </div>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <p class="team-info">Proin iaculis purus consequat sem cure  digni ssim donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt proin iaculis.</p>
    </div>
</div>-->
<!---- team --->
<!---- contact --->
<div id="contact" class="contact">
    <div class="container">
        <div class="contact-grids">
            <div class="col-md-6">
                <div class="contact-left wow fadeInRight" data-wow-delay="0.4s">
                    <h3>Contact Us</h3>
                    <label>Don't be shy, drop us an email and say hello! We are a really nice bunch of people :)</label>
                    <div class="contact-left-grids">
                        <div class="col-md-6">
                            <div class="contact-left-grid">
                                <p><span class="c-mobi"> </span>(416) 555-0000</p>
                                <p><span class="c-twitter"> </span><a href="#">@dreams</a></p>
                                <p><span class="c-pluse"> </span><a href="#">plus.com/dreams</a></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-right-grid">
                                <p><span class="c-msg"> </span><a href="mailto:hello@dreams.com">hello@dreams.com</a></p>
                                <p><span class="c-face"> </span><a href="#">facebook.com/dreams</a></p>
                                <p><span class="c-pin"> </span><a href="#">pinterest.com/dreams</a></p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-right wow fadeInLeft" data-wow-delay="0.4s">
                    <form>
                        <input type="text" class="text" value="Name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name...';}">
                        <input type="text" class="text" value="Email..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email...';}">
                        <textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message..</textarea>
                        <input class="wow shake" data-wow-delay="0.3s" type="submit" value="Send Message" />
                    </form>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!---- contact --->
<?php
$scripts = "";
require 'partials/footer.php';
?>
