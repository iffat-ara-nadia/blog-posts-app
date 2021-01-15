<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href= "{{ url('/') }}">
        {{config('app.name','LSAPP1')}} </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
          
        <li class="nav-item ">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/services">Services</a>
          </li>

        <li class="nav-item">
            <a class="nav-link" href="/posts">Blog</a>
        </li>
      </ul>
      <ul class = "nav navbar-nav navbar-right">
        <li><a href="/posts/create" style="text-decoration: none">Create Post</a></li>
      </ul>
    </div>
  </div>
</nav>

