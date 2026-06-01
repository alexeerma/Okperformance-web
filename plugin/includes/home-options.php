<?php
/**
 * OKPerformance Home page options.
 *
 * @package OKPerformance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the homepage settings schema grouped by admin section.
 *
 * @return array<string, array<string, mixed>>
 */
function okperformance_home_get_settings_sections() {
	return array(
		'hero'     => array(
			'title'       => __( 'Hero', 'okperformance' ),
			'description' => __( 'Control the headline area and call-to-action content used at the top of the homepage.', 'okperformance' ),
			'fields'      => array(
				'hero_eyebrow'            => array(
					'label'        => __( 'Hero eyebrow', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Science-based training & premium nutrition',
					'translatable' => true,
				),
				'hero_title'              => array(
					'label'        => __( 'Hero title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'OK Performance',
					'translatable' => true,
				),
				'hero_subtitle'           => array(
					'label'        => __( 'Hero subtitle', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 4,
					'default'      => 'Build strength, improve endurance, and recover smarter with training plans, nutrition guidance, and an exclusive community.',
					'translatable' => true,
				),
				'hero_primary_cta_label'  => array(
					'label'        => __( 'Primary button label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Explore the program',
					'translatable' => true,
				),
				'hero_secondary_cta_label'=> array(
					'label'        => __( 'Secondary button label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'See products',
					'translatable' => true,
				),
			),
		),
		'about'    => array(
			'title'       => __( 'What We Do', 'okperformance' ),
			'description' => __( 'Shape the homepage introduction panel and the supporting highlight cards.', 'okperformance' ),
			'fields'      => array(
				'about_eyebrow'       => array(
					'label'        => __( 'Section eyebrow', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'What we do',
					'translatable' => true,
				),
				'about_title'         => array(
					'label'        => __( 'Section title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Coaching systems built for measurable progress',
					'translatable' => true,
				),
				'about_text'          => array(
					'label'        => __( 'Section text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 5,
					'default'      => 'OK Performance helps athletes train with clarity and consistency. We combine science-based programming, premium nutrition, and a supportive system so progress feels structured, motivating, and sustainable.',
					'translatable' => true,
				),
				'about_link_label'    => array(
					'label'        => __( 'Inline arrow link label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Read more',
					'translatable' => true,
				),
				'about_link_url'      => array(
					'label'        => __( 'Inline arrow link URL', 'okperformance' ),
					'type'         => 'url',
					'default'      => '',
					'placeholder'  => home_url( '/about-us/' ),
					'description'  => __( 'Leave empty to link automatically to the page using the About Us template.', 'okperformance' ),
					'translatable' => true,
				),
				'about_panel_eyebrow' => array(
					'label'        => __( 'Side panel eyebrow', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Built to convert',
					'translatable' => true,
				),
				'about_panel_title'   => array(
					'label'        => __( 'Side panel title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Premium coaching without generic templates',
					'translatable' => true,
				),
				'about_panel_text'    => array(
					'label'        => __( 'Side panel text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 4,
					'default'      => 'Every offer can be framed around outcomes, confidence, and long-term athlete development instead of one-size-fits-all plans.',
					'translatable' => true,
				),
				'about_card_1_title'  => array(
					'label'        => __( 'Card 1 title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Structured plans',
					'translatable' => true,
				),
				'about_card_1_text'   => array(
					'label'        => __( 'Card 1 text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'Workouts designed for progressive overload, energy management, and recovery that actually fits real life.',
					'translatable' => true,
				),
				'about_card_2_title'  => array(
					'label'        => __( 'Card 2 title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Nutrition support',
					'translatable' => true,
				),
				'about_card_2_text'   => array(
					'label'        => __( 'Card 2 text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'Guidance and product recommendations built around performance, body composition, and consistency goals.',
					'translatable' => true,
				),
				'about_card_3_title'  => array(
					'label'        => __( 'Card 3 title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Exclusive community',
					'translatable' => true,
				),
					'about_card_3_text'   => array(
						'label'        => __( 'Card 3 text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'Accountability, education, and a premium experience that keeps athletes engaged beyond the first month.',
						'translatable' => true,
					),
					'about_card_4_title'  => array(
						'label'        => __( 'Card 4 title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Recovery systems',
						'translatable' => true,
					),
					'about_card_4_text'   => array(
						'label'        => __( 'Card 4 text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'Recovery, check-ins, and sustainable pacing built into the coaching process so progress keeps compounding.',
						'translatable' => true,
					),
				),
			),
		'services' => array(
			'title'       => __( 'Services Section', 'okperformance' ),
			'description' => __( 'Manage the copy used around the Services cards pulled from the Services custom post type.', 'okperformance' ),
			'fields'      => array(
				'services_title'           => array(
					'label'        => __( 'Section title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Services',
					'translatable' => true,
				),
				'services_lede'            => array(
					'label'        => __( 'Section lead', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 4,
					'default'      => 'Choose the support you need, from tailored coaching and performance plans to nutrition guidance and recovery-focused systems.',
					'translatable' => true,
				),
				'services_link_label'      => array(
					'label'        => __( 'Archive link label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'View all services',
					'translatable' => true,
				),
				'services_card_link_label' => array(
					'label'        => __( 'Service card button label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Learn more',
					'translatable' => true,
				),
				'services_fallback_text'   => array(
					'label'        => __( 'Service card fallback text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'A tailored service designed to support your goals and long-term performance.',
					'translatable' => true,
				),
				'services_empty_text'      => array(
					'label'        => __( 'Empty state text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'No services have been published yet. Add Services in the WordPress admin and they will appear here automatically.',
					'translatable' => true,
				),
			),
		),
			'products' => array(
				'title'       => __( 'Products Section', 'okperformance' ),
				'description' => __( 'Manage the homepage product slider copy and the product source/query settings.', 'okperformance' ),
				'fields'      => array(
				'products_title'            => array(
					'label'        => __( 'Section title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Popular products',
					'translatable' => true,
				),
				'products_lede'             => array(
					'label'        => __( 'Section lead', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 4,
					'default'      => 'Use your WooCommerce products here - edit product IDs and text from the admin menu.',
					'translatable' => true,
				),
				'products_hint'             => array(
					'label'        => __( 'Slider hint text', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Use arrow buttons or scroll',
					'translatable' => true,
				),
				'products_view_label'       => array(
					'label'        => __( 'Product card button label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'View',
					'translatable' => true,
				),
				'products_add_to_cart_label' => array(
					'label'        => __( 'Product card add to cart label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Lisa ostukorvi',
					'translatable' => true,
				),
				'products_empty_text'       => array(
					'label'        => __( 'Empty state text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'No products are available for the homepage slider yet. Publish WooCommerce products and they will appear here automatically.',
					'translatable' => true,
				),
				'products_fallback_text'    => array(
					'label'        => __( 'Product description fallback', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'A premium performance product built for your training routine.',
					'translatable' => true,
				),
				'products_type_default'     => array(
					'label'        => __( 'Default product type label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Performance plan',
					'translatable' => true,
				),
				'products_type_athlete'     => array(
					'label'        => __( 'Athlete package label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Athlete package',
					'translatable' => true,
				),
				'products_type_gym'         => array(
					'label'        => __( 'Gym program label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Gym program',
					'translatable' => true,
				),
				'products_ids'              => array(
					'label'        => __( 'Product IDs (comma-separated)', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'placeholder'  => 'Example: 123,124,145',
					'default'      => '',
					'translatable' => false,
				),
				'products_limit'            => array(
					'label'        => __( 'Products limit', 'okperformance' ),
					'type'         => 'number',
					'default'      => 8,
					'min'          => 1,
					'max'          => 24,
					'translatable' => false,
				),
				'products_orderby'          => array(
					'label'        => __( 'Products order', 'okperformance' ),
					'type'         => 'select',
					'default'      => 'date',
					'items'        => array(
						'date'       => __( 'Newest', 'okperformance' ),
						'popularity' => __( 'Most popular', 'okperformance' ),
						'rating'     => __( 'Highest rating', 'okperformance' ),
						'price'      => __( 'Price: low to high', 'okperformance' ),
						'price-desc' => __( 'Price: high to low', 'okperformance' ),
						'featured'   => __( 'Featured only', 'okperformance' ),
						'sale'       => __( 'On sale', 'okperformance' ),
						'rand'       => __( 'Random', 'okperformance' ),
						'menu_order' => __( 'Menu order', 'okperformance' ),
					),
					'translatable' => false,
					),
				),
			),
			'team'         => array(
				'title'       => __( 'Meet the Team Section', 'okperformance' ),
				'description' => __( 'Manage the Meet the Team section shown on the homepage after the products section.', 'okperformance' ),
				'fields'      => array(
					'team_pill_label'        => array(
						'label'        => __( 'Section pill label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Meet the team',
						'translatable' => true,
					),
					'team_title'             => array(
						'label'        => __( 'Section title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'The two coaches behind every OKPerformance journey',
						'translatable' => true,
					),
					'team_lede'              => array(
						'label'        => __( 'Section text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Personal coaching from a small team. Every athlete works directly with the people building their plan.',
						'translatable' => true,
					),
					'team_cta_label'         => array(
						'label'        => __( 'Button label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Read our story',
						'translatable' => true,
					),
					'team_cta_url'           => array(
						'label'        => __( 'Button URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => home_url( '/about-us/' ),
						'description'  => __( 'Leave empty to link automatically to the page using the About Us template.', 'okperformance' ),
						'translatable' => true,
					),
					'team_person_1_name'     => array(
						'label'        => __( 'Person 1 name', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Coach One',
						'translatable' => true,
					),
					'team_person_1_role'     => array(
						'label'        => __( 'Person 1 role', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Performance coach',
						'translatable' => true,
					),
					'team_person_1_focus'    => array(
						'label'        => __( 'Person 1 focus label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Training systems',
						'translatable' => true,
					),
					'team_person_1_bio'      => array(
						'label'        => __( 'Person 1 bio', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 5,
						'default'      => 'Share the background, coaching style, and strengths of the first team member here. Keep it human, specific, and focused on the transformation clients can expect.',
						'translatable' => true,
					),
					'team_person_1_image_id' => array(
						'label'        => __( 'Person 1 image', 'okperformance' ),
						'type'         => 'media',
						'default'      => 0,
						'description'  => __( 'Upload or choose the portrait for the first person.', 'okperformance' ),
						'button_label' => __( 'Choose image', 'okperformance' ),
						'preview'      => 'image',
						'translatable' => false,
					),
					'team_person_1_image_alt' => array(
						'label'        => __( 'Person 1 image alt text', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Portrait of the first coach',
						'translatable' => true,
					),
					'team_person_2_name'     => array(
						'label'        => __( 'Person 2 name', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Coach Two',
						'translatable' => true,
					),
					'team_person_2_role'     => array(
						'label'        => __( 'Person 2 role', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Nutrition & performance coach',
						'translatable' => true,
					),
					'team_person_2_focus'    => array(
						'label'        => __( 'Person 2 focus label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Nutrition strategy',
						'translatable' => true,
					),
					'team_person_2_bio'      => array(
						'label'        => __( 'Person 2 bio', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 5,
						'default'      => 'Use this space for the second team member story, expertise, and the role they play in the client experience across training, nutrition, or accountability.',
						'translatable' => true,
					),
					'team_person_2_image_id' => array(
						'label'        => __( 'Person 2 image', 'okperformance' ),
						'type'         => 'media',
						'default'      => 0,
						'description'  => __( 'Upload or choose the portrait for the second person.', 'okperformance' ),
						'button_label' => __( 'Choose image', 'okperformance' ),
						'preview'      => 'image',
						'translatable' => false,
					),
					'team_person_2_image_alt' => array(
						'label'        => __( 'Person 2 image alt text', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Portrait of the second coach',
						'translatable' => true,
					),
				),
			),
				'faq'          => array(
					'title'       => __( 'FAQ', 'okperformance' ),
					'description' => __( 'Manage the KKK / FAQ section shown at the bottom of the homepage and in the assignable KKK page template.', 'okperformance' ),
					'fields'      => array(
					'faq_pill_label'      => array(
						'label'        => __( 'Pill label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'KKK',
						'translatable' => true,
					),
					'faq_title'           => array(
						'label'        => __( 'Section title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Korduma kippuvad küsimused',
						'translatable' => true,
					),
					'faq_lede'            => array(
						'label'        => __( 'Section lead', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Leia kiirelt vastused treeningute, pakettide, testimise ja OKPerformance koostöö kohta.',
						'translatable' => true,
					),
					'faq_panel_title'     => array(
						'label'        => __( 'Side panel title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Ei leidnud vastust?',
						'translatable' => true,
					),
					'faq_panel_text'      => array(
						'label'        => __( 'Side panel text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Kirjuta meile ja aitame sul valida sobiva paketi või leida järgmise sammu.',
						'translatable' => true,
					),
					'faq_panel_button_label' => array(
						'label'        => __( 'Side panel button label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Võta ühendust',
						'translatable' => true,
					),
					'faq_panel_button_url' => array(
						'label'        => __( 'Side panel button URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => home_url( '/contact/' ),
						'description'  => __( 'Leave empty to link automatically to the page using the Contact template.', 'okperformance' ),
						'translatable' => true,
					),
					'faq_empty_text'      => array(
						'label'        => __( 'Empty state text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'KKK küsimusi pole veel lisatud. Lisa küsimused Page Options > FAQ vahelehelt.',
						'translatable' => true,
					),
					'faq_item_1_question' => array(
						'label'        => __( 'Question 1', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Milline pakett mulle sobib?',
						'translatable' => true,
					),
					'faq_item_1_answer'   => array(
						'label'        => __( 'Answer 1', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Sobiv pakett sõltub sinu eesmärgist, treeningkogemusest ja sellest, kui palju tuge soovid. Kui sa pole kindel, võta meiega ühendust ja aitame valida kõige mõistlikuma alguspunkti.',
						'translatable' => true,
					),
					'faq_item_2_question' => array(
						'label'        => __( 'Question 2', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Kas teenused sobivad ainult sportlastele?',
						'translatable' => true,
					),
					'faq_item_2_answer'   => array(
						'label'        => __( 'Answer 2', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Ei. OKPerformance sobib kõigile, kes soovivad treenida süsteemselt, arendada üldkehalist võimekust ja saada selgemat plaani.',
						'translatable' => true,
					),
					'faq_item_3_question' => array(
						'label'        => __( 'Question 3', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Kuidas testimine toimub?',
						'translatable' => true,
					),
					'faq_item_3_answer'   => array(
						'label'        => __( 'Answer 3', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Testimise käigus hindame sinu hetketaset valitud mõõdikute põhjal. Pärast seda saad kokkuvõtte, visuaalse raporti ja soovitused edasiseks treeninguks.',
						'translatable' => true,
					),
					'faq_item_4_question' => array(
						'label'        => __( 'Question 4', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Kas treeningplaan on personaalne?',
						'translatable' => true,
					),
					'faq_item_4_answer'   => array(
						'label'        => __( 'Answer 4', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Jah. Plaan koostatakse sinu eesmärkide, taseme ja võimaluste põhjal, et treening oleks realistlik, järjepidev ja mõõdetav.',
						'translatable' => true,
					),
					'faq_item_5_question' => array(
						'label'        => __( 'Question 5', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Kas saan tuge ka pärast plaani kättesaamist?',
						'translatable' => true,
					),
					'faq_item_5_answer'   => array(
						'label'        => __( 'Answer 5', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Sõltuvalt paketist saad tagasisidet, konsultatsiooni või regulaarset suhtlust, et plaan ei jääks lihtsalt dokumendiks, vaid muutuks päriselt kasutatavaks süsteemiks.',
						'translatable' => true,
					),
					'faq_item_6_question' => array(
						'label'        => __( 'Question 6', 'okperformance' ),
						'type'         => 'text',
						'default'      => '',
						'translatable' => true,
					),
					'faq_item_6_answer'   => array(
						'label'        => __( 'Answer 6', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => '',
						'translatable' => true,
					),
					'faq_item_7_question' => array(
						'label'        => __( 'Question 7', 'okperformance' ),
						'type'         => 'text',
						'default'      => '',
						'translatable' => true,
					),
					'faq_item_7_answer'   => array(
						'label'        => __( 'Answer 7', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => '',
						'translatable' => true,
					),
					'faq_item_8_question' => array(
						'label'        => __( 'Question 8', 'okperformance' ),
						'type'         => 'text',
						'default'      => '',
						'translatable' => true,
					),
					'faq_item_8_answer'   => array(
						'label'        => __( 'Answer 8', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => '',
						'translatable' => true,
					),
				),
			),
			'contact_page' => array(
				'title'       => __( 'Contact Page', 'okperformance' ),
				'description' => __( 'Manage the assignable Contact page template, contact/company details, location note, and Contact Form 7 shortcode.', 'okperformance' ),
				'fields'      => array(
					'contact_details_title'   => array(
						'label'        => __( 'Contact details title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Kontaktandmed',
						'translatable' => true,
					),
					'contact_location_label'  => array(
						'label'        => __( 'Location label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Asukoht',
						'translatable' => true,
					),
					'contact_location_text'   => array(
						'label'        => __( 'Location text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 2,
						'default'      => 'Tartu + Tallinn',
						'translatable' => true,
					),
					'contact_email_label'     => array(
						'label'        => __( 'Email label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'E-post',
						'translatable' => true,
					),
					'contact_email_text'      => array(
						'label'        => __( 'Email text', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'info@rasmuskala.ee',
						'translatable' => true,
					),
					'contact_phone_label'     => array(
						'label'        => __( 'Phone label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Telefon',
						'translatable' => true,
					),
					'contact_phone_text'      => array(
						'label'        => __( 'Phone text', 'okperformance' ),
						'type'         => 'text',
						'default'      => '+372 569 24511',
						'translatable' => true,
					),
					'contact_company_title'   => array(
						'label'        => __( 'Company details title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Ettevõtte andmed',
						'translatable' => true,
					),
					'contact_company_1_label' => array(
						'label'        => __( 'Company item 1 title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Rasmus Kala',
						'translatable' => true,
					),
					'contact_company_1_text'  => array(
						'label'        => __( 'Company item 1 text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'OÜ RK PERFORMANCE' . "\n" . 'Registrikood: 17362262',
						'translatable' => true,
					),
					'contact_company_2_label' => array(
						'label'        => __( 'Company item 2 title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'LHV Pank',
						'translatable' => true,
					),
					'contact_company_2_text'  => array(
						'label'        => __( 'Company item 2 text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'EE607700771012317599' . "\n" . 'Ei ole käibemaksukohuslane',
						'translatable' => true,
					),
					'contact_location_box_title' => array(
						'label'        => __( 'Training locations box title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Treeningute asukohad',
						'translatable' => true,
					),
					'contact_location_box_text' => array(
						'label'        => __( 'Training locations box text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Eratreeningud toimuvad Tartu Ülikooli Akadeemilises Spordiklubis, Tartu MyFitness klubides või vastavalt kokkuleppele Sinu valitud jõusaalis Tartus ja Tallinnas.',
						'translatable' => true,
					),
					'contact_form_title'      => array(
						'label'        => __( 'Form panel title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Saada sõnum',
						'translatable' => true,
					),
					'contact_form_shortcode'  => array(
						'label'        => __( 'Contact Form 7 shortcode', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 2,
						'default'      => '',
						'placeholder'  => '[contact-form-7 id="123" title="Contact form"]',
						'description'  => __( 'Paste the Contact Form 7 shortcode here. The template will render it inside the right-side form panel.', 'okperformance' ),
						'translatable' => true,
					),
					'contact_form_empty_text' => array(
						'label'        => __( 'Missing form text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'Lisa Contact Form 7 shortcode Page Options > Contact vahelehel.',
						'translatable' => true,
					),
				),
			),
				'shop_archive' => array(
					'title'       => __( 'Shop Archive Hero', 'okperformance' ),
					'description' => __( 'Control the hero content and optional image shown on the main WooCommerce shop archive.', 'okperformance' ),
					'fields'      => array(
					'shop_archive_pill_label' => array(
						'label'        => __( 'Hero pill label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Gym programs',
						'translatable' => true,
					),
					'shop_archive_title'      => array(
						'label'        => __( 'Hero title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Shop',
						'translatable' => true,
					),
					'shop_archive_lede'       => array(
						'label'        => __( 'Hero text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 5,
						'default'      => 'Training programs built for structure, consistency, and measurable progress. Choose the plan that fits your current goal and start building better training habits.',
						'translatable' => true,
					),
					'shop_archive_image_id'   => array(
						'label'        => __( 'Hero image', 'okperformance' ),
						'type'         => 'media',
						'default'      => 0,
						'description'  => __( 'Choose an image from the media library or upload a new one for the right column of the shop hero.', 'okperformance' ),
						'button_label' => __( 'Choose image', 'okperformance' ),
						'preview'      => 'image',
						'translatable' => false,
					),
					'shop_archive_image_alt'  => array(
						'label'        => __( 'Hero image alt text', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Shop hero image',
						'translatable' => true,
					),
				),
			),
			'about_page' => array(
				'title'       => __( 'About Us Page', 'okperformance' ),
				'description' => __( 'Manage the custom About Us page template hero and the two team profile cards.', 'okperformance' ),
				'fields'      => array(
					'about_page_pill_label'      => array(
						'label'        => __( 'Hero pill label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'About OKPerformance',
						'translatable' => true,
					),
					'about_page_title'           => array(
						'label'        => __( 'Hero title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Two coaches, one performance-first philosophy',
						'translatable' => true,
					),
					'about_page_lede'            => array(
						'label'        => __( 'Hero text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 5,
						'default'      => 'We build premium coaching experiences around clarity, accountability, and long-term athletic progress. Every plan is shaped by real-world experience, sharp communication, and systems that are realistic to follow.',
						'translatable' => true,
					),
					'about_page_metric_1_value'  => array(
						'label'        => __( 'Hero metric 1 value', 'okperformance' ),
						'type'         => 'text',
						'default'      => '2',
						'translatable' => true,
					),
					'about_page_metric_1_label'  => array(
						'label'        => __( 'Hero metric 1 label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Coaches leading every client journey',
						'translatable' => true,
					),
					'about_page_metric_2_value'  => array(
						'label'        => __( 'Hero metric 2 value', 'okperformance' ),
						'type'         => 'text',
						'default'      => '1:1',
						'translatable' => true,
					),
					'about_page_metric_2_label'  => array(
						'label'        => __( 'Hero metric 2 label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Support built around direct communication',
						'translatable' => true,
					),
					'about_page_story_eyebrow'   => array(
						'label'        => __( 'Story section eyebrow', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'How we work',
						'translatable' => true,
					),
					'about_page_story_title'     => array(
						'label'        => __( 'Story section title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Coaching that feels personal, structured, and built to last',
						'translatable' => true,
					),
					'about_page_story_text'      => array(
						'label'        => __( 'Story section text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 6,
						'default'      => 'OKPerformance was built to close the gap between generic plans and truly guided progress. We combine practical coaching, premium presentation, and consistent support so athletes always know what to do next and why it matters.',
						'translatable' => true,
					),
					'about_page_panel_eyebrow'   => array(
						'label'        => __( 'Story panel eyebrow', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'What clients feel',
						'translatable' => true,
					),
					'about_page_panel_title'     => array(
						'label'        => __( 'Story panel title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Clear communication, smart structure, and momentum that keeps building',
						'translatable' => true,
					),
					'about_page_panel_text'      => array(
						'label'        => __( 'Story panel text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'From the first check-in to long-term progression, the experience is designed to feel focused, supportive, and premium without unnecessary complexity.',
						'translatable' => true,
					),
					'about_page_team_pill_label' => array(
						'label'        => __( 'Team section pill label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Meet the team',
						'translatable' => true,
					),
					'about_page_team_title'      => array(
						'label'        => __( 'Team section title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'The two people behind the coaching experience',
						'translatable' => true,
					),
					'about_page_team_lede'       => array(
						'label'        => __( 'Team section text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 4,
						'default'      => 'Use the About us tab in Page Options to update names, biographies, focus areas, quotes, and portraits for both profiles.',
						'translatable' => true,
					),
					'about_page_person_1_name'   => array(
						'label'        => __( 'Person 1 name', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Coach One',
						'translatable' => true,
					),
					'about_page_person_1_role'   => array(
						'label'        => __( 'Person 1 role', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Performance coach',
						'translatable' => true,
					),
					'about_page_person_1_focus'  => array(
						'label'        => __( 'Person 1 focus label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Training systems',
						'translatable' => true,
					),
					'about_page_person_1_bio'    => array(
						'label'        => __( 'Person 1 bio', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 5,
						'default'      => 'Share the background, coaching style, and strengths of the first team member here. Keep it human, specific, and focused on the transformation clients can expect.',
						'translatable' => true,
					),
					'about_page_person_1_quote'  => array(
						'label'        => __( 'Person 1 quote', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'Consistency wins when the plan is clear and the support actually fits real life.',
						'translatable' => true,
					),
					'about_page_person_1_image_id' => array(
						'label'        => __( 'Person 1 image', 'okperformance' ),
						'type'         => 'media',
						'default'      => 0,
						'description'  => __( 'Upload or choose the portrait for the first person.', 'okperformance' ),
						'button_label' => __( 'Choose image', 'okperformance' ),
						'preview'      => 'image',
						'translatable' => false,
					),
					'about_page_person_1_image_alt' => array(
						'label'        => __( 'Person 1 image alt text', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Portrait of the first coach',
						'translatable' => true,
					),
					'about_page_person_1_cv_label' => array(
						'label'        => __( 'Person 1 CV button label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'CV',
						'translatable' => true,
					),
					'about_page_person_1_cv_url'   => array(
						'label'        => __( 'Person 1 CV button URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => home_url( '/cv/' ),
						'description'  => __( 'Add a PDF/media URL or page URL for this person\'s CV button.', 'okperformance' ),
						'translatable' => true,
					),
					'about_page_person_1_contact_label' => array(
						'label'        => __( 'Person 1 contact button label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Contact',
						'translatable' => true,
					),
					'about_page_person_1_contact_url' => array(
						'label'        => __( 'Person 1 contact button URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => home_url( '/contact/' ),
						'description'  => __( 'Leave empty to link automatically to the page using the Contact template.', 'okperformance' ),
						'translatable' => true,
					),
					'about_page_person_1_instagram_url' => array(
						'label'        => __( 'Person 1 Instagram URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => 'https://www.instagram.com/username/',
						'translatable' => true,
					),
					'about_page_person_1_facebook_url' => array(
						'label'        => __( 'Person 1 Facebook URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => 'https://www.facebook.com/username/',
						'translatable' => true,
					),
					'about_page_person_2_name'   => array(
						'label'        => __( 'Person 2 name', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Coach Two',
						'translatable' => true,
					),
					'about_page_person_2_role'   => array(
						'label'        => __( 'Person 2 role', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Nutrition & performance coach',
						'translatable' => true,
					),
					'about_page_person_2_focus'  => array(
						'label'        => __( 'Person 2 focus label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Nutrition strategy',
						'translatable' => true,
					),
					'about_page_person_2_bio'    => array(
						'label'        => __( 'Person 2 bio', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 5,
						'default'      => 'Use this space for the second team member story, expertise, and the role they play in the client experience across training, nutrition, or accountability.',
						'translatable' => true,
					),
					'about_page_person_2_quote'  => array(
						'label'        => __( 'Person 2 quote', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'The best coaching systems make high standards feel sustainable, not overwhelming.',
						'translatable' => true,
					),
					'about_page_person_2_image_id' => array(
						'label'        => __( 'Person 2 image', 'okperformance' ),
						'type'         => 'media',
						'default'      => 0,
						'description'  => __( 'Upload or choose the portrait for the second person.', 'okperformance' ),
						'button_label' => __( 'Choose image', 'okperformance' ),
						'preview'      => 'image',
						'translatable' => false,
					),
					'about_page_person_2_image_alt' => array(
						'label'        => __( 'Person 2 image alt text', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Portrait of the second coach',
						'translatable' => true,
					),
					'about_page_person_2_cv_label' => array(
						'label'        => __( 'Person 2 CV button label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'CV',
						'translatable' => true,
					),
					'about_page_person_2_cv_url'   => array(
						'label'        => __( 'Person 2 CV button URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => home_url( '/cv/' ),
						'description'  => __( 'Add a PDF/media URL or page URL for this person\'s CV button.', 'okperformance' ),
						'translatable' => true,
					),
					'about_page_person_2_contact_label' => array(
						'label'        => __( 'Person 2 contact button label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Contact',
						'translatable' => true,
					),
					'about_page_person_2_contact_url' => array(
						'label'        => __( 'Person 2 contact button URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => home_url( '/contact/' ),
						'description'  => __( 'Leave empty to link automatically to the page using the Contact template.', 'okperformance' ),
						'translatable' => true,
					),
					'about_page_person_2_instagram_url' => array(
						'label'        => __( 'Person 2 Instagram URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => 'https://www.instagram.com/username/',
						'translatable' => true,
					),
					'about_page_person_2_facebook_url' => array(
						'label'        => __( 'Person 2 Facebook URL', 'okperformance' ),
						'type'         => 'url',
						'default'      => '',
						'placeholder'  => 'https://www.facebook.com/username/',
						'translatable' => true,
					),
					'about_page_principles_pill_label' => array(
						'label'        => __( 'Principles section pill label', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Our principles',
						'translatable' => true,
					),
					'about_page_principles_title' => array(
						'label'        => __( 'Principles section title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'What shapes the OKPerformance experience',
						'translatable' => true,
					),
					'about_page_principle_1_title' => array(
						'label'        => __( 'Principle 1 title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Personal guidance',
						'translatable' => true,
					),
					'about_page_principle_1_text'  => array(
						'label'        => __( 'Principle 1 text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'Clients should always know what matters most right now and how their plan connects to the bigger goal.',
						'translatable' => true,
					),
					'about_page_principle_2_title' => array(
						'label'        => __( 'Principle 2 title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Premium structure',
						'translatable' => true,
					),
					'about_page_principle_2_text'  => array(
						'label'        => __( 'Principle 2 text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'Strong systems remove friction and help athletes stay consistent through busy weeks, travel, and life changes.',
						'translatable' => true,
					),
					'about_page_principle_3_title' => array(
						'label'        => __( 'Principle 3 title', 'okperformance' ),
						'type'         => 'text',
						'default'      => 'Long-term progress',
						'translatable' => true,
					),
					'about_page_principle_3_text'  => array(
						'label'        => __( 'Principle 3 text', 'okperformance' ),
						'type'         => 'textarea',
						'rows'         => 3,
						'default'      => 'We care about sustainable momentum, not just quick spikes of motivation that disappear after a few weeks.',
						'translatable' => true,
					),
				),
			),
			'blog'     => array(
				'title'       => __( 'Blog Section', 'okperformance' ),
				'description' => __( 'Manage the homepage journal section and its CTA text.', 'okperformance' ),
				'fields'      => array(
				'blog_title'           => array(
					'label'        => __( 'Section title', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'From the journal',
					'translatable' => true,
				),
				'blog_lede'            => array(
					'label'        => __( 'Section lead', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 4,
					'default'      => 'Insights on training, athlete performance, nutrition strategy, and sustainable progress from the OKPerformance approach.',
					'translatable' => true,
				),
				'blog_link_label'      => array(
					'label'        => __( 'Archive link label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Visit the blog',
					'translatable' => true,
				),
				'blog_card_link_label' => array(
					'label'        => __( 'Blog card button label', 'okperformance' ),
					'type'         => 'text',
					'default'      => 'Read article',
					'translatable' => true,
				),
				'blog_fallback_text'   => array(
					'label'        => __( 'Blog excerpt fallback', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'A practical article from OKPerformance on building stronger systems for training, recovery, and measurable progress.',
					'translatable' => true,
				),
				'blog_empty_text'      => array(
					'label'        => __( 'Empty state text', 'okperformance' ),
					'type'         => 'textarea',
					'rows'         => 3,
					'default'      => 'No blog posts have been published yet. Publish a few posts and they will appear here automatically.',
					'translatable' => true,
				),
			),
		),
	);
}

/**
 * Flatten the homepage settings schema into a keyed field map.
 *
 * @return array<string, array<string, mixed>>
 */
function okperformance_home_get_field_map() {
	static $field_map = null;

	if ( null !== $field_map ) {
		return $field_map;
	}

	$field_map = array();

	foreach ( okperformance_home_get_settings_sections() as $section_key => $section ) {
		if ( empty( $section['fields'] ) || ! is_array( $section['fields'] ) ) {
			continue;
		}

		foreach ( $section['fields'] as $field_key => $field ) {
			$field['section_key']    = $section_key;
			$field['section_title']  = $section['title'];
			$field_map[ $field_key ] = $field;
		}
	}

	return $field_map;
}

/**
 * Default values for the home template options.
 *
 * @return array<string, mixed>
 */
function okperformance_home_get_default_options() {
	$defaults = array();

	foreach ( okperformance_home_get_field_map() as $field_key => $field ) {
		$defaults[ $field_key ] = $field['default'] ?? '';
	}

	return $defaults;
}

/**
 * Return the un-translated saved homepage options merged with defaults.
 *
 * @return array<string, mixed>
 */
function okperformance_home_get_raw_options() {
	$defaults = okperformance_home_get_default_options();
	$saved    = get_option( 'okperformance_home_options', array() );

	if ( ! is_array( $saved ) ) {
		return $defaults;
	}

	return array_merge( $defaults, $saved );
}

/**
 * Whether WPML string translation functions are available.
 *
 * @return bool
 */
function okperformance_home_has_wpml() {
	return has_filter( 'wpml_translate_single_string' ) || has_action( 'wpml_register_single_string' ) || function_exists( 'icl_t' ) || function_exists( 'icl_register_string' );
}

/**
 * Register translatable home option values in WPML.
 *
 * @param array<string, mixed> $options Home options.
 * @return void
 */
function okperformance_home_register_wpml_strings( $options ) {
	if ( ! okperformance_home_has_wpml() || ! is_array( $options ) ) {
		return;
	}

	foreach ( okperformance_home_get_field_map() as $field_key => $field ) {
		if ( empty( $field['translatable'] ) ) {
			continue;
		}

		$value = isset( $options[ $field_key ] ) ? (string) $options[ $field_key ] : '';

		if ( has_action( 'wpml_register_single_string' ) ) {
			do_action( 'wpml_register_single_string', 'OKPerformance Home', $field_key, $value );
		}

		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'OKPerformance Home', $field_key, $value );
		}
	}
}

/**
 * Register current home option strings in WPML during admin usage.
 *
 * @return void
 */
function okperformance_home_register_current_wpml_strings() {
	okperformance_home_register_wpml_strings( okperformance_home_get_raw_options() );
}
add_action( 'admin_init', 'okperformance_home_register_current_wpml_strings', 20 );

/**
 * Register updated home option strings in WPML after saving.
 *
 * @param array<string, mixed> $old_value Previous option value.
 * @param array<string, mixed> $value     New option value.
 * @return void
 */
function okperformance_home_register_wpml_strings_on_update( $old_value, $value ) {
	okperformance_home_register_wpml_strings( is_array( $value ) ? $value : array() );
}
add_action( 'update_option_okperformance_home_options', 'okperformance_home_register_wpml_strings_on_update', 10, 2 );

/**
 * Register WPML strings when the option is first added.
 *
 * @param string               $option Option name.
 * @param array<string, mixed> $value  New value.
 * @return void
 */
function okperformance_home_register_wpml_strings_on_add( $option, $value ) {
	okperformance_home_register_wpml_strings( is_array( $value ) ? $value : array() );
}
add_action( 'add_option_okperformance_home_options', 'okperformance_home_register_wpml_strings_on_add', 10, 2 );

/**
 * Translate a translatable home option value through WPML when available.
 *
 * @param string $field_key Field key.
 * @param mixed  $value     Field value.
 * @return mixed
 */
function okperformance_home_translate_option_value( $field_key, $value ) {
	$fields = okperformance_home_get_field_map();

	if ( ! isset( $fields[ $field_key ] ) || empty( $fields[ $field_key ]['translatable'] ) ) {
		return $value;
	}

	$value = (string) $value;

	if ( has_filter( 'wpml_translate_single_string' ) ) {
		return apply_filters( 'wpml_translate_single_string', $value, 'OKPerformance Home', $field_key );
	}

	if ( function_exists( 'icl_t' ) ) {
		return icl_t( 'OKPerformance Home', $field_key, $value );
	}

	return $value;
}

/**
 * Get merged homepage settings, optionally translated for front-end usage.
 *
 * @param bool|null $translate Whether to translate WPML-managed fields.
 * @return array<string, mixed>
 */
function okperformance_home_get_options( $translate = null ) {
	$options = okperformance_home_get_raw_options();

	if ( null === $translate ) {
		$translate = ! is_admin();
	}

	if ( ! $translate ) {
		return $options;
	}

	foreach ( $options as $field_key => $value ) {
		$options[ $field_key ] = okperformance_home_translate_option_value( $field_key, $value );
	}

	return $options;
}

/**
 * Normalize a comma-separated list of product IDs.
 *
 * @param string $raw_ids Raw list from settings.
 * @return int[]
 */
function okperformance_home_parse_product_ids( $raw_ids ) {
	$ids_array = preg_split( '/\s*,\s*/', trim( (string) $raw_ids ) );
	$ids_clean = array();

	if ( is_array( $ids_array ) ) {
		foreach ( $ids_array as $maybe_id ) {
			$maybe_id = trim( (string) $maybe_id );

			if ( '' === $maybe_id || ! ctype_digit( $maybe_id ) ) {
				continue;
			}

			$ids_clean[] = (int) $maybe_id;
		}
	}

	return $ids_clean;
}

/**
 * Build the WooCommerce query args for homepage products.
 *
 * @param array<string, mixed> $options Homepage options.
 * @return array<string, mixed>
 */
function okperformance_home_get_product_query_args( $options ) {
	$defaults = okperformance_home_get_default_options();
	$options  = is_array( $options ) ? array_merge( $defaults, $options ) : $defaults;
	$ids      = okperformance_home_parse_product_ids( (string) $options['products_ids'] );
	$limit    = max( 1, min( 24, (int) $options['products_limit'] ) );
	$orderby  = (string) $options['products_orderby'];

	$args = array(
		'status' => 'publish',
		'limit'  => $limit,
	);

	if ( ! empty( $ids ) ) {
		$args['include'] = $ids;
		$args['orderby'] = 'post__in';

		return $args;
	}

	switch ( $orderby ) {
		case 'price':
			$args['orderby'] = 'price';
			$args['order']   = 'ASC';
			break;
		case 'price-desc':
			$args['orderby'] = 'price';
			$args['order']   = 'DESC';
			break;
		case 'featured':
			$args['featured'] = true;
			$args['orderby']  = 'date';
			break;
		case 'sale':
			$args['on_sale'] = true;
			$args['orderby'] = 'date';
			break;
		case 'popularity':
		case 'rating':
		case 'rand':
		case 'menu_order':
		case 'date':
			$args['orderby'] = $orderby;
			break;
		default:
			$args['orderby'] = 'date';
			break;
	}

	return $args;
}

/**
 * Get the homepage products collection.
 *
 * @param array<string, mixed> $options Homepage options.
 * @return array<int, WC_Product>
 */
function okperformance_home_get_products( $options = array() ) {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return array();
	}

	$options  = is_array( $options ) && ! empty( $options ) ? $options : okperformance_home_get_raw_options();
	$args     = okperformance_home_get_product_query_args( $options );
	$products = wc_get_products( $args );

	if ( ! is_array( $products ) ) {
		$products = array();
	}

	if ( empty( $products ) && empty( $args['include'] ) ) {
		$products = wc_get_products(
			array(
				'status'  => 'publish',
				'limit'   => 6,
				'orderby' => 'date',
			)
		);
	}

	return is_array( $products ) ? $products : array();
}

/**
 * Sanitize and normalize homepage settings input.
 *
 * @param array<string, mixed> $input Raw user input.
 * @return array<string, mixed>
 */
function okperformance_home_sanitize_options( $input ) {
	$defaults = okperformance_home_get_default_options();
	$saved    = get_option( 'okperformance_home_options', array() );
	$input    = is_array( $input ) ? $input : array();
	$saved    = is_array( $saved ) ? $saved : array();
	$values   = array_merge( $defaults, $saved, $input );
	$output   = array();

		foreach ( okperformance_home_get_field_map() as $field_key => $field ) {
			$type = $field['type'] ?? 'text';
			$raw  = $values[ $field_key ] ?? $defaults[ $field_key ];

			switch ( $type ) {
			case 'textarea':
				$output[ $field_key ] = wp_kses_post( (string) $raw );
				break;
			case 'number':
				$min                  = isset( $field['min'] ) ? (int) $field['min'] : 0;
				$max                  = isset( $field['max'] ) ? (int) $field['max'] : PHP_INT_MAX;
				$number               = (int) $raw;
				$output[ $field_key ] = max( $min, min( $max, $number ) );
				break;
				case 'select':
					$allowed              = isset( $field['items'] ) && is_array( $field['items'] ) ? array_keys( $field['items'] ) : array();
					$choice               = (string) $raw;
					$output[ $field_key ] = in_array( $choice, $allowed, true ) ? $choice : $defaults[ $field_key ];
					break;
				case 'url':
					$output[ $field_key ] = esc_url_raw( (string) $raw );
					break;
				case 'media':
					$output[ $field_key ] = absint( $raw );
					break;
				default:
					$output[ $field_key ] = sanitize_text_field( (string) $raw );
					break;
			}
		}

	$output['products_ids'] = implode( ',', okperformance_home_parse_product_ids( (string) $output['products_ids'] ) );

	return $output;
}

/**
 * Render section description text.
 *
 * @param array<string, mixed> $args Section callback args.
 * @return void
 */
function okperformance_home_render_section_description( $args ) {
	$section = isset( $args['section'] ) && is_array( $args['section'] ) ? $args['section'] : array();

	if ( ! empty( $section['description'] ) ) {
		echo '<p>' . esc_html( (string) $section['description'] ) . '</p>';
	}
}

/**
 * Render a generic home option field.
 *
 * @param array<string, mixed> $args Field arguments.
 * @return void
 */
function okperformance_home_render_field( $args ) {
	$options     = okperformance_home_get_raw_options();
	$key         = (string) ( $args['key'] ?? '' );
	$type        = (string) ( $args['type'] ?? 'text' );
	$value       = $options[ $key ] ?? '';
	$placeholder = isset( $args['placeholder'] ) ? (string) $args['placeholder'] : '';

		switch ( $type ) {
			case 'textarea':
				$rows = isset( $args['rows'] ) ? (int) $args['rows'] : 3;
				?>
				<textarea name="okperformance_home_options[<?php echo esc_attr( $key ); ?>]" rows="<?php echo esc_attr( $rows ); ?>" class="large-text" placeholder="<?php echo esc_attr( $placeholder ); ?>"><?php echo esc_textarea( (string) $value ); ?></textarea>
			<?php
			break;

		case 'number':
			$min = isset( $args['min'] ) ? (int) $args['min'] : 0;
			$max = isset( $args['max'] ) ? (int) $args['max'] : 9999;
			?>
			<input type="number" name="okperformance_home_options[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( (string) $value ); ?>" min="<?php echo esc_attr( (string) $min ); ?>" max="<?php echo esc_attr( (string) $max ); ?>" />
			<?php
			break;

			case 'select':
				$items = isset( $args['items'] ) && is_array( $args['items'] ) ? $args['items'] : array();
				?>
				<select name="okperformance_home_options[<?php echo esc_attr( $key ); ?>]">
				<?php foreach ( $items as $item_value => $label ) : ?>
					<option value="<?php echo esc_attr( (string) $item_value ); ?>" <?php selected( (string) $value, (string) $item_value ); ?>>
						<?php echo esc_html( (string) $label ); ?>
					</option>
				<?php endforeach; ?>
				</select>
				<?php
				break;

			case 'url':
				?>
				<input type="url" class="large-text" name="okperformance_home_options[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( (string) $value ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" />
				<?php
				if ( ! empty( $args['preview'] ) && 'image' === $args['preview'] && ! empty( $value ) ) :
					?>
					<p style="margin:12px 0 0;">
						<img src="<?php echo esc_url( (string) $value ); ?>" alt="" style="display:block;max-width:min(100%,420px);height:auto;border-radius:16px;border:1px solid #dcdcde;background:#111827;" />
					</p>
					<?php
				endif;
				break;

			case 'media':
				$attachment_id = absint( $value );
				$image_url     = $attachment_id ? wp_get_attachment_image_url( $attachment_id, 'medium_large' ) : '';
				$button_label  = isset( $args['button_label'] ) ? (string) $args['button_label'] : __( 'Choose image', 'okperformance' );
				?>
				<div class="okp-media-field" data-okp-media-field>
					<input type="hidden" id="<?php echo esc_attr( $key ); ?>" name="okperformance_home_options[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( (string) $attachment_id ); ?>" data-okp-media-input />
					<div class="okp-media-field__preview" data-okp-media-preview <?php echo $image_url ? '' : 'hidden'; ?>>
						<?php if ( $image_url ) : ?>
							<img src="<?php echo esc_url( $image_url ); ?>" alt="" style="display:block;max-width:min(100%,420px);height:auto;border-radius:16px;border:1px solid #dcdcde;background:#111827;" />
						<?php endif; ?>
					</div>
					<p class="okp-media-field__actions">
						<button type="button" class="button button-secondary" data-okp-media-open data-default-label="<?php echo esc_attr( $button_label ); ?>">
							<?php echo esc_html( $attachment_id ? __( 'Replace image', 'okperformance' ) : $button_label ); ?>
						</button>
						<button type="button" class="button-link-delete" data-okp-media-remove <?php echo $attachment_id ? '' : 'hidden'; ?>>
							<?php esc_html_e( 'Remove image', 'okperformance' ); ?>
						</button>
					</p>
				</div>
				<?php
				break;

			default:
				?>
				<input type="text" class="regular-text" name="okperformance_home_options[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( (string) $value ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" />
				<?php
			break;
	}

		if ( ! empty( $args['description'] ) ) {
			echo '<p class="description">' . esc_html( (string) $args['description'] ) . '</p>';
		}

		if ( ! empty( $args['translatable'] ) ) {
			echo '<p class="description">' . esc_html__( 'WPML-ready: this field is registered for string translation.', 'okperformance' ) . '</p>';
		}
	}

/**
 * Get page-option admin tabs.
 *
 * @return array<string, string>
 */
function okperformance_home_get_settings_tabs() {
	return array(
		'home'         => __( 'Home page', 'okperformance' ),
		'faq'          => __( 'FAQ', 'okperformance' ),
		'contact'      => __( 'Contact', 'okperformance' ),
		'shop_archive' => __( 'Shop archive', 'okperformance' ),
		'about_us'     => __( 'About us', 'okperformance' ),
	);
}

/**
 * Get the current page-options admin tab.
 *
 * @return string
 */
function okperformance_home_get_current_settings_tab() {
	$tabs        = okperformance_home_get_settings_tabs();
	$default_tab = 'home';
	$tab         = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : $default_tab; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	return isset( $tabs[ $tab ] ) ? $tab : $default_tab;
}

/**
 * Return settings sections for a specific admin tab.
 *
 * @param string $tab Tab key.
 * @return array<string, array<string, mixed>>
 */
function okperformance_home_get_sections_for_tab( $tab ) {
	$sections = array();

	foreach ( okperformance_home_get_settings_sections() as $section_key => $section ) {
		if ( 'shop_archive' === $section_key ) {
			$section_tab = 'shop_archive';
		} elseif ( 'contact_page' === $section_key ) {
			$section_tab = 'contact';
		} elseif ( 'faq' === $section_key ) {
			$section_tab = 'faq';
		} elseif ( 'about_page' === $section_key ) {
			$section_tab = 'about_us';
		} else {
			$section_tab = 'home';
		}

		if ( $section_tab === $tab ) {
			$sections[ $section_key ] = $section;
		}
	}

	return $sections;
}

/**
 * Render the settings fields for one page-options admin tab.
 *
 * @param string $tab Tab key.
 * @return void
 */
function okperformance_home_render_settings_tab( $tab ) {
	$sections = okperformance_home_get_sections_for_tab( $tab );

	foreach ( $sections as $section_key => $section ) {
		echo '<section class="okperformance-settings-section">';
		echo '<h2>' . esc_html( (string) $section['title'] ) . '</h2>';
		okperformance_home_render_section_description(
			array(
				'section' => $section,
			)
		);
		echo '<table class="form-table" role="presentation">';

		if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {
			foreach ( $section['fields'] as $field_key => $field ) {
				echo '<tr>';
				echo '<th scope="row"><label for="' . esc_attr( $field_key ) . '">' . esc_html( (string) $field['label'] ) . '</label></th>';
				echo '<td>';
				okperformance_home_render_field(
					array_merge(
						$field,
						array(
							'key' => $field_key,
						)
					)
				);
				echo '</td>';
				echo '</tr>';
			}
		}

		echo '</table>';
		echo '</section>';
	}
}

/**
 * Register settings and fields.
 *
 * @return void
 */
function okperformance_home_register_settings() {
	register_setting(
		'okperformance_home_options_group',
		'okperformance_home_options',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'okperformance_home_sanitize_options',
		)
	);

	foreach ( okperformance_home_get_settings_sections() as $section_key => $section ) {
		$settings_section_id = 'okperformance_home_' . $section_key;

		add_settings_section(
			$settings_section_id,
			(string) $section['title'],
			'okperformance_home_render_section_description',
			'okperformance-home-settings',
			array(
				'section' => $section,
			)
		);

		if ( empty( $section['fields'] ) || ! is_array( $section['fields'] ) ) {
			continue;
		}

		foreach ( $section['fields'] as $field_key => $field ) {
			add_settings_field(
				$field_key,
				(string) $field['label'],
				'okperformance_home_render_field',
				'okperformance-home-settings',
				$settings_section_id,
				array_merge(
					$field,
					array(
						'key' => $field_key,
					)
				)
			);
		}
	}
}
add_action( 'admin_init', 'okperformance_home_register_settings' );

/**
 * Enqueue admin assets for Page Options media fields.
 *
 * @return void
 */
function okperformance_home_admin_assets() {
	if ( ! is_admin() ) {
		return;
	}

	$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( 'okperformance-page-options' !== $page ) {
		return;
	}

	wp_enqueue_media();

	$script_path = OKPERFORMANCE_CORE_PATH . 'assets/js/page-options-media.js';
	$script_url  = OKPERFORMANCE_CORE_URL . 'assets/js/page-options-media.js';
	$version     = file_exists( $script_path ) ? (string) filemtime( $script_path ) : OKPERFORMANCE_CORE_VERSION;

	wp_enqueue_script( 'okperformance-page-options-media', $script_url, array( 'jquery' ), $version, true );
	wp_localize_script(
		'okperformance-page-options-media',
		'okpPageOptionsMedia',
		array(
			'title'        => __( 'Choose image', 'okperformance' ),
			'button'       => __( 'Use this image', 'okperformance' ),
			'replaceLabel' => __( 'Replace image', 'okperformance' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'okperformance_home_admin_assets' );

/**
 * Register the top-level Page options menu and the Home page submenu.
 *
 * @return void
 */
function okperformance_home_admin_menu() {
	add_menu_page(
		__( 'Page Options', 'okperformance' ),
		__( 'Page options', 'okperformance' ),
		'manage_options',
		'okperformance-page-options',
		'okperformance_home_settings_page',
		'dashicons-layout',
		59
	);

	add_submenu_page(
		'okperformance-page-options',
		__( 'Home Page', 'okperformance' ),
		__( 'Home page', 'okperformance' ),
		'manage_options',
		'okperformance-page-options',
		'okperformance_home_settings_page'
	);
}
add_action( 'admin_menu', 'okperformance_home_admin_menu' );

/**
 * Render the home settings page.
 *
 * @return void
 */
function okperformance_home_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to access this page.', 'okperformance' ), 403 );
	}

	$current_tab = okperformance_home_get_current_settings_tab();
	$tabs        = okperformance_home_get_settings_tabs();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Page Options', 'okperformance' ); ?></h1>
		<p><?php esc_html_e( 'Manage the editable hero and section content used across the homepage, FAQ, shop archive, and About Us page. When WPML is active, translatable values are also registered for string translation.', 'okperformance' ); ?></p>

		<h2 class="nav-tab-wrapper">
			<?php foreach ( $tabs as $tab_key => $tab_label ) : ?>
				<?php
				$tab_url = add_query_arg(
					array(
						'page' => 'okperformance-page-options',
						'tab'  => $tab_key,
					),
					admin_url( 'admin.php' )
				);
				?>
				<a href="<?php echo esc_url( $tab_url ); ?>" class="nav-tab <?php echo $current_tab === $tab_key ? 'nav-tab-active' : ''; ?>">
					<?php echo esc_html( $tab_label ); ?>
				</a>
			<?php endforeach; ?>
		</h2>

		<form method="post" action="options.php">
			<?php
			settings_fields( 'okperformance_home_options_group' );
			okperformance_home_render_settings_tab( $current_tab );
			submit_button( __( 'Save page options', 'okperformance' ) );
			?>
		</form>
	</div>
	<?php
}
