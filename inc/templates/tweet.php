<?php

$url = 'http://twitter.com/statuses/user_timeline/hopeinbrazil.rss';
$cache_expire = 3600; // in seconds

$ts = time();
$info_file = 'tmp-info.txt';
$cache_file = 'tmp-'.$ts.'.xml';

// current info
$info = unserialize(@file_get_contents($info_file));

if (empty($info) OR $ts > ($info['cache_ts']+$cache_expire))
{
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($ch);
	curl_close($ch);

	// if a description tag is present we're OK
	if (preg_match('/<description>/iS',$content))
	{
		file_put_contents($cache_file,$content);

		@unlink($info['cache_file']);
	}

	// known error strings: "over capacity", "rate limit exceeded"
	// else if a description tag is not present something is wrong
	else
	{
		// use current cache until errors resolve itself
		$cache_file = $info['cache_file'];

		$content = file_get_contents($info['cache_file']);
	}

	// update next cache time and cache file name
	file_put_contents($info_file,serialize(array('cache_ts'=>$ts,'cache_file'=>$cache_file)));
}
else
{
	$content = file_get_contents($info['cache_file']);
}

$feed = array();

$doc = new DOMDocument();
$doc->loadXML($content);

foreach ($doc->getElementsByTagName('item') as $node)
{
	array_push($feed, array
	(
		'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
		'desc' => preg_replace('/^\w+:/i','',$node->getElementsByTagName('description')->item(0)->nodeValue),
		'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
		'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
	));
}

function linkify_tweet($v)
{
	$v = ' ' . $v;

	$v = preg_replace('/(^|\s)@(\w+)/', '\1@<a href="http://www.twitter.com/\2">\2</a>', $v);
	$v = preg_replace('/(^|\s)#(\w+)/', '\1#<a href="http://search.twitter.com/search?q=%23\2">\2</a>', $v);

	$v = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $v);
	$v = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $v);
	$v = preg_replace("#(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $v);

	return trim($v);
} 
 
?>

<?php if (is_array($feed)): ?>

	<?php array_splice($feed,1); ?>

	<?php foreach ($feed as $item): ?>
	<p><a href="//twitter.com/hopeinbrazil">@hopeinbrazil</a> 
	<?php echo linkify_tweet($item['desc']); ?>
	</p>
	<a class="fright" href="<?php echo $item['link']; ?>">View</a>
	
	<?php endforeach; ?>
<?php endif; ?>
