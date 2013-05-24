<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
        <title><![CDATA[<?php echo $channel['title'] ?>]]></title>
        <atom:link href="<?php echo $channel['link'] ?>" rel="self" type="application/rss+xml" />
        <link><?php echo $channel['site_link'] ?></link>
        <description><![CDATA[<?php echo $channel['description'] ?>]]></description>
        <pubDate><?php echo date('D, d M Y H:i:s O', strtotime($channel['pubdate'])) ?></pubDate>
        <generator><?php echo $channel['generator'] ?></generator>
        <?php foreach($items as $item): ?>
        <item>
            <title><![CDATA[<?php echo $item['title'] ?>]]></title>
            <author><?php echo $item['author'] ?></author>
            <link><?php echo $item['link'] ?></link>
            <guid isPermaLink="true"><?php echo $item['link'] ?></guid>
            <description><![CDATA[<?php echo $item['description'] ?>]]></description>
            <pubDate><?php echo date('D, d M Y H:i:s O', strtotime($item['pubdate'])) ?></pubDate>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>