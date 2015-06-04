<?php

//* Remove post meta from archives
add_action ( 'genesis_entry_header', 'renergy_no_archive_post_meta' );
function renergy_no_archive_post_meta() {
	if ( is_archive() ) {
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
}

//* Remove the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Edit Read More links
add_filter( 'get_the_content_more_link', 'renergy_read_more_link' );
function renergy_read_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">Read More &raquo;</a>';
}

//* Load favicon. legacy, pulled from main functions.php
add_filter( 'genesis_pre_load_favicon', 'renergy_favicon' );
function renergy_favicon( $favicon_url ) {
	return get_stylesheet_directory_uri() . '/favicon.ico';
}

//* rm simple edits plugin: Customize some of the entry meta pre text
add_filter( 'genesis_post_meta', 'renergy_entry_meta_footer' );
function renergy_entry_meta_footer( $post_meta ) {
	$post_meta = '[post_categories before="Read other Articles on: "] [post_tags before="tags: "]';
	return $post_meta;
}

//* rm simple edits plugin: Footer customization
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'renergy_custom_footer' );
function renergy_custom_footer() {
?>
	<div class="two-thirds first">
		<p><a href="https://www.facebook.com/renergygreen" target="_blank" rel="me"><img src="<?php get_template_directory() . '/images/icon-facebook.png' ?>" /></a>
		<a href="https://www.linkedin.com/company/renergy-inc-" target="_blank" rel="me"><img src="<?php get_template_directory() . '/images/icon-linkedin.png' ?>" /></a>
		<a href="https://twitter.com/renergygreen" target="_blank" rel="me"><img src="<?php get_template_directory() . '/images/icon-twitter.png' ?>" /></a></p>
		<div class="creds"><p>Copyright &copy; <?php echo date('Y'); ?> Renergy, Inc</p></div>
		<div class="disclaimer">
			<p>Renergy partners with our customers to develop, implement and manage creative green energy solutions. With strategies for businesses, public sector entities, farmers and everyday people, we're excited to work with you to make the world a greener place.</p>
			<p><a href="/privacy-policy/">Privacy Policy</a> | <a href="/terms-of-use/">Terms of Use</a></p>
		</div>
	</div>
	<div class="awards one-third">
		<h5>Sign up for our Newsletter</h5>
		<form action="http://renergy.createsend.com/t/t/s/iilkhi/" method="post">
			<p>
			<label for="fieldEmail"></label>
			<input id="fieldEmail" placeholder="email address" name="cm-iilkhi-iilkhi" type="email" required />
			</p>
			<br/>
			<button type="submit">Sign Up</button>
		</form>
	</div>
<?php
}
