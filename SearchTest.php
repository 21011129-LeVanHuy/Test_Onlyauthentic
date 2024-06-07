<?php include('partials-front/header.php'); ?>
<?php
    if(isset($_POST['search'])){
        $search = $_POST['search'];
    }
?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang chủ</a></span></p>
            <h1 class="mb-0 bread">Danh sách hàng <?php if(isset($search)){echo $search; } ?> bạn vừa tìm</h1>
          </div>
        </div>
      </div>
    </div>
    

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-8 col-lg-10 order-md-last">
    				<div class="row">
                        <?php
                            if(isset($_POST['search'])){
                                $search = $_POST['search']; 

                                $sql = "SELECT * FROM tbl_products WHERE title LIKE '%$search%'";

                                $res = mysqli_query($conn, $sql); 

                                $count = mysqli_num_rows($res);

                                if($count>0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $id = $row['id']; 
                                        $title = $row['title']; 
                                        $price = $row['price']; 
                                        $image_name = $row['image_name']; 

                                        ?>
                                            <div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
                                                <div class="product d-flex flex-column">
                                                    <?php
														if($image_name == ""){
															echo "<div class='error'>Lỗi ảnh</div>";
														}else{
															?>
																<a href="product-single.php?id=<?php echo $id; ?>" class="img-prod"><img class="img-fluid" src="<?php echo SITEURL; ?>img/product/<?php echo $image_name; ?>" alt="Colorlib Template">
																	<div class="overlay"></div>
																</a>
															<?php
														}
													?>
                                                    <div class="text py-3 pb-4 px-3">
                                                        <div class="d-flex">
                                                        </div>
                                                        <h3><a href="#"><?php echo $title; ?></a></h3>
                                                        <div class="pricing">
                                                            <p class="price"><span><?php echo number_format($price); ?> VND</span></p>
                                                        </div>
                                                        <p class="bottom-area d-flex px-3">
                                                            <a href="cart-action.php?id=<?php echo $id; ?>" class="add-to-cart text-center py-2 mr-1"><span>Thêm vào giỏ <i class="ion-ios-add ml-1"></i></span></a>
                                                            <a href="product-single.php?id=<?php echo $id; ?>" class="buy-now text-center py-2">Mua ngay<span><i class="ion-ios-cart ml-1"></i></span></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }else{
                                    echo "Sản phẩm bạn vừa tìm không tồn tại";
                                }
                            }else{
                                echo "Bạn chưa nhập vào ô tìm kiếm hoặc sản phẩm bạn vừa tìm không tồn tại.";
                            }
                        ?>

		    		</div>
		    		<div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
		                <li><a href="#">&lt;</a></li>
		                <li class="active"><span>1</span></li>
		                <li><a href="#">2</a></li>
		                <li><a href="#">3</a></li>
		                <li><a href="#">4</a></li>
		                <li><a href="#">5</a></li>
		                <li><a href="#">&gt;</a></li>
		              </ul>
		            </div>
		          </div>
		        </div>
		    	</div>

		    	<div class="col-md-4 col-lg-2">
		    		<div class="sidebar">
							<div class="sidebar-box-2">
								<h2 class="heading">Tìm sản phẩm</h2>
								<form method="POST" class="colorlib-form-2" action="<?php echo SITEURL; ?>search.php">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Tìm..." name="search"><br>
                                            <input type="submit" value="Tìm" name="submit" class="btn btn-primary py-3 px-5">
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
    			</div>
    		</div>
    	</div>
    </section>
		
		<section class="ftco-gallery">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-8 heading-section text-center mb-4 ftco-animate">
            <h2 class="mb-4">Theo dõi chúng tôi qua Instagram</h2>
            <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p> -->
          </div>
    		</div>
    	</div>
    	<div class="container-fluid px-0">
    		<div class="row no-gutters">
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-1.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(https://cdn.nguyenkimmall.com/images/product/859/10054737-dien-thoai-samsung-galaxy-s23-ultra-8gb-256gb-den-1.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-2.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(https://png.pngtree.com/thumb_back/fw800/background/20230616/pngtree-modern-desktop-computer-at-a-sleek-working-desk-in-a-stunning-image_3621008.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-3.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(https://laptop88.vn/media/news/2806_cau-tao-ban-phim-co.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-4.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(https://dep365.com/wp-content/uploads/2021/12/chup-anh-selfie-truoc-guong-voi-camera-che-nua-mat-edited.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-5.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(https://news.phongcachxanh.vn/wp-content/uploads/2021/03/newsphongcachxanh_top-chuot-choi-game-tot-nhat-2021.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-6.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(https://cdn.vjshop.vn/tin-tuc/diem-danh-8-may-anh-compact-tot-nhat-nam-2021/anh-dai-dien.jpeg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
        </div>
    	</div>
    </section>

	<?php include('partials-front/footer.php'); ?>