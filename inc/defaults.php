<?php
/**
 * Fallback content.
 *
 * These values are used whenever a field has not been filled in yet (or when
 * SCF/ACF is not installed), so the theme never renders an empty header,
 * footer or homepage.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * The full defaults map.
 *
 * @return array<string, mixed>
 */
function tfh_defaults() {
	$defaults = array(
		// ------------------------------------------------------------------
		// Header - top bar.
		// ------------------------------------------------------------------
		'header_topbar_enable'    => true,
		'header_topbar_cta'       => array(
			'title'  => __( 'Book Now', 'tank-free-home' ),
			'url'    => '#appointment',
			'target' => '',
		),
		'header_topbar_socials'   => array(),

		// Header - branding & layout.
		'header_logo'            => '',
		'header_logo_height'     => 40,
		'header_style'           => 'solid',
		'header_cta_enable'      => true,
		'header_cta_link'        => array(
			'title'  => __( 'Book Now', 'tank-free-home' ),
			'url'    => '#appointment',
			'target' => '',
		),

		// ------------------------------------------------------------------
		// Footer - CTA band.
		// ------------------------------------------------------------------
		'footer_cta_enable'      => true,
		'footer_cta_eyebrow'     => __( 'Call To Action', 'tank-free-home' ),
		'footer_cta_title'       => __( 'Ready to Upgrade Your Hot Water?', 'tank-free-home' ),
		'footer_cta_text'        => __( 'Get a professional tankless water heater service designed for dependable performance, improved efficiency, and more usable space.', 'tank-free-home' ),
		'footer_cta_phone_note'  => __( '24/7 Customer Support for tankless water heater questions and service assistance.', 'tank-free-home' ),
		'footer_cta_button'      => array(
			'title'  => __( 'Get Started', 'tank-free-home' ),
			'url'    => '#appointment',
			'target' => '',
		),

		// Footer - brand column.
		'footer_logo'             => '',
		'footer_logo_height'      => 46,
		'footer_about'            => __( 'Reliable tankless water heater installation, replacement, repair, and maintenance for lasting home comfort.', 'tank-free-home' ),
		'footer_socials'          => array(
			array(
				'social_url'   => '#',
				'social_icon'  => 'x',
				'social_label' => 'X (Twitter)',
			),
			array(
				'social_url'   => '#',
				'social_icon'  => 'instagram',
				'social_label' => 'Instagram',
			),
			array(
				'social_url'   => '#',
				'social_icon'  => 'youtube',
				'social_label' => 'YouTube',
			),
		),

		// Footer - navigation links.
		'footer_links_title'   => __( 'Navigation', 'tank-free-home' ),
		'footer_links_source'  => 'manual',
		'footer_links'         => array(
			array( 'link' => array( 'title' => __( 'Home', 'tank-free-home' ), 'url' => home_url( '/' ), 'target' => '' ) ),
			array( 'link' => array( 'title' => __( 'About Us', 'tank-free-home' ), 'url' => tfh_url_by_template( 'page-about.php' ) ? tfh_url_by_template( 'page-about.php' ) : '#about', 'target' => '' ) ),
			array( 'link' => array( 'title' => __( 'Our Services', 'tank-free-home' ), 'url' => tfh_url_by_template( 'page-services.php' ) ? tfh_url_by_template( 'page-services.php' ) : '#services', 'target' => '' ) ),
			array( 'link' => array( 'title' => __( 'Projects', 'tank-free-home' ), 'url' => home_url( '/#projects' ), 'target' => '' ) ),
			array( 'link' => array( 'title' => __( 'Contact Us', 'tank-free-home' ), 'url' => tfh_url_by_template( 'page-contact.php' ) ? tfh_url_by_template( 'page-contact.php' ) : '#appointment', 'target' => '' ) ),
		),

		// Footer - services.
		'footer_services_title' => __( 'Services', 'tank-free-home' ),
		'footer_services'       => array(
			array( 'link' => array( 'title' => __( 'Tankless Installation', 'tank-free-home' ), 'url' => '#services', 'target' => '' ) ),
			array( 'link' => array( 'title' => __( 'System Replacement', 'tank-free-home' ), 'url' => '#services', 'target' => '' ) ),
			array( 'link' => array( 'title' => __( 'Tankless Repair', 'tank-free-home' ), 'url' => '#services', 'target' => '' ) ),
			array( 'link' => array( 'title' => __( 'Maintenance & Flushing', 'tank-free-home' ), 'url' => '#services', 'target' => '' ) ),
		),

		// Footer - contact column.
		'footer_contact_title' => __( 'Contact Us', 'tank-free-home' ),
		'footer_contact_text'  => __( 'Our Support and Sales team are available 24/7 to answer your questions.', 'tank-free-home' ),
		'footer_show_phone'    => true,
		'footer_show_email'    => false,
		'footer_show_address'  => true,

		// Footer - bottom bar.
		'footer_copyright'     => '© {year} {sitename}. ' . __( 'All Rights Reserved', 'tank-free-home' ),
		'footer_legal_links'   => array(
			array( 'link' => array( 'title' => __( 'Terms of Use', 'tank-free-home' ), 'url' => '#terms', 'target' => '' ) ),
			array(
				'link' => array(
					'title'  => __( 'Privacy Policy', 'tank-free-home' ),
					'url'    => tfh_url_by_template( 'page-privacy.php' ) ? tfh_url_by_template( 'page-privacy.php' ) : '#privacy',
					'target' => '',
				),
			),
		),

		// ------------------------------------------------------------------
		// Brand & Contact.
		// ------------------------------------------------------------------
		'brand_phone'   => '+1 (000) 000-0000',
		'brand_email'   => 'hi@tankfreehome.com',
		'brand_address' => "123 Main St, Suite 500\nNew York, NY 10001",
		'brand_map_url' => '',
		'brand_hours'   => __( 'Mon–Sat, 8am–7pm', 'tank-free-home' ),

		// ------------------------------------------------------------------
		// Homepage sections (page-homepage.php).
		// ------------------------------------------------------------------

		// Hero.
		'hero_enable'  => true,
		'hero_eyebrow' => '',
		'hero_title'   => __( 'Tankless Hot Water You Can Rely On', 'tank-free-home' ),
		'hero_text'    => __( 'Upgrade to a compact, energy-efficient tankless water heater for dependable hot water, more usable space, and everyday comfort.', 'tank-free-home' ),
		'hero_image'   => '',
		'hero_button'  => array(
			'title'  => __( 'Get Started', 'tank-free-home' ),
			'url'    => '#appointment',
			'target' => '',
		),
		'hero_stats'   => array(
			array( 'value' => '1200+', 'label' => __( 'Happy Customer', 'tank-free-home' ) ),
			array( 'value' => '600+', 'label' => __( 'Work Completed', 'tank-free-home' ) ),
		),

		// About.
		'about_enable'          => true,
		'about_image'           => '',
		'about_eyebrow'         => __( 'About Us', 'tank-free-home' ),
		'about_title'           => __( 'Your Trusted Partner in Tankless Water Heating', 'tank-free-home' ),
		'about_title_highlight' => 2,
		'about_features'        => array(
			array(
				'icon'  => '',
				'title' => __( 'Proven Expertise', 'tank-free-home' ),
				'text'  => __( 'Experienced professionals delivering reliable tankless water heater installation, replacement, and maintenance.', 'tank-free-home' ),
			),
			array(
				'icon'  => '',
				'title' => __( 'Fast, Dependable Service', 'tank-free-home' ),
				'text'  => __( 'We complete every project efficiently while maintaining high standards of safety and workmanship.', 'tank-free-home' ),
			),
			array(
				'icon'  => '',
				'title' => __( 'Honest, Upfront Pricing', 'tank-free-home' ),
				'text'  => __( 'Clear estimates and straightforward recommendations with no hidden fees or unnecessary services.', 'tank-free-home' ),
			),
		),

		// Expertise.
		'expertise_enable'          => true,
		'expertise_eyebrow'         => __( 'Expertise', 'tank-free-home' ),
		'expertise_title'           => __( 'Expertise in Tankless Water Heating', 'tank-free-home' ),
		'expertise_title_highlight' => 0,
		'expertise_image'           => '',
		'expertise_badge_value'     => '468+',
		'expertise_badge_label'     => __( 'Tankless Systems Installed', 'tank-free-home' ),
		'expertise_badge_text'      => __( 'Professional tankless water heater solutions designed for dependable performance, improved efficiency, and lasting home comfort.', 'tank-free-home' ),
		'expertise_items'           => array(
			array( 'label' => __( 'Tankless Installation', 'tank-free-home' ), 'percent' => 95 ),
			array( 'label' => __( 'System Replacement', 'tank-free-home' ), 'percent' => 88 ),
			array( 'label' => __( 'Repair & Diagnostics', 'tank-free-home' ), 'percent' => 80 ),
			array( 'label' => __( 'Maintenance & Flushing', 'tank-free-home' ), 'percent' => 75 ),
		),

		// Services.
		'services_enable'          => true,
		'services_eyebrow'         => __( 'Our Services', 'tank-free-home' ),
		'services_title'           => __( 'Reliable Tankless Water Heater Services We Provide', 'tank-free-home' ),
		'services_title_highlight' => 0,
		'services_count'           => 6,
		'services_category'        => '',

		// Why choose us.
		'why_enable'          => true,
		'why_eyebrow'         => __( 'Why Choose Us', 'tank-free-home' ),
		'why_title'           => __( 'Your Best Choice for Tankless Water Heating', 'tank-free-home' ),
		'why_title_highlight' => 0,
		'why_badge_value'     => '25+',
		'why_badge_label'     => __( 'Years of Experience', 'tank-free-home' ),
		'why_image'           => '',
		'why_items'           => array(
			array(
				'icon'  => 'award',
				'title' => __( 'Specialized Expertise', 'tank-free-home' ),
				'text'  => __( 'Experienced professionals focused on tankless water heater installation, replacement, repair, and maintenance.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'shield-check',
				'title' => __( 'Quality Workmanship', 'tank-free-home' ),
				'text'  => __( 'Every system is installed carefully for safe operation, reliable performance, and long-term comfort.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'tag',
				'title' => __( 'Transparent Pricing', 'tank-free-home' ),
				'text'  => __( 'Receive clear recommendations and upfront estimates without hidden fees or unnecessary costs.', 'tank-free-home' ),
			),
		),

		// Projects.
		'projects_enable'          => true,
		'projects_eyebrow'         => __( 'Projects', 'tank-free-home' ),
		'projects_title'           => __( 'Latest Tankless Projects', 'tank-free-home' ),
		'projects_title_highlight' => 0,
		'projects_text'            => __( 'Explore recent tankless water heater installations and upgrades completed to save space, improve efficiency, and deliver dependable hot water.', 'tank-free-home' ),
		'projects_button'          => array(
			'title'  => __( 'See All', 'tank-free-home' ),
			'url'    => '#projects',
			'target' => '',
		),
		'projects_count'           => 3,

		// Testimonials.
		'testimonials_enable'          => true,
		'testimonials_eyebrow'         => __( 'Testimonials', 'tank-free-home' ),
		'testimonials_title'           => __( 'What They Say About Us', 'tank-free-home' ),
		'testimonials_title_highlight' => 0,
		'testimonials_count'           => 6,

		// ------------------------------------------------------------------
		// About page.
		// ------------------------------------------------------------------
		'about_header_subtitle'        => __( 'Your trusted local team for tankless water heater installation, replacement, repair, and maintenance.', 'tank-free-home' ),

		// About - Our Story.
		'about_story_enable'           => true,
		'about_story_eyebrow'          => __( 'Our Story', 'tank-free-home' ),
		'about_story_title'            => __( 'Built on Reliable Tankless Expertise', 'tank-free-home' ),
		'about_story_title_highlight'  => 0,
		'about_story_text'             => __( "Tank Free Home was founded to give homeowners a better alternative to bulky, inefficient tank water heaters. What started as a small team of licensed technicians has grown into a trusted name for tankless installation, replacement, and repair across the region.\n\nToday, we combine hands-on craftsmanship with honest guidance, helping every customer choose the right system for their home and budget, then standing behind the work long after the install is complete.", 'tank-free-home' ),
		'about_story_image'            => '',

		// About - Trust stats.
		'about_stats_enable'           => true,
		'about_stats_eyebrow'          => __( 'Our Track Record', 'tank-free-home' ),
		'about_stats_title'            => __( 'Trusted by Homeowners Across the Region', 'tank-free-home' ),
		'about_stats_title_highlight'  => 0,
		'about_stats_items'            => array(
			array( 'value' => '25+', 'label' => __( 'Years of Experience', 'tank-free-home' ) ),
			array( 'value' => '1,200+', 'label' => __( 'Happy Customers', 'tank-free-home' ) ),
			array( 'value' => '4.7', 'label' => __( 'Average Star Rating', 'tank-free-home' ) ),
		),

		// About - Values.
		'about_values_enable'          => true,
		'about_values_eyebrow'         => __( 'Our Values', 'tank-free-home' ),
		'about_values_title'           => __( 'The Values Behind Every Job', 'tank-free-home' ),
		'about_values_title_highlight' => 0,
		'about_values_intro'           => __( 'The principles that guide every visit, from the first estimate to the final walkthrough.', 'tank-free-home' ),
		'about_values_items'           => array(
			array(
				'icon'  => 'shield-check',
				'title' => __( 'Honesty First', 'tank-free-home' ),
				'text'  => __( "We give straightforward recommendations and transparent pricing, never pushing work you don't need.", 'tank-free-home' ),
			),
			array(
				'icon'  => 'tool',
				'title' => __( 'Quality Workmanship', 'tank-free-home' ),
				'text'  => __( 'Every installation is built to code and tested thoroughly, so your system runs safely for years to come.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'home',
				'title' => __( 'Respect for Your Home', 'tank-free-home' ),
				'text'  => __( 'We treat every property with care, protecting floors and finishes and cleaning up before we leave.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'clock',
				'title' => __( 'Reliability', 'tank-free-home' ),
				'text'  => __( "When we say we'll be there, we're there, with clear communication from the first call to the final check.", 'tank-free-home' ),
			),
		),

		// About - Credentials.
		'about_credentials_enable'     => true,
		'about_credentials_eyebrow'    => __( 'Licensed & Insured', 'tank-free-home' ),
		'about_credentials_title'      => __( 'Peace of Mind on Every Project', 'tank-free-home' ),
		'about_credentials_title_highlight' => 0,
		'about_credentials_items'      => array(
			array(
				'icon'  => 'shield',
				'title' => __( 'Licensed & Insured', 'tank-free-home' ),
				'text'  => __( 'Fully licensed and insured for residential and light-commercial tankless water heater work.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'award',
				'title' => __( 'Certified Technicians', 'tank-free-home' ),
				'text'  => __( 'Our team completes ongoing manufacturer training to install and service the latest tankless systems.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'calendar-check',
				'title' => __( 'Warranty-Backed Installs', 'tank-free-home' ),
				'text'  => __( "Every installation is backed by a workmanship warranty in addition to the manufacturer's coverage.", 'tank-free-home' ),
			),
			array(
				'icon'  => 'map-pin',
				'title' => __( 'Locally Owned & Operated', 'tank-free-home' ),
				'text'  => __( "A local team that knows the area's codes, water conditions, and homes inside and out.", 'tank-free-home' ),
			),
		),

		// ------------------------------------------------------------------
		// Contact page.
		// ------------------------------------------------------------------
		'contact_header_subtitle'      => __( "Questions about tankless water heaters or ready to book a service? Reach out and we'll get back to you shortly.", 'tank-free-home' ),

		'contact_info_enable'          => true,

		'contact_form_enable'          => true,
		'contact_form_eyebrow'         => __( 'Get In Touch', 'tank-free-home' ),
		'contact_form_title'           => __( 'Send Us a Message', 'tank-free-home' ),
		'contact_form_title_highlight' => 0,
		'contact_form_text'            => __( "Fill out the form and a member of our team will follow up to schedule your service or answer any questions.", 'tank-free-home' ),

		// ------------------------------------------------------------------
		// FAQ page.
		// ------------------------------------------------------------------
		'faq_header_subtitle'       => __( 'Answers to the questions we hear most about tankless water heater installation, repair, and maintenance.', 'tank-free-home' ),

		// FAQ - Questions.
		'faq_list_enable'           => true,
		'faq_list_eyebrow'          => __( 'FAQ', 'tank-free-home' ),
		'faq_list_title'            => __( 'Frequently Asked Questions', 'tank-free-home' ),
		'faq_list_title_highlight'  => 0,
		'faq_list_intro'            => __( "Can't find what you're looking for? Reach out and we're happy to help.", 'tank-free-home' ),
		'faq_categories'            => array(
			array(
				'category_name' => __( 'General Questions', 'tank-free-home' ),
				'questions'     => array(
					array(
						'question' => __( 'What is a tankless water heater and how is it different from a tank system?', 'tank-free-home' ),
						'answer'   => __( 'A tankless water heater warms water on demand as it flows through the unit instead of storing and reheating a tank of water around the clock. That means an endless supply of hot water, a smaller footprint, and lower standby energy costs.', 'tank-free-home' ),
					),
					array(
						'question' => __( 'Will a tankless system provide enough hot water for my whole home?', 'tank-free-home' ),
						'answer'   => __( "Yes. We size every system to your household's peak demand, whether that's a single bathroom or multiple showers and appliances running at once, so you always have dependable hot water.", 'tank-free-home' ),
					),
				),
			),
			array(
				'category_name' => __( 'Installation & Costs', 'tank-free-home' ),
				'questions'     => array(
					array(
						'question' => __( 'How long does a typical installation take?', 'tank-free-home' ),
						'answer'   => __( 'Most residential installations are completed in a single day. Replacing an existing tank system is usually quicker, while new gas or electrical work can add extra time. We will confirm a timeline before we start.', 'tank-free-home' ),
					),
					array(
						'question' => __( 'How much does a tankless water heater installation cost?', 'tank-free-home' ),
						'answer'   => __( 'Cost depends on the unit size, fuel type, and whether any gas, venting, or electrical upgrades are needed. We provide a clear, upfront estimate after a quick assessment of your home, with no hidden fees.', 'tank-free-home' ),
					),
					array(
						'question' => __( 'Can you replace my existing tank water heater with a tankless system?', 'tank-free-home' ),
						'answer'   => __( "Absolutely, replacing an old tank unit is one of our most common jobs. We'll evaluate your existing gas line, venting, and electrical setup and handle any upgrades needed for a safe, code-compliant install.", 'tank-free-home' ),
					),
				),
			),
			array(
				'category_name' => __( 'Maintenance & Support', 'tank-free-home' ),
				'questions'     => array(
					array(
						'question' => __( 'How often does a tankless water heater need maintenance?', 'tank-free-home' ),
						'answer'   => __( 'We recommend a flush and inspection once a year to clear mineral buildup and keep the unit running efficiently, more often if you have hard water. Regular maintenance also protects your warranty coverage.', 'tank-free-home' ),
					),
					array(
						'question' => __( 'Do you offer emergency repair services?', 'tank-free-home' ),
						'answer'   => __( 'Yes, our team is available for urgent repairs when your hot water goes out unexpectedly. Give us a call and we will get a technician out to diagnose and fix the issue as quickly as possible.', 'tank-free-home' ),
					),
					array(
						'question' => __( 'Do your installations come with a warranty?', 'tank-free-home' ),
						'answer'   => __( "Every installation is backed by our workmanship warranty in addition to the manufacturer's coverage on the unit itself, so you're protected long after the job is done.", 'tank-free-home' ),
					),
				),
			),
		),

		// ------------------------------------------------------------------
		// Privacy Policy page.
		// ------------------------------------------------------------------
		'privacy_header_subtitle' => __( 'Effective Date: August 25, 2026', 'tank-free-home' ),
		'privacy_intro'           => __( 'This Privacy Policy explains how Tank Free Home ("we", "us", "our") collects, uses, and protects information when you visit our website, call or text us, submit a form, or request tankless water heater installation, replacement, repair, or maintenance service from us.', 'tank-free-home' ),
		'privacy_sections'        => array(
			array(
				'heading' => __( 'Overview', 'tank-free-home' ),
				'body'    => __( 'This policy applies to information collected through our website, phone calls, text messages, online forms, and any service interactions with Tank Free Home. By using our site or requesting service, you agree to the practices described below.', 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Information We Collect', 'tank-free-home' ),
				'body'    => __( "We may collect: contact information (name, service address, phone number, email); service details (property details, appliance information, appointment and service history); communication records (calls, texts, emails, and form submissions); and technical data collected automatically, such as your IP address, browser type, and pages visited on our website.", 'tank-free-home' ),
			),
			array(
				'heading' => __( 'How We Use Your Information', 'tank-free-home' ),
				'body'    => __( "We use your information to schedule and provide service, respond to inquiries and prepare estimates, send appointment reminders and service updates, send promotional offers only where you have opted in, and comply with legal, safety, and licensing obligations. We do not sell your personal information.", 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Text Messaging & Mobile Information (A2P / 10DLC)', 'tank-free-home' ),
				'body'    => __( 'If you opt in to receive text messages from us, such as appointment reminders or service updates, message and data rates may apply. Mobile opt-in information and phone numbers collected for texting purposes are never shared or sold to third parties or affiliates for marketing purposes.', 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Consent, Opt-Out & Help', 'tank-free-home' ),
				'body'    => __( 'By providing your phone number, you consent to receive calls and text messages related to your service request. Reply STOP at any time to opt out of text messages, or reply HELP for assistance. You may also contact us directly to update your communication preferences.', 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Cookies & Analytics', 'tank-free-home' ),
				'body'    => __( 'Our website uses cookies and similar technologies to remember your preferences and understand how visitors use our site. We may use third-party analytics tools to help us improve our website and services. You can control or disable cookies through your browser settings.', 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Information Sharing', 'tank-free-home' ),
				'body'    => __( 'We share information only with trusted vendors and subcontractors who help us deliver our services, when required by law or to protect our rights, or as part of a business transfer such as a merger or acquisition. We do not sell your personal information to third parties.', 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Data Security', 'tank-free-home' ),
				'body'    => __( 'We use reasonable administrative, technical, and physical safeguards to protect your information. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.', 'tank-free-home' ),
			),
			array(
				'heading' => __( "Children's Privacy", 'tank-free-home' ),
				'body'    => __( 'Our website and services are not directed to individuals under the age of 13, and we do not knowingly collect personal information from children.', 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Your Privacy Rights', 'tank-free-home' ),
				'body'    => __( 'We proudly serve customers in Oregon, Washington, Florida, and California. Depending on where you live, you may have rights under applicable state privacy laws, including the California Consumer Privacy Act (CCPA) and privacy laws in Oregon, Washington, and Florida, such as the right to access, correct, or request deletion of your personal information. To exercise these rights, contact us using the information below.', 'tank-free-home' ),
			),
			array(
				'heading' => __( 'Updates to This Policy', 'tank-free-home' ),
				'body'    => __( 'We may update this Privacy Policy from time to time to reflect changes in our practices or for legal reasons. The updated version will be posted on this page along with a new effective date.', 'tank-free-home' ),
			),
		),

		// ------------------------------------------------------------------
		// Service Listing page.
		// ------------------------------------------------------------------
		'services_header_subtitle'   => __( 'Browse our full range of tankless water heater installation, replacement, repair, and maintenance services.', 'tank-free-home' ),

		'services_listing_enable'    => true,
		'services_listing_per_page'  => 6,

		// Service Listing - Our Process.
		'process_enable'             => true,
		'process_eyebrow'            => __( 'Our Process', 'tank-free-home' ),
		'process_title'              => __( 'How It Works', 'tank-free-home' ),
		'process_title_highlight'    => 0,
		'process_intro'              => __( 'A simple, straightforward process from your first call to a finished installation.', 'tank-free-home' ),
		'process_steps'              => array(
			array(
				'icon'  => 'phone',
				'title' => __( 'Contact & Consultation', 'tank-free-home' ),
				'text'  => __( "Reach out by phone, text, or our online form and tell us about your hot water needs.", 'tank-free-home' ),
			),
			array(
				'icon'  => 'calendar-check',
				'title' => __( 'Free On-Site Estimate', 'tank-free-home' ),
				'text'  => __( "We'll assess your home and provide a clear, upfront quote with no hidden fees.", 'tank-free-home' ),
			),
			array(
				'icon'  => 'tool',
				'title' => __( 'Professional Installation', 'tank-free-home' ),
				'text'  => __( 'Our licensed technicians complete the job safely and efficiently, often in a single day.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'shield-check',
				'title' => __( 'Final Walkthrough & Support', 'tank-free-home' ),
				'text'  => __( 'We test the system, walk you through operation and maintenance, and stay available for any follow-up needs.', 'tank-free-home' ),
			),
		),

		// ------------------------------------------------------------------
		// Location page (seeded with California content).
		// ------------------------------------------------------------------
		'location_header_subtitle'          => __( 'Licensed, code-compliant tankless water heater installation, repair, and maintenance for homeowners across California, backed by a local team that shows up when it says it will.', 'tank-free-home' ),

		// Location - Trust stats.
		'location_stats_enable'             => true,
		'location_stats_eyebrow'            => __( 'Local Track Record', 'tank-free-home' ),
		'location_stats_title'              => __( 'Trusted Across California', 'tank-free-home' ),
		'location_stats_title_highlight'    => 0,
		'location_stats_items'              => array(
			array( 'value' => '15+', 'label' => __( 'Years Serving California', 'tank-free-home' ) ),
			array( 'value' => '900+', 'label' => __( 'Jobs Completed in State', 'tank-free-home' ) ),
			array( 'value' => '4.9', 'label' => __( 'Average Rating', 'tank-free-home' ) ),
		),

		// Location - Local Insight.
		'location_insights_enable'          => true,
		'location_insights_eyebrow'         => __( 'Local Insight', 'tank-free-home' ),
		'location_insights_title'           => __( 'What California Homes Need', 'tank-free-home' ),
		'location_insights_title_highlight' => 0,
		'location_insights_intro'           => __( 'A few things we see often when working on tankless systems across the state.', 'tank-free-home' ),
		'location_insights_items'           => array(
			array(
				'icon'  => 'thermometer',
				'title' => __( 'Title 24 Energy Code Compliance', 'tank-free-home' ),
				'text'  => __( "California's Title 24 energy standards affect which water heaters qualify for installation. We make sure every system we install is fully compliant.", 'tank-free-home' ),
			),
			array(
				'icon'  => 'droplet',
				'title' => __( 'Hard Water in Many Regions', 'tank-free-home' ),
				'text'  => __( 'Parts of the state have notably hard water, which speeds up mineral buildup. We recommend more frequent flushing to keep systems running efficiently.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'home',
				'title' => __( 'Older Homes Need Venting Upgrades', 'tank-free-home' ),
				'text'  => __( 'Many older homes need updated gas lines or venting to support a tankless system. We handle these upgrades as part of the installation.', 'tank-free-home' ),
			),
			array(
				'icon'  => 'inspection',
				'title' => __( 'Permit & Inspection Requirements', 'tank-free-home' ),
				'text'  => __( 'Most California cities require a permit and inspection for water heater installations. We handle the paperwork and coordinate the inspection for you.', 'tank-free-home' ),
			),
		),

		// Location - Service Area.
		'location_area_enable'              => true,
		'location_area_eyebrow'             => __( 'Service Area', 'tank-free-home' ),
		'location_area_title'               => __( 'Cities We Serve', 'tank-free-home' ),
		'location_area_title_highlight'     => 0,
		'location_area_cities'              => array(
			array( 'city' => __( 'Los Angeles', 'tank-free-home' ) ),
			array( 'city' => __( 'San Diego', 'tank-free-home' ) ),
			array( 'city' => __( 'Sacramento', 'tank-free-home' ) ),
			array( 'city' => __( 'San Jose', 'tank-free-home' ) ),
			array( 'city' => __( 'Fresno', 'tank-free-home' ) ),
			array( 'city' => __( 'Oakland', 'tank-free-home' ) ),
		),

		// Location - FAQ.
		'location_faq_enable'               => true,
		'location_faq_items'                => array(
			array(
				'question' => __( 'Do you offer same-day service in California?', 'tank-free-home' ),
				'answer'   => __( 'In most cases, yes. Give us a call and we will do our best to get a technician out the same day, especially for urgent repairs.', 'tank-free-home' ),
			),
			array(
				'question' => __( 'Are you licensed to work in California?', 'tank-free-home' ),
				'answer'   => __( 'Yes, we are fully licensed and insured to perform tankless water heater installation and repair work throughout the state.', 'tank-free-home' ),
			),
			array(
				'question' => __( 'Do I need a permit for a tankless water heater installation?', 'tank-free-home' ),
				'answer'   => __( 'Most California cities require a permit for water heater installations. We handle the permit application and coordinate the required inspection as part of the job.', 'tank-free-home' ),
			),
			array(
				'question' => __( 'Do you offer free estimates?', 'tank-free-home' ),
				'answer'   => __( "Yes. We'll assess your home and provide a clear, upfront quote before any work begins, with no obligation.", 'tank-free-home' ),
			),
		),
	);

	/**
	 * Filter the theme's default/fallback content map.
	 *
	 * @param array $defaults Default values, keyed by field name.
	 */
	return apply_filters( 'tfh_defaults', $defaults );
}

/**
 * Look up a single default value.
 *
 * @param string $selector Field name.
 * @return mixed Empty string when the key does not exist.
 */
function tfh_default( $selector ) {
	$defaults = tfh_defaults();

	return array_key_exists( $selector, $defaults ) ? $defaults[ $selector ] : '';
}
