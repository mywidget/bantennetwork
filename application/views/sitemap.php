<?php
  header('Content-type: application/xml; charset="ISO-8859-1"',true);  
  $datetime1 = new DateTime(date('Y-m-d H:i:s'));
?>
 
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc><?= base_url() ?></loc>
    <lastmod><?= $datetime1->format(DATE_ATOM); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.1</priority>
  </url>
  <?php foreach($post as $item) { $datetime = new DateTime($item['dateModified']);?>
  <url>
    <loc><?= base_url($item['judul_seo']) ?></loc>
    <lastmod><?= $datetime->format(DATE_ATOM); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.5</priority>
  </url>
  <?php } ?>
</urlset>