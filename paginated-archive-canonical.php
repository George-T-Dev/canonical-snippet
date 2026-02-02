<?php
  
  /**
   * =========================================================
   * PAGINATED ARCHIVE CANONICAL FIX
   * ---------------------------------------------------------
   * Ensures paginated blog, author, and taxonomy archives
   * use self-referencing canonical URLs instead of pointing
   * to page 1.
   *
   * Compatible with:
   * - Yoast SEO
   * - Rank Math SEO
   * - No SEO plugin (fallback output)
   * =========================================================
   */
  
  
  /**
   * Core helper function
   * Determines the correct canonical URL for paginated archives
   */
  function client_get_paginated_archive_canonical() {
    
    // Current pagination number (defaults to 1)
    $paged = max(1, get_query_var('paged'));
    
    /**
     * BLOG POSTS PAGE (Posts page set in Settings → Reading)
     */
    if (is_home()) {
      
      // Page 2+ should canonicalize to itself
      if ($paged > 1) {
        return get_pagenum_link($paged);
      }
      
      // Page 1 canonical should be the actual posts page URL
      return get_permalink(get_option('page_for_posts'));
    }
    
    /**
     * AUTHOR ARCHIVES
     */
    if (is_author()) {
      return get_pagenum_link($paged);
    }
    
    /**
     * CATEGORY, TAG & CUSTOM TAXONOMY ARCHIVES
     * (Best practice for consistency across archive types)
     */
    if (is_category() || is_tag() || is_tax()) {
      return get_pagenum_link($paged);
    }
    
    return false;
  }
  
  
  /**
   * ---------------------------------------------------------
   * YOAST SEO INTEGRATION
   * Overrides Yoast canonical output for paginated archives
   */
  add_filter('wpseo_canonical', function($canonical) {
    
    $new_canonical = client_get_paginated_archive_canonical();
    
    return $new_canonical ? $new_canonical : $canonical;
  });
  
  
  /**
   * ---------------------------------------------------------
   * RANK MATH INTEGRATION
   * Overrides Rank Math canonical output for paginated archives
   */
  add_filter('rank_math/frontend/canonical', function($canonical) {
    
    $new_canonical = client_get_paginated_archive_canonical();
    
    return $new_canonical ? $new_canonical : $canonical;
  });
  
  
  /**
   * ---------------------------------------------------------
   * FALLBACK (No SEO Plugin Active)
   * Outputs canonical manually if neither Yoast nor Rank Math
   * is handling it.
   */
  add_action('wp_head', function() {
    
    // If Yoast or Rank Math is active, let them handle canonicals
    if (defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION')) {
      return;
    }
    
    $canonical = client_get_paginated_archive_canonical();
    
    if ($canonical) {
      echo '<link rel="canonical" href="' . esc_url($canonical) . "\" />\n";
    }
    
  }, 1);
