@extends('layouts.home')

@section('content')

    <section id="content" class="jumbotron jumbotron-home">
        <div class="container">
            <div class="jumbotron-home-wrap col-xs-12 col-sm-8 col-md-6">
                <h1>{{ trans('static.home_jumboTitle') }}</h1>

                <p>{{ trans('static.home_jumboDesc') }}</p>
            </div>
        </div>
    </section>

    <section class="container">
        <p class="lead text-center">{{ trans('static.home_leadParagraph') }}</p>

        <div class="row">
            <div class="col-sm-4 home-feature-container">
                <div class="home-feature-icon home-feature-icon-search"><i class="fa fa-search"></i></div>
                <h2 class="text-center">{{ trans('static.home_featureSearchTitle') }}</h2>
                {{ trans('static.home_featureSearchDesc') }}
            </div>

            <div class="col-sm-4 home-feature-container">
                <div class="home-feature-icon home-feature-icon-browse"><i class="fa fa-comment"></i></div>
                <h2 class="text-center">{{ trans('static.home_featureBrowseTitle') }}</h2>
                {{ trans('static.home_featureBrowseDesc') }}
            </div>

            <div class="col-sm-4 home-feature-container">
                <div class="home-feature-icon home-feature-icon-write"><i class="fa fa-pencil"></i></div>
                <h2 class="text-center">{{ trans('static.home_featureWriteTitle') }}</h2>
                {{ trans('static.home_featureWriteDesc') }}
            </div>
        </div>

        <div class="row">
            <!-- Facebook social plugin -->
            <div class="col-sm-6">
                <div class="fb-like-box" data-href="http://www.facebook.com/cityuge" data-width="380" data-height="270"
                     data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false"
                     data-show-border="false"></div>
            </div>

            <div id="testimonial" class="col-sm-6">
                <blockquote>
                    <p>Quite useful and systematic.</p>
                    <small><cite>Christine (<abbr title="BEng - Information Engineering">BEIE</abbr>)</cite></small>
                </blockquote>
                <blockquote>
                    <p>The website is a useful reference for us to choose favorable GE courses by providing detailed
                        information.</p>
                    <small><cite>Stephen (<abbr title="BBA - Electronic Commerce">BBAEC</abbr>)</cite></small>
                </blockquote>
                <blockquote>
                    <p>It is very useful and help us to know more about GE courses.</p>
                    <small><cite>Kasu (<abbr title="BBA - Human Resources Management">BBAHRM</abbr>)</cite></small>
                </blockquote>
                <blockquote>
                    <p>The website is good and well-organized.</p>
                    <small><cite>Jay (<abbr title="BEng (Undeclared Major)">BENG</abbr>)</cite></small>
                </blockquote>
                <blockquote>
                    <p>很有參考價值，選科時可作參考。</p>
                    <small><cite>Ling (<abbr title="BSocSc - Social Work">BSSSW</abbr>)</cite></small>
                </blockquote>
            </div>
        </div>
    </section>


    <!-- For Facebook social plugin -->
    <div id="fb-root"></div>

@stop


@section('footerScript')
    @parent
    <script>
        // Testimonial
        function fadeTestimonial(index, $elements) {
            $elements.eq(index)
                    .fadeIn(1000)
                    .delay(4000)
                    .fadeOut(1000, function () {
                        fadeTestimonial((index + 1) % $elements.length, $elements);
                    });
        }
        var testimonials = $('#testimonial > blockquote');
        testimonials.hide();
        fadeTestimonial(0, testimonials);

        // Facebook social plugin
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=722255341119564";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

@stop
