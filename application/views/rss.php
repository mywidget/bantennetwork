<?php
	echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
	
?>

<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:admin="http://webns.net/mvcb/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
	
	<channel>
		
		<title><?php echo $feed_name; ?></title>
		
		<link><?php echo $feed_url; ?></link>
		<description><?php echo $page_description; ?></description>
		<dc:language><?php echo $page_language; ?></dc:language>
		<dc:creator><?php echo $creator_email; ?></dc:creator>
		
		<dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
		<admin:generatorAgent rdf:resource="<?=$feed_website;?>" />
		
		<?php foreach($posts as $row):
			$thnt = folderthn($row->folder);
			$blnt = folderbln($row->folder);
			$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row->gambar;
			$size = @getimagesize($opathFile);
			if($size !== false){
				$gambar = site_url().'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row->gambar;
				}else{
				$gambar = site_url()."assets/no_photo.jpg";
			}
			$isi = cleanString(character_limiter($row->postingan,80));
		?>
		
		<item>
			<title><?php echo xml_convert($row->judul); ?></title>
			<link><?php echo site_url("detail/".$row->judul_seo); ?></link>
			<guid><?php echo site_url("detail/".$row->judul_seo); ?></guid>
			<description><![CDATA[<?php echo $isi;?>]]></description>
			<pubDate><?=$row->tanggal;?></pubDate>
		</item>
		
		<?php endforeach; ?>
	</channel>
</rss>