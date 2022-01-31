@include('admin.common.header')
<?php
$routeName = CustomHelper::getAdminRouteName();
$BackUrl = CustomHelper::BackUrl();

?>


<style>
	.blk-flx{
		display: flex;
	}



	.astro-name{
		color: #FB7112 !important;
	}
	.text span{
		border: 1px solid #FB7112;
		padding: 2px 9px;
		border-radius: 21px;
		margin: 0px 1px;
		line-height: 30px;
		background-color: #fb711226;
		color: #000;

	}
	ul h6{
		line-height: 23px;
		font-size: 14px;
		font-weight: 500;
	}

	.pro-div{
		height: 50px;
		width: 50px;
		background: aqua;
		border-radius: 100%;
		text-align: center;
	}

	.gallery-div{
		height: 380px;
		width: 350px;
	}
	.gallery-div img{
		width: 100%;
		height: 100%;
	}
	.pro-div h5{
		line-height: 46px;
	}
	.language{
		line-height: 30px;
	}
	.about-me{
		line-height: 26px;
	}
	.submit-btn{
		position: absolute;
		right: 26px;
		height: 38px;
		width: 99px;

	}

	#myBtn{
		color: #FB7112;
	}
	.accordion-item .sn{


		font-weight: 700;
		color: #FB7112;
		line-height: 25px;  

		overflow: hidden;
		font-size: 15px;
		text-overflow: ellipsis;
		-webkit-box-orient: vertical;
		display: -webkit-box;
		-webkit-line-clamp: 1;
	}
	.accordion-button{
		display: block;
		width: 100%
	}
/*.accordion-body p{

    overflow: hidden;
  font-size: 15px;
  text-overflow: ellipsis;
  -webkit-box-orient: vertical;
  display: -webkit-box;
  -webkit-line-clamp: 4;

  }*/
  .accordion-header,
  .accordion-flush .accordion-item{
  	width: 100%

  }
  .gallery-del .fa-trash {
  	position: absolute;
  	top: 3px;
  	z-index: 1050;
  	height: fit-content;
  	right: 14px;
  	color: #FB7112;
  	background: #fff;
  	padding: 4px;
  	font-size: 12px;
  	/* display: -webkit-box; */
  	border-radius: 8px;

  }

  .fa-trash {
  	position: relative;
  	bottom:  0px;
  	z-index: 1050;
  	right: 0px;
  	color: #FB7112;
  	background: #fff;
  	padding: 7px;
  	display: -webkit-box;
  	border-radius: 8px;
  }
  .status {
  	position: relative;
  	right: 2%;
  	margin-left: auto;
  	background-color: #fa6374;
  	color: #fff;
  }

  input[type=file]::file-selector-button,
  {
  	border: 1px solid #FB7112;
  	color: black;

  	border-radius: .2em;
  	background-color: #8b00009c  !important;
  	transition: 1s;
  }


  .btn-primary{
  	background-color: #FB7112;
  	border-color: #FB7112;
  }

  .close{
  	border:none;
  	border-radius: 100%;
  	background-color: #fa6374;
  	color: #fff;
  	width: 31px;
  	height: 31px;
  }

  .edit_faq_hide{
  	background: #fb711261;
  	padding: 16px 8px;
  	border-radius: 8px;
  	display: none;
  } #more {display: none;}

  .btn-info {
  	color: #fff;
  	background-color: #fb7112;
  	border-color: #fb7112;
  }
  .starrating > input {display: none;}  /* Remove radio buttons */
  .starrating > label i{
  	font-size: 34px;
  }

  .starrating > label
  {
  	color: #222222;

  	margin: 0 5px; /* Start color when not clicked */
  }

  .starrating > input:checked ~ label
  { color: #ffca08 ; } /* Set yellow color when star checked */

  .starrating > input:hover ~ label
  { color: #ffca08 ; } /* Set yellow color when star hover */


  .view_detail{
  	display: none;
  	padding: 10px
  }


  .card-title{
  	font-weight: 400;
  }
  .card-title b{
  	color: #7f6755;
  	margin-right: 8px;
  	font-weight: 500;
  }
  .gen-btn{
  	position: absolute;
  	/* display: block; */
  	color: #FB7112;
  	right: 18px;
  	border: 1px solid;
  	margin: 8px 2px;
  	width: fit-content;
  	padding: 6px 9px;
  	border-radius: 5px;
  }
  .repotr--{
  	color: #FB7112;
  	padding: 6px 9px;
  	margin: 8px 2px;
  	font-weight: 600;
  	text-align: center;

  }
  .card_info{
  	width: 472px;

  	margin-left: auto;margin-right: auto;
  	border:1px solid rgb(218 218 253 / 65%);
  }


  @media screen and (max-width: 767px){
  	.pro-div{
  		width: 209px;


  	}

  	.blk-flx{
  		display: block;
  	}
  	.gen-btn{
  		left: 0;
  		top:5%;
  		position: relative;
  	}

  	.card_info{
  		width: auto;
  		box-shadow: none;

  	}
  }
</style>

<div class="row">
	<div class="col-12">
		<div class="page-title-box d-flex align-items-center justify-content-between">
			<h4 class="mb-0">Astrologer Profile</h4>

			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
					<a href="{{ url($back_url)}}" style="float:right"><button type="button" class="btn btn-info d-lg-block m-l-15 text-white"><i
						class="fa fa-arrow-left"></i>  Back</button></a>
					<?php } ?>
				</ol>
			</div>

		</div>
	</div>
</div>   


<div class="row mb-4">

	<!--------------------- /////////////  SIDECONTENT ASTRO /////////////  ---------------->

	
	<div class="col-xl-4">
		<div class="card overflow-hidden">
			<div class="profile-user"></div>
			<div class="card-body">
				<div class="profile-content ">
					<div class="profile-user-img text-center">

						<?php

						$image = isset($astro_details->image) ? $astro_details->image : '';
						$storage = Storage::disk('public');
						$path = 'astrologers';

						if(!empty($image))
						{
							?>

							<a href="{{ url('public/storage/'.$path.'/'.$image) }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/'.$image) }}" class="avatar-lg rounded-circle img-thumbnail"></a>

						<?php }else{ ?>
							<a href="{{ url('public/storage/'.$path.'/default.jpg') }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/default.jpg') }}" class="avatar-lg rounded-circle img-thumbnail"></a>
						<?php } ?>

					</div>
					<h5 class="mt-3 mb-3 astro-name">{{$astro_details->name ?? ''}}</h5>                
					<p class="text"> <b><i class="fas fa-cogs"></i> Expertises: </b> 
						<?php                
						$types = explode(',',$astro_details->type);
						if(!empty($types))
						{
							foreach($types as $value)
							{

								$typoo = \App\Expertise::select('name')->where('id',$value)->first();                          
								if($typoo)
								{
									?>
									<span> <?php echo $typoo->name ?? ''; ?></span>

									<?php  
								}
							}
						}
						?>

					</p>
					<p class="text"><b><i class="fas fa-award"></i> Experience: </b>{{$astro_details->experience }} years</p>

					<p class="text language"><b><i class="fas fa-language"></i> Language Known:</b>
						<?php                
						$languages = explode(',',$astro_details->language);
						if(!empty($languages))
						{
							foreach($languages as $value)
							{

								$lang = \App\Language::select('name')->where('id',$value)->first();
                          // DB::enableQueryLog();
								if($lang)
								{
									?>
									<span><?php echo $lang->name ?? ''; ?></span>

									<?php  
								}
							}
						}
						?>
					</p>
					<p class="text">
						<b><i class="fas fa-comment"></i> 
							Chat:
						</b> 
						8K
						mins
					</p>
					<p class="text">
						<b><i class="fas fa-phone-square-alt"></i> Call:
						</b>7K
						mins
					</p>
					<p class="text">
						<b><i class="fas fa-phone-square-alt"></i> Wallet: 
						</b>{{$astro_details->wallet}}
						mins
						&nbsp;&nbsp;&nbsp;<a href="" class="btn btn-primary btn-sm" id="add_wallet" data-toggle="modal" data-target="#myModal">+ Add</a></p>


						<!-- The Modal -->
						<div class="modal" id="myModal" data-aos="zoom-in-up">
							<div class="modal-dialog">
								<div class="modal-content">
									  @include('snippets.errors')
    								  @include('snippets.flash')



									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Add Money to Wallet</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<form action='{{route("admin.astrologer.add_wallet")}}' id="wallet_form" method='post'>
										<div class="modal-body">                    
											@csrf
											<input type="hidden" value="{{$astro_details->id}}" id="astro_walletid" name="astro_id">
											<div>
												<select class="form-control" id="amount_type" name="amount_type">
													<option value='' selected disabled>Select Type</option>
													<option value='DEBIT'>Debit</option>
													<option value='CREDIT'>Credit</option>
												</select>
											</div>
											<div class="form-group d-flex" style="position: relative;">
												<input type="number" class="form-control" id="wallet_amount" aria-describedby="emailHelp" placeholder="Enter Amount" name="amount">                       
											</div>                        
											<div class="form-group d-flex" style="position: relative;">
												<textarea class="form-control" id="wallet_description" aria-describedby="emailHelp" placeholder="Enter Description" name="description"></textarea>                    
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-info btn-sm">Submit</button>
											<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
										</div>
									</form>


								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		
		<!----------------- /////////  SIDECONTENT ASTRO END //////////////////  ---------------------->


		<div class="col-xl-8">
			<div class="card mb-0">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
					<li class="nav-item">
						<a class="nav-link <?php if($tabs == 'about') echo "active";?>" data-bs-toggle="tab" href="#about" role="tab" aria-selected="true">
							<i class="bx bx-user-circle font-size-20"></i>
							<span class="d-none d-sm-block">About</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($tabs == 'transaction') echo "active";?>" data-bs-toggle="tab" href="#transactions" role="tab" aria-selected="false">
							<i class="fas fa-credit-card"></i>

							<span class="d-none d-sm-block">Transaction History</span> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($tabs == 'rating') echo "active";?>" data-bs-toggle="tab" href="#rating" role="tab" aria-selected="false">
							<i class="bx bx-mail-send font-size-20"></i>
							<span class="d-none d-sm-block">Rating & Reviews</span>   
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link <?php if($tabs == 'gallery') echo "active";?>"  data-bs-toggle="tab" href="#gallery" role="tab" aria-selected="false">
							<i class="fas fa-image font-size-20"></i></i>
							<span class="d-none d-sm-block">Gallery</span>   
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link <? if($tabs == 'faqs') echo "active"; ?>"  data-bs-toggle="tab" href="#faqs" role="tab" aria-selected="false">
							<i class="fa fa-question font-size-20"></i>
							<span class="d-none d-sm-block">Asked Questions</span>   
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link <?php if($tabs == 'report_list') echo "active";?>" data-bs-toggle="tab" href="#report_list" role="tab" aria-selected="false">
							<i class="fa fa-file font-size-20"></i>
							<span class="d-none d-sm-block">Report List</span>   
						</a>
					</li>




				</ul>

	<!-- ///////////////////////////////////  TABS ///////////////////////////////////////////////////////  -->

		<div class="tab-content p-4">
					<!-- /////////////////   ABOUT TAB ///////////////////  -->

					<div class="tab-pane <?php if($tabs == 'about') echo "active";?>" id="about" role="tabpanel">
						<div>
							<div>
								<h5 class="font-size-16 mb-4">About Me</h5>
								<p class="about-me">
									{{$astro_details->about}}
								</p>


							</div>           

						</div>
					</div>

				<!-- /////////////////   ABOUT TAB END ///////////////////  -->

					<!-- ///////////////////////////  TRANSACTION TAB  //////////////////////////// -->

					<div class="tab-pane <?php if($tabs == 'transaction') echo "active";?>" id="transactions" role="tabpanel">
						<div>               
							<div class="table-responsive">
								<table id="examplestate" class="table display table-striped border no-wrap">
									<thead>
										<tr>										
											<th>Amount</th>
											<th>Amount Type</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($transactions as $transact){ 
											if(!empty($transact->user_id))
											{
											$user_name = App\User::select('name')->where('id',$transact->user_id)->first();
											}
											?>
											<tr>												
												<td>{{$transact->amount ?? ''}}</td>
												<td>{{$transact->amount_type ?? ''}}</td>
												<td>{{$transact->description ?? ''}}</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								{{$transactions->appends(['transaction' => $transactions->currentPage()])->links('admin.pagination')}}  
							</div>
						</div>
					</div>

			    <!-- ///////////////////////////  TRANSACTION TAB END  //////////////////////////// -->


				<!------ /////////////////////  RATING TAB ////////////////////////////------------>

					<div class="tab-pane <?php if($tabs == 'rating') echo "active";?>" id="rating" role="tabpanel">
						<div>
							<div data-simplebar="init" style="max-height: 430px;">
								<div class="simplebar-wrapper" style="margin: 0px;">
									<div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div>
								</div>
								<div class="simplebar-mask">
									<div class="simplebar-offset" style="right: 0px; bottom: 0px;">
										<div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
											<div class="simplebar-content" style="padding: 0px;">
												@foreach($rating as $rate)
												<div class="d-flex align-items-start border p-4">
													<div class="pro-div me-5">
														<h5>
															<?php
																$user = App\User::where('id',$rate->user_id)->first();
																$user_name = $user->name ?? '';
																echo substr($user_name,0,1);
																?>
														</h5>
													</div>

													

													<div class="flex-grow-1">
														<div style="position: absolute;right: 20px;font-weight: 600;color: #FB7112;" role="button">
															<div style="margin-left: auto;">
																<a  onclick="edit_comment({{$rate->id}})" id="edit_comment{{$rate->id}}">Edit</a></div>
															</div>
														<div id="comment{{$rate->id}}" style="display:none;padding: 10px;">

															 @include('snippets.errors')
    								 				 			@include('snippets.flash')
																<form action="{{route('admin.astrologer.ratings')}}" method="POST">
																	{{csrf_field()}}
																	<input type="hidden" name="id" id="id" value="{{$rate->id}}">
																	<input type="hidden" name="user_id" id="user_id" value="{{$rate->user_id}}">
																	<input type="hidden" name="astro_id" id="astro_id" value="{{$astro_details->id}}">
																	<label>Rating:</label>
																	<div class="starrating risingstar d-flex justify-content-left flex-row-reverse my-3" style="margin-right: 55%">
																		<input type="radio" id="star1{{$rate->id}}" name="rating" value="5" /><label for="star1{{$rate->id}}" title="1 star"><i class="fa fa-star"></i></label>
																		<input type="radio" id="star2{{$rate->id}}" name="rating" value="4" /><label for="star2{{$rate->id}}" title="2 star"><i class="fa fa-star"></i></label>
																		<input type="radio" id="star3{{$rate->id}}" name="rating" value="3" /><label for="star3{{$rate->id}}" title="3 star"><i class="fa fa-star"></i></label>
																		<input type="radio" id="star4{{$rate->id}}" name="rating" value="2" /><label for="star4{{$rate->id}}" title="4 star"><i class="fa fa-star"></i></label>
																		<input type="radio" id="star5{{$rate->id}}" name="rating" value="1" /><label for="star5{{$rate->id}}" title="5 star"><i class="fa fa-star"></i></label>
																	</div>

																	<label>Comment:</label>
																	<textarea type="text" name="review" id="review" class="form-control mb-3"></textarea>
																	<button type="submit" class="btn btn-primary text-white">Submit</button>
																</form>
															</div>
															<div id="hide5{{$rate->id}}">
																<h6>                      
																	<?php  
																	$rates = $rate->rating;
																	for($i=0;$i<$rates;$i++){ 

																		?>
																		<i class="fa fa-star"></i>
																	<?php } ?>
																</h6>
																<h6>
																	{{$rate->created_at ?? ''}}
																</h6>
																<h6>
																</h6>
																<p class="text-muted">
																	{{$rate->review ?? ''}}
																</p>
																<?php
																$user = App\User::where('id',$rate->user_id)->first();
																echo $user->name ?? '';
																?>
															</div>
														</div>
													</div>
													@endforeach            

												</div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-liack simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none; height: 365px;"></div></div></div>
											</div>
										</div>

					<!------ /////////////////////  RATING TAB END  ////////////////////////////------------>


					<!------------ //////////////////   GALLERY TAB //////////////////////////---------------->


										<div class="tab-pane <?php if($tabs == 'gallery') echo "active";?>" id="gallery" role="tabpanel">
											<div>
												<div>
													<h5 class="font-size-16 mb-4">Upload Images</h5>
													<form id="gallery_form" action="{{route('admin.astrologer.gallery')}}" method="POST" enctype="multipart/form-data">
														@csrf
														<input type="hidden" name="astro_id" value="{{$astro_details->id}}">

														<div class="d-flex my-3">
															<input class="form-control" type="file" multiple name="images[]" id="images">

															<button type="submit" id="submit" class="btn btn-primary btn-sm submit-btn">Submit</button>
														</div>
													</form>
													<div class="row"> 
														<?php
														foreach($astrologer_gallery as $gallery){
															$images = isset($gallery->images) ? $gallery->images : '';
															$storage = Storage::disk('public');
															$path = 'astro_gallery';
															if(!empty($images))
															{
														?>
														<div class="col-xl-4 col-sm-6 col-xs-6 col-6 mb-3">
																	<a href="{{route($routeName.'.astrologer.img_delete', ['id'=>$gallery->id,'back_url'=>$BackUrl])}}" onclick="return confirm('Are You Want To Delete ?')" class="gallery-del"><i class="fas fa-trash"></i></a>

																	<a href="{{ url('public/storage/'.$path.'/'.$images) }}" class="gallery-div" target="blank"> 
																		<img class="card img-fluid" src="{{ url('public/storage/'.$path.'/'.$images) }}">
																	</a> 
																</div>                      
															<?php } } ?>
														</div>
														{{$astrologer_gallery->appends(['gallery' => $astrologer_gallery->currentPage()])->links('admin.pagination')}}  
													</div>
												</div>
											</div>

							<!------------ //////////////////   GALLERY TAB END  //////////////////////////---------------->


						<!------------ ////////////////////  ASKED QUESTIONS TAB ///////////////// ----------------------->

											<div class="tab-pane <?php if($tabs == 'faqs') echo "active";?>" id="faqs" role="tabpanel">
												<div>
													<div>

														  @include('snippets.errors')
    								 						 @include('snippets.flash')
														<h5 class="font-size-16 mb-4">Asked Questions</h5>
														<div class="card-body p-0">
															<div class="accordion accordion-flush" id="accordionFlushExample">
																<?php if($astro_faqs){ ?>
																	@foreach($astro_faqs as $faqs)
																	<div class="accordion-item mb-2">
																		<div style="display: flex;padding: 0px 1.25rem;" class="my-2">
																			<span>
																				<a href="" class="sn">
																					{{$faqs->name ?? ''}}
																				</a>
																			</span>

																			<?php if($faqs->status == 1){ ?>
																				<span class=" btn-soft-danger status btn-sm text-truncate">	<b>Active</b></span>
																			<?php }  if($faqs->status == 0){ ?>
																				<span class=" btn-soft-danger status btn-sm text-truncate">	<b>Inactive</b></span>
																			<?php } ?>
																			<a href="{{url('admin/astrologer/delete_question'.'/'.$faqs->id)}}"><span><i class="fa fa-trash"></i></span></a>
																		</div>
																		<div class="w-100">
																			<h2 class="accordion-header d-flex" id="flush-headingOne">
																				<span class="accordion-button fw-medium collapsed active" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$faqs->id}}" aria-expanded="false" aria-controls="flush-collapseOne"> 
																					{!! $faqs->question ?? '' !!}
																				</span>
																			</h2>
																			<div id="flush-collapseOne{{$faqs->id}}" class="accordion-collapse collapse active" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
																				<div class="accordion-body text-muted">
																					{!! $faqs->ans ?? '' !!}
																				<!-- <p> After your sign up/sign in with OnlineAstroTalk, you need to recharge your Astroguru Wallet with a sufficient amount. Once your Wallet is recharged, <span id="dots">...</span><span id="more">you can call your preferred astrologer from our panel, by simply clicking on the CALL button against the chosen astrologer. After your sign up/sign in with OnlineAstroTalk, you need to recharge your Astroguru Wallet with a sufficient amount. Once your Wallet is recharged, After your sign up/sign in with OnlineAstroTalk, you need to recharge your Astroguru Wallet with a sufficient amount. Once your Wallet is recharged, After your sign up/sign in with OnlineAstroTalk, you need to recharge your Astroguru Wallet with a sufficient amount. Once your Wallet is recharged,  After your sign up/sign in with OnlineAstroTalk, you need to recharge your Astroguru Wallet with a sufficient amount.  After your sign up/sign in with OnlineAstroTalk, you need to recharge your Astroguru Wallet with a sufficient amount.  After your sign up/sign in with OnlineAstroTalk, you need to recharge your Astroguru Wallet with a sufficient amount.
																				</span> -->

																				<span onclick="myFunction()" id="myBtn" role="button">Read more</span>
																			</p>
																		</div>
																		<button type="submit" onclick="edit_btn({{$faqs->id}})" class="btn btn-info btn-sm mb-3 mx-3" style="margin-left: auto;">Edit FAQ</button>															
																	<form action="{{ route('admin.astrologer.edit_faqs')}}" method="POST">
																		{{ csrf_field() }}
																		<input type="hidden" name="id" value="{{$faqs->id}}">
																		<div id="edit_faq{{$faqs->id}}" class="edit_faq_hide" style = "display: none;">
																			<div><label>Question:</label>
																				<textarea class="form-control" id="question{{$faqs->id}}" name="question" placeholder="Enter Question">	
																					{!!$faqs->question!!}
																				</textarea>
																			</div>
																			<div>
																				<label>Answer:</label>
																				<textarea class="form-control" id="answer{{$faqs->id}}" name="ans" placeholder="Enter Answer">
																					{!!$faqs->ans!!}
																				</textarea>
																			</div>
																			<button class="btn btn-primary btn-sm mt-2" type="submit">Submit</button>
																		</div>
																	</form>
																	</div>
																</div>
															</div>
															@endforeach
														<?php } ?>
														{{$astro_faqs->appends(['faqs' => $astro_faqs->currentPage()])->links('admin.pagination')}}  

													</div><!-- end accordion -->
												</div>
											</div>
										</div>
									</div>

						<!------------////////////////////  ASKED QUESTIONS TAB END ///////////////// ----------------------->

						<!--------------------/////////////// REPORT LIST ////////////////////////---------------------->

									<div class="tab-pane <?php if($tabs == 'report_list') echo "active";?>" id="report_list" role="tabpanel">
										<div>									
											
											@foreach($report as $rp)
											<?php
												$type = $rp->report_type;
												$report_name = App\Report_Type::select('type')->where('id',$type)->first();
											?>
											<p class="about-me">
												Read Your <b>{{$report_name->type ?? ''}}</b><span style="float: right;color: #FB7112;" role="button"  onclick="view_report(<?php echo $rp->id; ?>)"><b>View</b></span>
											</p>
											<div class="card card_info view_detail" id="view_detail<?php echo $rp->id; ?>">	
												<h4 class="repotr--">{{$report_name->type ?? ''}} </h4>
												<a href="" class="gen-btn" id="gen_btn<?php echo $rp->id; ?>">
													<span>
														<i class="fas fa-download"></i>
													</span>
													<b>
														Generate Report
													</b>
												</a>
												<div class="card-body" >
													<h4 class="card-title mb-3" ><b style="color: #FB7112;">{{$rp->first_name ?? ''}} {{$rp->last_name ?? ''}}</b> </h4>
													<div style="float: right56">
														<h4 class="card-title mb-3"> <b>Marital Status</b> {{$rp->marital_status ?? ''}} </h4>
														<h4 class="card-title mb-3"> <b>Occupation</b> {{$rp->occupation ?? ''}} </h4>
													</div>
													<h4 class="card-title mb-3"> <b>Mobile no:</b>{{$rp->number ?? ''}}
														<h4 class="card-title mb-3"> <b>Gender:</b> {{$rp->gender ?? ''}}
														</h4>
														<h4 class="card-title mb-3">  <b>Date Of Birth:</b> {{$rp->dob ?? ''}}</h4>
														<h4 class="card-title mb-3"> <b>Place Of Birth: </b> {{$rp->pob ?? ''}} </h4>
														<h4 class="card-title mb-3"><b>Time Of Birth: </b> {{$rp->tob ?? ''}}</h4>
														<h4 class="card-title mb-3"> <b>Address</b> {{$rp->address ?? ''}}</h4>
														<p class="card-title mb-3">
															<b>Description:</b>
															{{$rp->any_comments ?? ''}}
														</p>
													</div>
												</div>
												@endforeach
												<hr>
											</div>  
										</div>

					<!--------------------/////////////// REPORT LIST END ////////////////////////---------------------->
									</div>
								</div>
							</div>
						</div>
						@include('admin.common.footer');

						<!-- 	<input type="hidden" name="id" id="id" value="">
																	<input type="hidden" name="user_id" id="user_id" value="">
																	<input type="hidden" name="astro_id" id="astro_id" value="{{$astro_details->id}}"> -->

<script>

$("#wallet_form").submit(function() {

	//var astro_walletid = $("#astro_walletid").val();
	var amount_type = $("#amount_type").val();
	var wallet_amount = $("#wallet_amount").val();
	var wallet_description = $("#wallet_description").val();
	
	if((amount_type && wallet_amount && wallet_description) == '')
	{
		alert("Please Fill All Details !!!!");
		return false;
	}else if((amount_type == '') || (wallet_amount == '') || (wallet_description == ''))
	{
		alert("Please Fill All Details !!!!");
		return false;

	}else{
		document.getElementById("wallet_form").submit();	
		
	}

});

		$("'#").show();
		function edit_comment(rate_id){
			$('#comment'+rate_id).toggle(1000);
			$('#hide5'+rate_id).hide();
		}

		function view_report(id){
			$('#view_detail'+id).toggle(1000);

		}

		function edit_btn(id){
			CKEDITOR.replace( 'answer'+id );
			CKEDITOR.replace( 'question'+id );
			$('#edit_faq'+id).toggle(1000);

		}

		function myFunction() {
			var dots = document.getElementById("dots");
			var moreText = document.getElementById("more");
			var btnText = document.getElementById("myBtn");

			if (dots.style.display === "none") {
				dots.style.display = "inline";
				moreText.style.display = "none";

			} else {
				dots.style.display = "none";
				btnText.style.display = "none";
				moreText.style.display = "inline";
			}
		}
</script>