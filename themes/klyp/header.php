<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Klyp
 */

?>
<!doctype html>
<?php
if (is_front_page()) {
    $header_page_class = 'mn-header--white';
} else {
    $header_page_class = 'mn-header--white';
}
?>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="p:domain_verify" content="4534e43d56386f0ae8460b6d113097bb"/>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="apple-touch-icon" sizes="57x57" href="<?= get_site_icon_url(57); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_site_icon_url(60); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= get_site_icon_url(72); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_site_icon_url(76); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_site_icon_url(114); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_site_icon_url(120); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_site_icon_url(144); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_site_icon_url(152); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_site_icon_url(180); ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= get_site_icon_url(192); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_site_icon_url(32); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_site_icon_url(96); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_site_icon_url(16); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header id="masthead" class="sticky top-0 site-header z-20 <?= $header_page_class; ?>">
        <?php require_once('template-parts/header.php'); ?>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
