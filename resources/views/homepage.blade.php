@extends('layouts.grayscale')


@section('content')
<!-- Intro Header -->
<header class="masthead">
  <div class="intro-body">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto" style="background-color: rgba(0, 0, 0, 0.6)">
          <h1 class="brand-heading">Book Up</h1>
          <p class="intro-text">A new dating option for people who like people who like books</p>
          <a href="#about" class="btn btn-circle js-scroll-trigger">
            <i class="fa fa-angle-double-down animated"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- About Section -->
<section id="about" class="content-section text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>How Bookup Works</h2>
        <p>Put in your details. Enter your favourite books and some defiite no-nos. We will match you up with people near you who have similar intresets. Whether that's for friendship or for relentless boning is entirely up to you.</p>
      </div>
    </div>
  </div>
</section>

<!-- Download Section -->
<section id="download" class="download-section content-section text-center">
  <div class="container">
    <div class="col-lg-8 mx-auto">
      <h2>Download Grayscale</h2>
      <p>You can download Grayscale for free on the preview page at Start Bootstrap.</p>
      <a href="http://startbootstrap.com/template-overviews/grayscale/" class="btn btn-default btn-lg">Visit Download Page</a>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section id="contact" class="content-section text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>Contact Start Bootstrap</h2>
        <p>Feel free to leave us a comment on the
          <a href="http://startbootstrap.com/template-overviews/grayscale/">Grayscale template overview page</a>
          on Start Bootstrap to give some feedback about this theme!</p>
        <ul class="list-inline banner-social-buttons">
          <li class="list-inline-item">
            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg">
              <i class="fa fa-twitter fa-fw"></i>
              <span class="network-name">Twitter</span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://github.com/BlackrockDigital/startbootstrap" class="btn btn-default btn-lg">
              <i class="fa fa-github fa-fw"></i>
              <span class="network-name">Github</span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg">
              <i class="fa fa-google-plus fa-fw"></i>
              <span class="network-name">Google+</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

@endsection