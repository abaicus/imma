<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Imma
 * @since Imma 1.0
 */
get_header(); ?>
<?php
/**
 * Imma Header hook.
 */
do_action( 'imma_header' );

/**
 * Imma Sections hook.
 *
 * @hooked imma_hero_section        - 1
 * @hooked imma_services_section    - 2
 * @hooked imma_ribbon_section      - 3
 * @hooked imma_portfolio_section   - 4
 * @hooked imma_stats_section       - 5
 * @hooked imma_blog_section        - 6
 * @hooked imma_clients_section     - 7
 */
do_action( 'imma_sections' );
?>
<?php get_footer(); ?>