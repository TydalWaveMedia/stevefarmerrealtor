<?php

defined( 'ABSPATH' ) or die( 'This plugin requires WordPress' );

?>
<div class="changelog point-releases">
	<h3>Maintenance and Security Releases</h3>
	<p><strong>Version 3.6</strong> Several bug fixes, added social media and preloading tags</p>
	<p><strong>Version 3.5.11.6</strong> Fixes recent new listings capabilities for some MLS's.</p>
	<p><strong>Version 3.5.11.5</strong> Fixes an issue where search parameters were not sending properly from the search widget.</p>
</div>
<div class="feature-section one-col flex-intro">
	<h2>Social Media Tags and Faster Listing Load Time</h2>
	<p class="lead-description">We&#8217;ve added some new tags to the listing summary and listing detail pages to help with faster load times and social media sharing.</p>
	<picture>
		<img src="<?php echo plugins_url( 'assets/images/about_banner_1.jpg', dirname( __FILE__ ) ); ?>" alt="FlexMLS IDX Plugin">
	</picture>
	<p><strong>What&#8217;s New?</strong> In version 3.6 we&#8217;ve added Open Graph tags to help social media sites to grab the listing photo and description from your site. We&#8217;ve also added some preloading tags to the listing summary and listing detail pages to preload the previous and next pages in the background. This will make the load time much faster for your site visitors while they&#8217;re viewing the listings.</p>
</div>
<hr />
<div class="changelog">
	<h2>Additional Updates &amp; Enhancements</h2>
	<div class="under-the-hood two-col">
		<div class="col">
			<h3>Bug Fixes:</h3>
			<ol>
				<li>Some sites using the IDX slideshow widget were not displaying the Beds, Baths, Sqft Fields.</li>
				<li>Updating the selection of a property sub-type in the IDX Search widget will now display the proper results.</li>
				<li>&#8220;Listing Not Available&#8221; &#8220;Mimic the contents of this page&#8221; setting will now save changes.</li>
				<li>IDX Listing Summary widget Display option for Open Houses fixed.</li>
				<li>Location Search field values in the short code generator repeating on some sites.</li>
				<li>Neighborhood widget titles printing <em>&#38;amp;</em> in front on some sites.</li>
				<li>Duplicate canonical tags printing when Yoast SEO is being used.</li>
			</ol>
		</div>
	</div>
</div>
