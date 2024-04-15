<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ CN Blog Feed ]]></title>
        <link><![CDATA[ localhost/feed ]]></link>
        <description><![CDATA[ Laravel 11 Blog ]]></description>
        <language>en</language>
        <pubDate>{{ now()->toRssString() }}</pubDate>
  
        @foreach($posts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <link>localhost/posts/{{ $post->slug }}</link>
                <description><![CDATA[{!! $post->body !!}]]></description>
                <category>{{ $post->category->name }}</category>
                <author>{{ $post->author->name }}</author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>