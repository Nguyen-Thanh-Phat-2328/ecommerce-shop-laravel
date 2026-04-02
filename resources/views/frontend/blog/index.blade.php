@extends('frontend.layouts.app')
@section('content')
    <div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<?php
                            foreach ($blogs as $key => $value) {
                                ?>
                                    <div class="single-blog-post">
                                        <h3>{{ $value->title }}</h3>
                                        <div class="post-meta">
                                            <ul>
                                                <li><i class="fa fa-user"></i> {{ $value->id_user }}</li>
                                                <li><i class="fa fa-clock-o"></i> {{ $value->created_at->format('g:i a') }}</li>
                                                <li><i class="fa fa-calendar"></i> {{ $value->created_at->format('M j, Y') }}</li>
                                            </ul>
                                            <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                            </span>
                                        </div>
                                        <a href="">
                                            <img src="{{ asset('/upload/blog/image/'.$value->image) }}" alt="">
                                        </a>
                                        <p>{{ $value->description }}</p>
                                        <a class="btn btn-primary" href="{{ url('/frontend/blog/detail/'.$value->id) }}">Read More</a>
                                    </div>
                                <?php
                            }
                        ?>

                        <br>
                        {{ $blogs->links('pagination::bootstrap-4') }}

					</div>
@endsection