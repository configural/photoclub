{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">
<channel>
<title>Фотоклуб Артема Кашканова</title>
<link>http://club.artem-kashkanov.ru/rss</link>
<description><![CDATA[Место общения любителей пейзажной фотографии и не только]]></description>
<atom:link href="http://club.artem-kashkanov.ru" rel="self" type="application/rss+xml" />
<language>ru</language>
<lastBuildDate>Tue, 30 Jul 2019 10:39:17 +0300</lastBuildDate>
@foreach($photo as $p)
<item>
<title><![CDATA[{{ $p->user->name}}:  {{ $p->name}}]]></title>
<link>http://club.artem-kashkanov.ru/photo/{{$p->id}}</link>
<description><![CDATA[Описание фотографии]]</description>
<pubDate>{{$p->created_at->format(DateTime::RSS)}}</pubDate>
</item>
@endforeach
</channel>
</rss>