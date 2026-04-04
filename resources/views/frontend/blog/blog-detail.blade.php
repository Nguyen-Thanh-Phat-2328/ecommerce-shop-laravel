@extends('frontend.layouts.app')
@section('content')
	{{-- <p>Rating: {{ $rateRound }}/5</p> --}}
    <div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{ $blogCurrent->title }}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> {{ $blogCurrent->id_user }}</li>
									<li><i class="fa fa-clock-o"></i> {{ $blogCurrent->created_at->format('g:i a') }}</li>
									<li><i class="fa fa-calendar"></i> {{ $blogCurrent->created_at->format('M j, Y') }}</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
							</div>
							<a href="">
								<img src="{{ asset('/upload/blog/image/'.$blogCurrent->image) }}" alt="">
							</a>

							{!! $blogCurrent->content !!}
							
							<div class="pager-area">
								<ul class="pager pull-right">

                                    @if ($blogPrev)
                                        <li><a href="{{ url('frontend/blog/detail/'.$blogPrev->id) }}">Pre</a></li>
                                    @endif
									@if ($blogNext)
                                        <li><a href="{{ url('frontend/blog/detail/'.$blogNext->id) }}">Next</a></li>
                                    @endif

								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<div class="ratings">
							<h4 class="rate-this li">Rate this item:</h4>
							<div class="rate li">
								<div class="vote">
									<div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
									<div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
									<div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
									<div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
									<div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
									<span class="rate-np">{{ $rateRound }}/5</span>
								</div> 
							</div>
							<p class="color li">({{ $rateCount }} votes)</p>
						</div>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="images/blog/socials.png" alt=""></a>
					</div><!--/socials-share-->

					<div class="response-area">
						<h2>3 RESPONSES</h2>
						<ul class="media-list">

						</ul>
					</div><!--/Response-area-->
					<div class="replay-box" id="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								
								<div class="text-area">
									<div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<textarea name="message" rows="11"></textarea>
									<a class="btn btn-primary">post comment</a>
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
@endsection

@section('script')
	<script>

    	$(document).ready(function(){
			//tính rate khi load trang
			if({{ $rateRound }} > 0) {
				$('.ratings_stars').removeClass('ratings_over');
				$('.ratings_stars').each(function() {
					var valueStar = $(this).find('input').val();
					if(valueStar <= {{ $rateRound }}) {
						$(this).addClass('ratings_over');
					}
				})
			}
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
				var checkLogin = "{{ Auth::Check() }}";
				// alert(checkLogin);
				if(checkLogin) {
					var rate = $(this).find("input").val();
					var starIsClick = $(this);

					$.ajax({
						type: 'POST',
						url: '{{ url("frontend/blog/rate/ajax") }}',
						data: {
							rate: rate,
							id_blog: {{ $blogCurrent->id }}
						},
						success: function(data) {
							console.log(data);
							if(data.status == 'success') {
								alert(rate);
								if (starIsClick.hasClass('ratings_over')) {
									$('.ratings_stars').removeClass('ratings_over');
									starIsClick.prevAll().andSelf().addClass('ratings_over');
								} else {
									starIsClick.prevAll().andSelf().addClass('ratings_over');
								}
								alert(data.message);
							} else {
								alert(data.message);
							}
						}
					});

				} else {
					alert('Vui lòng login');
				}
		    });

			let levelComment = 0;
			let comments = @json($comments);
			let parentComments = comments.filter(comment => comment.level === 0);
			let childComments = comments.filter(comment => comment.level !== 0);

			//comment
			$('.btn-primary').click(function(){
				var checkLogin = "{{ Auth::Check() }}";
				if(checkLogin) {
					$.ajax({
						type: 'POST',
						url: '{{ url("frontend/blog/comment/ajax") }}',
						data: {
							id_blog: {{ $blogCurrent->id }},
							comment: $('textarea[name="message"]').val(),
							level: levelComment
						},
						success: function(data) {
							if(data.status == 'success') {
								alert('Bình luận thành công');
								if(levelComment == 0) {
									parentComments = [data.comment, ...parentComments];
								} else {
									childComments = [data.comment, ...childComments];
								}
								$('.media-list').html('');
								renderComment();
								//reset về cmt cha
								levelComment = 0;
							} else {
								alert('Bình luận thất bại');
							}
							// console.log(data.comment);
						}
					})
				} else {
					alert('Vui lòng login');
				}
			});

			function renderComment() {
				const commentList = $('.media-list');
				let baseUrl = "{{ asset('upload/user/avatar') }}/";

				parentComments.forEach(function(comment) {
					commentList.append(
						`<li class="media">		
							<a class="pull-left" href="#">
								<img class="media-object" style="width: 100px; height: 100px;" src="${baseUrl + comment['avatar_user']}" alt="">
							</a>
							<div class="media-body">
								<ul class="sinlge-post-meta">
									<li><i class="fa fa-user"></i>${comment['name_user']}</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<p>${comment['comment']}</p>
								<a class="btn btn-primary parent-cmt" href="#replay-box" level="${comment['id']}"><i class="fa fa-reply"></i>Replay</a>
							</div>
						</li>`
					);

					//cmt con
					childComments.forEach(function(childComment) {
						if(childComment['level'] === comment['id']) {
							commentList.append(
								`<li class="media second-media">		
									<a class="pull-left" href="#">
										<img class="media-object" style="width: 100px; height: 100px;" src="${baseUrl + childComment['avatar_user']}" alt="">
									</a>
									<div class="media-body">
										<ul class="sinlge-post-meta">
											<li><i class="fa fa-user"></i>${childComment['name_user']}</li>
											<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
											<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
										</ul>
										<p>${childComment['comment']}</p>
										<a class="btn btn-primary"><i class="fa fa-reply"></i>Replay</a>
									</div>
								</li>`
							);
						}
				});
				});

			}

			//gọi comment sau khi load trang
			renderComment();

			//lấy id cmt cha khi reply
			$('.media-list').on('click', '.parent-cmt', function() {
				levelComment = $(this).attr('level');
				// alert(levelComment);
			})
		});
    </script>
@endsection
	


