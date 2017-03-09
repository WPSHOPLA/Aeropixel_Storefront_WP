<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */

add_action( 'wp_head', 'sf_child_theme_enqueue_style' );
/**
 * Dequeue the Storefront Parent theme core CSS.
 */
function sf_child_theme_enqueue_style() {
	wp_enqueue_style( 'storefront-childx-style', get_stylesheet_uri().'', '', null, 'all' );
}




 /**
  * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
  */
/* function storefront_primary_navigation() {
	?>

	<?php if (function_exists('ubermenu')) { ?>
		<?php ubermenu('main', array( 'menu' => 1481, 'theme_location' => 'primary' ) );
	?>
	<?php } else { ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle"><?php apply_filters('storefront_menu_toggle_text', $content = _e('Primary Menu', 'storefront'));
	?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) );
	?>
		</nav><!-- #site-navigation -->
	<?php }
	?>

	<?php

 }*/
 add_filter( 'woocommerce_product_categories_widget_args', 'change_product_category_walker' );

 function change_product_category_walker( $list_args ) {
 	include_once( get_stylesheet_directory() . '/walkers/class-product-cat-list-walker.php' );
 	$list_args['walker'] = new Custom_Product_Cat_List_Walker;

 	return $list_args;
 }


 add_action( 'wp_footer', 'collapsify_product_cat_widget_js', 999999 );
 function collapsify_product_cat_widget_js() {

 	//if ( is_shop() || is_product_category() ) {
 		?>
 			<script>
 				jQuery(document).ready(function($) {
 					$('.widget_product_categories span').addClass('expand');
 					$('.widget_product_categories').on('click', '.expand', function(e) {
 						$('.expand').removeClass('expand').addClass('collapse');
 						$('.up').trigger('click');
 					});
 					$('.widget_product_categories').on('click', '.collapse', function(e) {
 						$('.collapse').removeClass('collapse').addClass('expand');
 						$('.down').trigger('click');
 					});
 					$('.current-cat-parent, .current-cat').parent().slideDown();
 					$('.current-cat-parent .more-menu').not('.current-cat .more-menu').removeClass('up').addClass('down');
 					$('.widget_product_categories').on('click', '.more-menu', function(e) {
 						if ($(this).hasClass('up')) {
 							$(this).removeClass('up').addClass('down');
 						}else{
 							$(this).removeClass('down').addClass('up');
 						}
 						$(e.target).siblings('ul').slideToggle();
 						return false;
 					});
 					$('.widget_product_categories  li').each(function(){
 						if (!$(this).hasClass('cat-parent')) {
 							$('.more-menu', this).remove();
 						}
 					});
 				});
 			</script>
 		<?php
 	//}
 }
 add_action( 'wp_head', 'collapsify_product_cat_widget_css', 10 );
 function collapsify_product_cat_widget_css() {

 	//if ( is_shop() || is_product_category() ) {
 		?>
 			<style>
 				.breadcrumb {
 				    padding: .7em;
 				    margin-bottom: 1em;
 				    border: 1px solid #dbdbdb;
 				    background: #f0f0f0;
 				}
 				.breadcrumb a {
 				    color: #6b6b6b;
 				}
 				.widget_product_categories ul.children {
 					display: none;
 				}
 				.widget_product_categories.widget span,
 				.widget_layered_nav_filters.widget span,
 				.widget_layered_nav.widget span {
 				    /*border: 1px solid #000000;
 				    background-color: #6b6b6b;
 				    background: -webkit-gradient(linear,left top,left bottom,color-stop(50%,#6b6b6b),color-stop(50%,#6b6b6b),color-stop(50%,#494949));
 				    background: -webkit-linear-gradient(top,#6b6b6b,#494949);
 				    background: -moz-linear-gradient(top,#6b6b6b,#494949);
 				    background: -ms-linear-gradient(top,#6b6b6b,#494949);
 				    background: -o-linear-gradient(top,#6b6b6b,#494949);
 				    -webkit-box-shadow: inset 1px 1px 0 0 rgba(255,255,255,0.1);
 				    -moz-box-shadow: inset 1px 1px 0 0 rgba(255,255,255,0.1);
 				    box-shadow: inset 1px 1px 0 0 rgba(255,255,255,0.1);
 					color: #d9d9d9;*/
 					padding: 0.8em;
 					margin: 0;
 				}
 				.widget_product_categories.widget span {
 					cursor: pointer;
 				}
 				.widget_product_categories.widget span.expand:after {
 					content: ' (expand all)';
 				}
 				.widget_product_categories.widget span.collapse:after {
 					content: ' (collapse all)';
 				}
 				.widget_product_categories.widget span:before,
 				.widget_layered_nav_filters.widget span:before,
 				.widget_layered_nav.widget span:before {
 				    content: '\f0c9';
 				    font-family: FontAwesome;
 				    font-size: 14px;
 				    margin-right: 3px;
 				}
 				.widget_product_categories.widget ul {
 				    clear: both;
 				    list-style-position: inside;
 				    list-style-type: none;
 				}
 				.widget_product_categories.widget ul a.more-menu:before {
 				    font-family: FontAwesome;
 				    font-size: 12px;
 				}
 				.widget_product_categories.widget ul a.more-menu.up:before {
 				    content: '\f067';
 				}
 				.widget_product_categories.widget ul a.more-menu.down:before {
 				    content: '\f068';
 				}
 				.widget_product_categories.widget ul a,
 				.widget_layered_nav_filters.widget ul a,
 				.widget_layered_nav.widget ul a {
 					color: #6b6b6b;
 					padding: 0 4px;
 				}
 				.widget_product_categories.widget ul li.current-cat > a {
 					background: rgba(255,0,0,0.5);
 				    color: #ffffff;
 				}
 				.widget_product_categories.widget ul li.current-cat > a.more-menu {
 					background-color: transparent;
 					color: #6b6b6b;
 				}
 				.widget_product_categories.widget > ul,
 				.widget_layered_nav_filters.widget > ul,
 				.widget_layered_nav.widget > nav > div > ul,
 				.widget_layered_nav.widget > ul {
 				    padding: 0.8em;
					border: 1px solid #dbdbdb;
 					border-top: 0;
 					background-color: #ffffff;
 				}
 				.widget_product_categories.widget > ul > li,
 				.widget_layered_nav_filters.widget > ul > li,
 				.widget_layered_nav.widget > nav > div > ul > li,
 				.widget_layered_nav.widget > ul > li {
 					border-bottom: 1px dotted #428bca;
 					padding-bottom: 5px;
     				margin-bottom: 5px;
 				}
 				.widget_product_categories.widget > ul > li:nth-last-child(1),
 				.widget_layered_nav_filters.widget > ul > li:nth-last-child(1),
 				.widget_layered_nav.widget > ul > li:nth-last-child(1) {
 					border-bottom: 0;
 					padding-bottom: 0;
     				margin-bottom: 0;
 				}
 				.widget_layered_nav ul li .count {
 				    float: right;
 				    line-height: 22px;
 				    background: rgba(255,0,0,0.5);
 				    padding: 0 8px;
 				    border-radius: 10px;
 				    font-weight: bold;
 				    margin-bottom: .327em;
 				    color: #ffffff;
 				}
				.widget_product_categories ul li:before {
					display: none;
				}
				.widget-area .widget{font-size:15px}

/*Henri*/
.home #secondary{display:none}

/*Slider*/
#paypal_ec_button img, #paypal_ec_paypal_credit_button img{margin: 0 auto;}

.home header.entry-header h1.entry-title{display:none;}

.widget_product_categories.widget span.expand, .widget_layered_nav_filters.widget span.expand, 	.widget_layered_nav.widget span.expand,	.widget_product_categories.widget span.collapse, .widget_layered_nav_filters.widget span.collapse, .widget_layered_nav.widget span.collapse{
	    border: 1px solid #000;
	    background-color: #6b6b6b;
	    background: -webkit-gradient(linear,left top,left bottom,color-stop(50%,#6b6b6b), color-stop(50%,#6b6b6b),color-stop(50%,#494949));
	    background: -webkit-linear-gradient(top,#6b6b6b,#494949);
	    background: -moz-linear-gradient(top,#6b6b6b,#494949);
	    background: -ms-linear-gradient(top,#6b6b6b,#494949);
	    background: -o-linear-gradient(top,#6b6b6b,#494949);
	    -webkit-box-shadow: inset 1px 1px 0 0 rgba(255,255,255,.1);
	    -moz-box-shadow: inset 1px 1px 0 0 rgba(255,255,255,.1);
	    box-shadow: inset 1px 1px 0 0 rgba(255,255,255,.1);
	    color: #d9d9d9;
	    padding: .8em;
	    margin: 0;
}

.widget-area .widget a:not(.button){text-decoration: none;}
.widget-area .widget a:not(.button):hover{text-decoration: underline;}
a:focus, .button:focus, .button.alt:focus, .button.added_to_cart:focus, .button.wc-forward:focus, button:focus,
input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus {outline: none;}
.main-navigation ul li a:hover, .main-navigation ul li:hover>a, .site-title a:hover, a.cart-contents:hover, .site-header-cart .widget_shopping_cart a:hover, .site-header-cart:hover>li>a, .site-header ul.menu li.current-menu-item>a {background-color: #4a79f3;}
.site-header-cart .cart-contents {padding: 0.7em 1em;}
h1.entry-title { font: 32px/1.1em 'Exo',arial,sans-serif; color: #0a5494;}
a:link, a:visited, #loopedSlider a.flex-prev:hover, #loopedSlider a.flex-next:hover {color: #0a5494;}
a.wl-add-to{color:white;}
a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover {color: #c27018;}
.storefront-product-section .section-title {text-align:left;}


/*Single Product Page*/
.single-product a.woocommerce-main-image img{margin: 0 auto;}
.single-product #wl-wrapper{display:initial;}
.woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button
{float:none;}
.single-product div.product form.cart{margin:0; padding:0;}
.single_add_to_cart_button{  margin-bottom: 2em; margin-left: 3.4em; padding: 5px 16px; margin-top: 12px;}
.wl-add-to.wl-add-to-single{    margin-bottom: 2em; margin-left: 1em; padding: 5px 16px; margin-top: 0px;}


/*Single Product Social icon*/
ul.social-icons-share{margin:20px 0;}
ul.social-icons-share li{ display:inline-block;margin: 5px 2px;}
.social-icons-share.icon-circle .fa { border-radius: 50%;}
.social-icons-share .fa-google-plus, .social-icons .fa-google-plus-square { background-color: #cf3d2e;}
.social-icons-share .fa-facebook, .social-icons .fa-facebook-square {background-color: #3c599f;}
.social-icons-share .fa-youtube, .social-icons .fa-youtube-play, .social-icons .fa-youtube-square { background-color: #c52f30;}
.social-icons-share .fa-twitter, .social-icons .fa-twitter-square {background-color: #32ccfe;}
.social-icons-share .fa-vimeo-square { background-color: #229acc;}
.social-icons-share .fa-instagram { background-color: #a1755c;}
.social-icons-share .fa { font-size: 1.5em; width: 50px;height: 50px;line-height: 50px; text-align: center; color: #fff; color: rgba(255,255,255,.8);  -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out; -ms-transition: all .3s ease-in-out; -o-transition: all .3s ease-in-out; transition: all .3s ease-in-out;}

div.product .woocommerce-tabs {padding: 1em; background: rgba(173, 177, 176, 0.06); margin-bottom:40px;}
.woocommerce-tabs ul.tabs{width:100%; float:none;}
.woocommerce-tabs .panel {width:100%; float:none; padding:10px;}
.woocommerce-tabs ul.tabs li {padding:10px;display:inline-block;}

/*Woocommerce Product Quantity*/
.woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus
{
	position: relative;
	top: 0; width: 32px;
	height: 32px;  
	padding: 0;
	text-align: center;
	background: #428bca;
	border: 0;
	color: #fff;
	line-height: 0;
	border-radius: 3px;
	cursor: pointer;
	font-size: 14px;
}

.woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce .quantity .qty,
 .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page .quantity .qty {  float: left; margin: 0;}
.woocommerce .quantity input.qty, .woocommerce-page .quantity input.qty { height:32px;}
.home .woocommerce .quantity, .home .woocommerce-page .quantity, .up-sells .quantity, .related .quantity {display:none;}
.woocommerce .quantity, .woocommerce-page .quantity { margin-top: 5px;transform: translateY(30%); padding-right:0;}


.widget_nav_menu ul li:before { content: "\f105";}

/*Footer Social Icons*/
ul.social-icons{margin-top:20px;}
ul.social-icons li{ display:inline-block;margin: 5px 2px;}
.social-icons.icon-circle .fa { border-radius: 50%;}
.social-icons .fa-google-plus, .social-icons .fa-google-plus-square { background-color: #cf3d2e;}
.social-icons .fa-facebook, .social-icons .fa-facebook-square {background-color: #3c599f;}
.social-icons .fa-youtube, .social-icons .fa-youtube-play, .social-icons .fa-youtube-square { background-color: #c52f30;}
.social-icons .fa-twitter, .social-icons .fa-twitter-square {background-color: #32ccfe;}
.social-icons .fa-vimeo-square { background-color: #229acc;}
.social-icons .fa-instagram { background-color: #a1755c;}
.social-icons .fa { font-size: 1.5em; width: 50px;height: 50px;line-height: 50px; text-align: center; color: #fff; color: rgba(255,255,255,.8);  -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out; -ms-transition: all .3s ease-in-out; -o-transition: all .3s ease-in-out; transition: all .3s ease-in-out;}




.site-search .widget_product_search form:before { top: 1em; left: 1.618em;}

.site-search .widget_product_search input[type=search], .site-search .widget_product_search input[type=text] { padding: 1em 1.618em 1em 3.706325903em;}


//Hide Side bar on special Pages

.single.left-sidebar .content-area{width:100%;}
.single #primary{width:100%;}
.single #secondary{display:none;}
.single #main span.onsale {display:none;}


/*Site Header Width*/
.woocommerce-active .site-header .col-full{max-width:100%;}

/*Cart font color*/
ul.site-header-cart li a{color: #43454b;}

/*Site Footer*/
.site-footer {background: #272727; padding:0;}
.site-footer .col-full{max-width: 100%; width: 100%; padding:0;}
.site-footer .footer-widgets {padding-top:2em; width:80%; margin: 0 auto;}
.site-footer a:not(.button) {color: #cfcfcf;}
.site-footer .widget_nav_menu ul li:before { content: "";}
.site-footer .widget_nav_menu ul.menu li a{text-transform: uppercase;}
.site-footer .widget_nav_menu ul.sub-menu{margin-left:0;}
.site-footer .widget_nav_menu ul.sub-menu li a{text-transform: none; font-weight:300;}
.site-footer .site-info { text-align: right; padding:1em 1em; background: #202020; border-top: 1px solid #3c3c3c;}
.site-footer .pf{color: #fcfcfc;}



/*main content and header space*/
.page-template-template-homepage .site-main{padding-top: 1em;}

/*List of Products*/
.site-main ul.products li.product:hover{opacity:0.7;}
ul.products li.product { border: 1px solid #e6e6e6; padding: 5px;}
ul.products li.product img{width:80%;}
ul.products li.product .button {color: white;height:40px;background: #428bca;padding:10px;}
form.cart{margin-bottom:0;}


.codenegar_wcsl_icon{display:inline-block; margin: 0 5px;}

@media screen and (min-width: 768px) {
	
	
	.blog.left-sidebar .content-area {width: 100%}

	/*Site Header*/
	.site-header { padding-top: 0; padding-bottom: 0;}

	/* LOGO */
	.site-header .site-branding { width: 50%; float: none; margin: 0.5em 0 0.5em 1em; clear: both; overflow: auto;display:inline-block;}
	.site-header .site-branding img { max-width: 60%;}


	/*Cart and Search bar*/
	.woocommerce-active .site-header .site-header-cart { width: 15%; margin-top:20px;}
	.site-header .site-search {margin-top:20px;width:15%;}

	/*Secondary Navigation a color*/
	.secondary-navigation ul.menu a {padding: 1.1em .875em; color: #d9d9d9; box-shadow: inset 1px 0 0 0 rgba(255,255,255,.1); background: #2c2d33;}

	/*Home page*/
	.page-template-template-homepage-php.left-sidebar .content-area#primary{width:100%}

	/*Site Navigation*/
	.storefront-primary-navigation {background-color: #333; margin-left: -5%; padding-left: 4%; margin-right: -5%; padding-right: 4%; width: 110%;}

	/*Primary navigation*/
	.woocommerce-active .site-header .main-navigation{width: 70%;margin-right:0}

	/* SECONDARY NAVIGATION */
	.woocommerce-active .site-header .secondary-navigation {margin-left: auto; margin-right:0; width: 30%; background-color: #333; margin-bottom:0;line-height:1.5}

	/*Site Navigation Link*/
	#site-navigation.main-navigation ul.menu>li>a, .main-navigation ul.nav-menu>li>a {padding: 1.1em .7em; line-height: 1.1;}


	.site-header-cart .widget_shopping_cart, .main-navigation ul.menu ul.sub-menu, .main-navigation ul.nav-menu ul.children {
		background-color: #333;
	}
	
	.site-header-cart .widget_shopping_cart{padding-bottom:20px}

	.main-navigation ul.menu>li:first-child, .main-navigation ul.nav-menu>li:first-child { margin-left: 0em;}

	/*Wooslider*/
	.wooslider {width: 140%; margin-left:-20%;}
	body .wooslider .slide-content {overflow: auto;}
	body .wooslider.wooslider-type-slides img { height: auto; width: 100%; margin: 0 auto;}

	/*Products in List*/
	ul.products li.product .woocommerce-LoopProduct-link {min-height:390px;}
	.archive ul.products li.product .woocommerce-LoopProduct-link {min-height:300px;}
}


@media screen and (max-width: 768px) {
	
	.site-header .site-search{display:block; margin-top: 50px;}
	.storefront-primary-navigation{margin-top: -20px;}
	.site-header .custom-logo-link, .site-header .site-branding, .site-header .site-logo-anchor, .site-header .site-logo-link { float: none;}
	.site-header .site-branding img { float:none; margin: 0 auto;}
	.woocommerce-active .site-header .site-branding { float:none;}
	#site-navigation button.menu-toggle{ background: #2a2a2a; float: none; width: 100%; position: relative;  margin: 20px 0;}

	.vc_custom_1479667149174 { margin-top: 50px!important; margin-bottom: 30px; font-size: 30px;}


	.main-navigation ul {  background: rgba(0, 0, 0, 0.8);  border-radius: 15px; padding: 10px;}

	.main-navigation ul li a{margin: 0 10%;}

	.main-navigation ul li a:hover, .main-navigation ul li:hover>a, .site-title a:hover, a.cart-contents:hover, .site-header-cart .widget_shopping_cart a:hover, .site-header-cart:hover>li>a, .site-header ul.menu li.current-menu-item>a
	{color: white;}
	.main-navigation ul li > a, .main-navigation ul li >a, .site-title a, a.cart-contents, .site-header-cart .widget_shopping_cart a, .site-header-cart li>a, .site-header ul.menu li.current-menu-item>a
	{color: white;}

	/*Footer*/
	.site-footer .col-full{width: auto;}
	.site-footer .site-info{width: 120%; margin-left: -10%}

	.storefront-handheld-footer-bar ul.columns-3 li.my-account a:first-child {display:none;}
	.storefront-handheld-footer-bar ul.columns-3 li> a:not(.button) {color: #333;}

	
}





				
 			</style>
 		<?php
 	//}
 }

//custom style
//add_action( 'wp_head', 'sf_child_theme_enqueue_custom_style' );

function sf_child_theme_enqueue_custom_style() {
	 wp_enqueue_style( 'storefront-childx-custom-style',  get_stylesheet_directory_uri().'/custom.css', '', null, 'all' );
}

//remove designed by WooThemes

add_action( 'init', 'custom_remove_footer_credit', 10 );

function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'custom_storefront_credit', 20 );
} 

function custom_storefront_credit() {
	?>
	<div class="site-info">
		&copy; <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?>
	</div><!-- .site-info -->
	<?php
}
