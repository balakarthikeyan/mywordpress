<?php
function GenerateSitemap($params = array()) {
	// default parameters
	extract(shortcode_atts(array(
		'title' => 'Site map',
		'id' => 'sitemap',
	    'depth' => 2
	), $params));

	// create sitemap
	$sitemap = wp_list_pages("title_li=&depth=$depth&sort_column=menu_order&echo=0");
	if ($sitemap != '') {
		$sitemap =
			($title == '' ? '' : "<h2>$title</h2>") .
			'<ul' . ($id == '' ? '' : ' id="'.$id.'"') . '>'.$sitemap.'</ul>';
	}
	return $sitemap;
}
add_shortcode('sitemap', 'GenerateSitemap');
// [sitemap id='deepmap',depth=5]

function StyleText($params, $content = null) {

	// default parameters
	extract(shortcode_atts(array(
		'style' => ''
	), $params));

    return '<span' . ($style == '' ? '' : ' style="'.$style.'"') . '>'.$content.'</span>';

}
add_shortcode('format','StyleText');

function dotibutton_function( $atts = array(), $content = null ) {
  
    // set up default parameters
    extract(shortcode_atts(array(
     'link' => '#'
    ), $atts));
    
    return '<a href="'. $link .'" target="blank" class="doti-button">' . $content . '</a>';
}
add_shortcode('dotibutton', 'dotibutton_function');

// [dotibutton link="/bits-bytes/"]Shop Now![/dotibutton]
// [format style="font-size:1.5em;color:#f00;">Important![/format]

function youtube($atts) {
	extract(shortcode_atts(array(
		"value" => 'http://',
		"width" => '475',
		"height" => '350',
		"name"=> 'movie',
		"allowFullScreen" => 'true',
		"allowScriptAccess"=>'always',
		"controls"=> '1',
	), $atts));
	return '<object style="height: '.$height.'px; width: '.$width.'px"><param name="'.$name.'" value="'.$value.'"><param name="allowFullScreen" value="'.$allowFullScreen.'"><param name="allowScriptAccess" value="'.$allowScriptAccess.'"><embed src="'.$value.'" type="application/x-shockwave-flash" allowfullscreen="'.$allowFullScreen.'" allowScriptAccess="'.$allowScriptAccess.'" width="'.$width.'" height="'.$height.'"></object>';
}
add_shortcode("youtube", "youtube");
// Optional attributes: width, height, name, allowFullScreen, allowScriptAccess, controls  
// [youtube value="http://www.youtube.com/watch?v=1aBSPn2P9bg"]

function donate_shortcode( $atts, $content = null) {
    global $post;extract(shortcode_atts(array(
        'account' => 'your-paypal-email-address',
        'for' => $post->post_title,
        'onHover' => '',
    ), $atts));
    
    if(empty($content)) {
        $content='Make A Donation';
    }
    
    return '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business='.$account.'&item_name=Donation for '.$for.'" title="'.$onHover.'">'.$content.'</a>';
}
add_shortcode('donate', 'donate_shortcode');
// [donate account="you@yoursite.com" onHover="Thanks" for="Title"]Donate Now[/donate]

(function() {
	tinymce.create('tinymce.plugins.recentposts', {
	   init : function(ed, url) {
		  ed.addButton('recentposts', {
			 title : 'Recent posts',
			 image : url+'/recentpostsbutton.png',
			 onclick : function() {
				var posts = prompt("Number of posts", "1");
				var text = prompt("List Heading", "This is the heading text");
 
				if (text != null && text != ’){
				   if (posts != null && posts != ’)
					  ed.execCommand('mceInsertContent', false, '[recent-posts posts="'+posts+'"]'+text+'[/recent-posts]');
				   else
					  ed.execCommand('mceInsertContent', false, '[recent-posts]'+text+'[/recent-posts]');
				}
				else{
				   if (posts != null && posts != ’)
					  ed.execCommand('mceInsertContent', false, '[recent-posts posts="'+posts+'"]');
				   else
					  ed.execCommand('mceInsertContent', false, '[recent-posts]');
				}
			 }
		  });
	   },
	   createControl : function(n, cm) {
		  return null;
	   },
	   getInfo : function() {
		  return {
			 longname : "Recent Posts",
			 author : 'Konstantinos Kouratoras',
			 authorurl : 'http://www.kouratoras.gr',
			 infourl : ’,
			 version : "1.0"
		  };
	   }
	});
	tinymce.PluginManager.add('recentposts', tinymce.plugins.recentposts);
 })();


 function register_button( $buttons ) {
	array_push( $buttons, "|", "recentposts" );
	return $buttons;
 }

 function add_plugin( $plugin_array ) {
	$plugin_array['recentposts'] = get_template_directory_uri() . '/js/recent-posts.js';
	return $plugin_array;
 }

 function my_recent_posts_button() {

	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
	   return;
	}
 
	if ( get_user_option('rich_editing') == 'true' ) {
	   add_filter( 'mce_external_plugins', 'add_plugin' );
	   add_filter( 'mce_buttons', 'register_button' );
	}
 
 }

 add_action('init', 'my_recent_posts_button');

 function menu_function($atts, $content = null) {
	extract(
	   shortcode_atts(
		  array( 'name' => null, ),
		  $atts
	   )
	);
	return wp_nav_menu(
	   array(
		   'menu' => $name,
		   'echo' => false
		   )
	);
 }
 add_shortcode('menu', 'menu_function');

 function googlemap_function($atts, $content = null) {
	extract(shortcode_atts(array(
	   "width" => '640',
	   "height" => '480',
	   "src" => ’
	), $atts));
	return '<iframe width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" ></iframe>';
 }
 add_shortcode("googlemap", "googlemap_function");
//  [googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]

function chart_function( $atts ) {
	extract(shortcode_atts(array(
		'data' => '',
		'chart_type' => 'pie',
		'title' => 'Chart',
		'labels' => '',
		'size' => '640x480',
		'background_color' => 'FFFFFF',
		'colors' => '',
	), $atts));
 
	switch ($chart_type) {
	   case 'line' :
		  $chart_type = 'lc';
		  break;
	   case 'pie' :
		  $chart_type = 'p3';
		  break;
	   default :
		  break;
	}
 
	$attributes = ''                                                                           ;
	$attributes .= '&chd=t:'.$data;
	$attributes .= '&chtt='.$title;
	$attributes .= '&chl='.$labels;
	$attributes .= '&chs='.$size;
	$attributes .= '&chf='.$background_color;
	$attributes .= '&chco='.$colors;
 
	return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$chart_type.$attributes.'" alt="'.$title.'" />';
}
add_shortcode('chart', 'chart_function');
// [chart type="pie" title="Example Pie Chart" data="41.12,32.35,21.52,5.01" labels="First+Label|Second+Label|Third+Label|Fourth+Label" background_color="FFFFFF" colors="D73030,329E4A,415FB4,DFD32F" size="450x180"]