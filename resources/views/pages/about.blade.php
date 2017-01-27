@extends('layouts.pages')

@section('title', 'About')
@section('active3', 'active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<h2><a href="#introduction">Introduction</a></h2>
            <p>Laravel's database query builder provides a convenient, fluent interface to creating and running database queries. It can be used to perform most database operations in your application and works on all supported database systems.</p>
            <p>The Laravel query builder uses PDO parameter binding to protect your application against SQL injection attacks. There is no need to clean strings being passed as bindings.</p>
            <p><a name="retrieving-results"></a></p>
            <h2><a href="#retrieving-results">Retrieving Results</a></h2>
            <h4>Retrieving All Rows From A Table</h4>
            <p>You may use the <code class=" language-php">table</code> method on the <code class=" language-php"><span class="token constant">DB</span></code> facade to begin a query. The <code class=" language-php">table</code> method returns a fluent query builder instance for the given table, allowing you to chain more constraints onto the query and then finally get the results using the <code class=" language-php">get</code> method:</p>
            <pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>DB</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Show a list of all of the application's users.
     *
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">index<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'user.index'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'users'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$users</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
        </div>
    </div>
</div>        
@endsection