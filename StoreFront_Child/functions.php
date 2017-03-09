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
 add_action( 'wp_head', 'collapsify_product_cat_widget_css', 999999 );
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

body .wooslider .slide-content {
    overflow: auto;
}

body .wooslider.wooslider-type-slides img {
    height: 300px;
    width: 100%;
    margin: 0 auto;
}

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
.woocommerce .quantity .minus, .woocommerce-page .quantity .minus {
    border-radius: 3px 0 0 3px;
}

.widget-area .widget a:not(.button){text-decoration: none;}
.widget-area .widget a:not(.button):hover{text-decoration: underline;}
a:focus, .button:focus, .button.alt:focus, .button.added_to_cart:focus, .button.wc-forward:focus, button:focus,
input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus {outline: none;}
.main-navigation ul li a:hover, .main-navigation ul li:hover>a, .site-title a:hover, a.cart-contents:hover, .site-header-cart .widget_shopping_cart a:hover, .site-header-cart:hover>li>a, .site-header ul.menu li.current-menu-item>a {background-color: #4a79f3;}
.site-header-cart .cart-contents {padding: 0.7em 1em;}
h1.entry-title { font: 32px/1.1em 'Exo',arial,sans-serif; color: #0a5494;}
a:link, a:visited, #loopedSlider a.flex-prev:hover, #loopedSlider a.flex-next:hover {color: #0a5494;}
a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover {color: #c27018;}
.storefront-product-section .section-title {text-align:left;}


ul.products li.product {
    border-bottom: 1px solid #e6e6e6;
    padding-bottom: 10px;
    min-height:390px;

}

ul.products li.product .button {color: white;height:40px;background: #428bca;padding:10px;}

.onsale {
    position: absolute;
    top: 10px;
    left: -10px;
    padding: 3px 8px;
    text-align: center;
    background: #c63f00;
    border-radius: 40px;
    color: #fff;
    font-weight: bold;
    border-color: #c63f00;
}


.woocommerce .quantity, .woocommerce-page .quantity {
    position: relative;
    margin: 0 auto;
    overflow: hidden;
    zoom: 1;
    padding-right: 1.1em;
    clear: left;
    display: inline-block;
    transform: translateY(35%);
}

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

.woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce .quantity .qty, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page .quantity .qty {
    float: left;
    margin: 0;
}

.woocommerce .quantity input.qty, .woocommerce-page .quantity input.qty { height:32px;}


/*Footer Social Icons*/
ul.social-icons li{
	display:inline-block;
	margin: 5px 2px;
}
.social-icons.icon-circle .fa {
    border-radius: 50%;
}
.social-icons .fa-google-plus, .social-icons .fa-google-plus-square {
    background-color: #cf3d2e;
}
.social-icons .fa-facebook, .social-icons .fa-facebook-square {
    background-color: #3c599f;
}

.social-icons .fa-youtube, .social-icons .fa-youtube-play, .social-icons .fa-youtube-square {
    background-color: #c52f30;
}
.social-icons .fa-twitter, .social-icons .fa-twitter-square {
    background-color: #32ccfe;
}

.social-icons .fa-vimeo-square {
    background-color: #229acc;
}
.social-icons .fa-instagram {
    background-color: #a1755c;
}
.social-icons .fa {
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    color: #fff;
    color: rgba(255,255,255,.8);
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
}
.social-icons .fa {
    font-size: 1.8em;
}

.widget_nav_menu ul li:before {
    content: "\f105";
}

.site-info {
     text-align: right;
}
.site-search .widget_product_search form:before {
    top: 1em;
    left: 1.618em;
}

.site-search .widget_product_search input[type=search], .site-search .widget_product_search input[type=text] {
    padding: 1em 1.618em 1em 3.706325903em;
}

.main-navigation ul.menu>li>a, .main-navigation ul.nav-menu>li>a { padding: 0.7em 1.1em;}

.single #primary{width:100%;}
.single #secondary{display:none;}
.single #main span.onsale {display:none;}

@media screen and (min-width: 768px) {
	.blog.left-sidebar .content-area {width: 100%}

	/*Site Header*/
	.site-header { padding-top: 0; padding-bottom: 0;}

	/* LOGO */
	.site-header .site-branding { width: 70%; float: none; margin: 2em auto; clear: both; overflow:auto;}
	.site-header .site-branding img { max-width: 100%;}

	/*Primary Navigation width*/
	.woocommerce-active .site-header .main-navigation { width: 80%;}
	.woocommerce-active .site-header .site-header-cart { width: 15%;}


	/* SECONDARY NAVIGATION */
	.woocommerce-active .site-header .secondary-navigation {margin-left: -25%; padding-left: 25%; margin-right: -25%; padding-right: 25%; width: 150%; background-color: #333;}

	/* SEARCH BAR */
	.site-header .site-search { width: 100% !important; }

	/*Secondary Navigation a color*/
	.secondary-navigation ul.menu a {padding: 1.1em .875em; color: #d9d9d9; box-shadow: inset 1px 0 0 0 rgba(255,255,255,.1); background: #2c2d33;}

	/*Home page*/
	.page-template-template-homepage-php.left-sidebar .content-area#primary{width:100%}

	.storefront-primary-navigation {background-color: #333;margin-left:-2%; margin-right:0; padding-right:0; padding-left:0; width: 105%;}

	.site-header-cart .widget_shopping_cart, .main-navigation ul.menu ul.sub-menu, .main-navigation ul.nav-menu ul.children {
		background-color: #333;
	}
	
	.site-header-cart .widget_shopping_cart{padding-bottom:20px}
	.main-navigation ul.menu>li:first-child, .main-navigation ul.nav-menu>li:first-child { margin-left: 0em;}

}


				
 			</style>
 		<?php
 	//}
 }

/*
* add custom style
*/

add_action( 'wp_head', 'sf_child_theme_enqueue_custom_style' );

function sf_child_theme_enqueue_custom_style() {
	 wp_enqueue_style( 'storefront-childx-custom-style',  get_stylesheet_directory_uri().'/custom.css', '', null, 'all' );
}

/*remove ‘designed by WooThemes*/
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
