<?php echo '<?xml version="1.0" encoding="UTF-8"?>';  ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
    </url>
    <url>
        <loc>{{ url('/blog') }}</loc>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
    </url>
    @foreach ($products as $product)
        <url>
            <loc>{{ route('product',['slug'=>$product->slug]) }}</loc>
        </url>
    @endforeach
    @foreach ($categories as $category)
        <url>
            <loc>{{ route('category',['slug'=>$category->slug]) }}</loc>
        </url>
    @endforeach
    @foreach ($articles as $article)
        <url>
            <loc>{{ route('article',['slug'=>$article->slug]) }}</loc>
        </url>
    @endforeach
    @foreach ($pages as $page)
        <url>
            <loc>{{ route('page',['slug'=>$page->slug]) }}</loc>
        </url>
    @endforeach
</urlset>
