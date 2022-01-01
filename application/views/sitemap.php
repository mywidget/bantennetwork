<?php 
  header('Content-type: application/xml; charset="ISO-8859-1"',true);  
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
     <loc><?php echo base_url();?></loc>
     <priority>1.0</priority>
  </url>
  <?php foreach($items as $data) { ?>
    <url>
       <loc><?php echo base_url().$data->judul_seo;?></loc>
       <priority>0.5</priority>
       <lastmod><?php echo $data->tanggal;?></lastmod>
    </url>
  <?php } ?>
</urlset>