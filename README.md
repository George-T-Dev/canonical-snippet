# canonical-snippet
Ensures paginated blog, author, and taxonomy archives.

# WordPress Paginated Archive Canonical Fix

Standardizes canonical URL behavior for paginated archive pages across all projects.

This ensures paginated blog and author archives use **self-referencing canonical URLs**, as required by modern SEO best practices.

---

## 🚨 The Problem

Some SEO plugins or themes incorrectly set canonicals like this:

| URL | Incorrect Canonical |
|-----|---------------------|
| /blog/page/2/ | /blog/ |
| /author/john/page/3/ | /author/john/ |

This can cause:
- Deindexing of deeper archive pages
- Reduced crawl depth
- Older posts becoming harder to discover
- Loss of internal link equity

Google treats paginated pages as **separate documents**, so each should have its own canonical.

---

## ✅ What This Code Does

✔ Sets **self-referencing canonicals** for paginated pages  
✔ Works automatically with **Yoast SEO**  
✔ Works automatically with **Rank Math SEO**  
✔ Provides fallback output if no SEO plugin exists  
✔ Covers:
- Blog posts index (Posts page)
- Author archives
- Category, tag, and custom taxonomy archives

---

## 🔍 Resulting Canonical Structure

| URL | Canonical Output |
|-----|------------------|
| /blog/ | /blog/ |
| /blog/page/2/ | /blog/page/2/ |
| /author/john/ | /author/john/ |
| /author/john/page/3/ | /author/john/page/3/ |
| /category/news/page/4/ | /category/news/page/4/ |

---

## 🧠 SEO Reasoning

Self-referencing canonicals for paginated pages:

- Preserve crawl paths to deeper content
- Allow search engines to index archive pages properly
- Help distribute link equity
- Prevent consolidation of all signals into page 1

This aligns with Google’s pagination handling recommendations.

---

## 🛠 Installation

Paste the PHP snippet into:

```
Appearance → Theme File Editor → functions.php
```

or into a site-specific functionality file used across projects.

---

## ⚠ Notes

- Does not modify single posts or pages
- Does not change noindex settings
- Safe to use alongside Yoast and Rank Math
- Intended as a **standard rule for all client builds**
