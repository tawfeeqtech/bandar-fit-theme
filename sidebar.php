<?php
/**
 * قالب السايدبار الجانبي
 * @package BandarFit
 */

if (!is_active_sidebar('sidebar-main')) {
    return;
}
?>

<aside class="sidebar" role="complementary">
    <div class="sidebar-inner">
        <?php dynamic_sidebar('sidebar-main'); ?>
    </div>
</aside>

<style>
.sidebar {
    padding: 20px;
    background: var(--bg-secondary);
    border-radius: 24px;
    border: 1px solid var(--border-color);
}

.sidebar-inner {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* Widget Styles */
.sidebar .widget {
    margin-bottom: 30px;
}

.sidebar .widget:last-child {
    margin-bottom: 0;
}

.sidebar .widget-title {
    font-size: 18px;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--brand-primary);
    display: inline-block;
}

/* Search Widget */
.sidebar .widget_search .search-form {
    display: flex;
    gap: 10px;
}

.sidebar .widget_search input {
    flex: 1;
    padding: 12px 15px;
    background: var(--bg-tertiary);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    color: var(--text-primary);
}

.sidebar .widget_search button {
    padding: 12px 20px;
    background: var(--brand-primary);
    border: none;
    border-radius: 12px;
    color: var(--brand-dark);
    font-weight: bold;
    cursor: pointer;
}

/* Categories Widget */
.sidebar .widget_categories ul,
.sidebar .widget_archive ul,
.sidebar .widget_meta ul,
.sidebar .widget_pages ul,
.sidebar .widget_nav_menu ul {
    list-style: none;
    padding: 0;
}

.sidebar .widget_categories li,
.sidebar .widget_archive li,
.sidebar .widget_meta li,
.sidebar .widget_pages li,
.sidebar .widget_nav_menu li {
    margin-bottom: 10px;
}

.sidebar .widget_categories a,
.sidebar .widget_archive a,
.sidebar .widget_meta a,
.sidebar .widget_pages a,
.sidebar .widget_nav_menu a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
    display: block;
    padding: 8px 0;
}

.sidebar .widget_categories a:hover,
.sidebar .widget_archive a:hover,
.sidebar .widget_meta a:hover,
.sidebar .widget_pages a:hover,
.sidebar .widget_nav_menu a:hover {
    color: var(--brand-primary);
    padding-right: 10px;
}

/* Recent Posts Widget */
.sidebar .widget_recent_entries ul {
    list-style: none;
    padding: 0;
}

.sidebar .widget_recent_entries li {
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-color);
}

.sidebar .widget_recent_entries a {
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
}

.sidebar .widget_recent_entries .post-date {
    font-size: 11px;
    color: var(--text-muted);
}

/* Tag Cloud Widget */
.sidebar .widget_tag_cloud .tagcloud {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.sidebar .widget_tag_cloud a {
    padding: 5px 12px;
    background: var(--bg-tertiary);
    border-radius: 20px;
    font-size: 12px;
    text-decoration: none;
    color: var(--text-secondary);
    transition: all 0.3s ease;
}

.sidebar .widget_tag_cloud a:hover {
    background: var(--brand-primary);
    color: var(--brand-dark);
}
</style>