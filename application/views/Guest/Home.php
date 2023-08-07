

    <!-- book_wrap_start -->
    <div class="container-fluid back_img ">
        <div class="row">
            <div class="col-12 col-sm-2"></div>

            <div class="col-12 col-sm-8 text-center">
                <div class="row">
                    <div class="col-12 col-sm-1"></div>
                    <div class="col-12 col-sm-10">
                        <h1 class="mt-2"><b style="text-transform: uppercase;color:white !important;" > <?php echo  $this->_data['content']['main_page_heading']->content ??  'Outline Gurus'; ?></b></h1>
                    </div>
                    <div class="col-12 col-sm-1"></div>
                </div>
                
                <div class="row">
                
                    <div class="col-12 col-sm-1"></div>
                    <div class="col-12 col-sm-10" style="">
                        <p class=" mt-2 mb-2" style="text-transform: uppercase;color:white;" ><?php echo  $this->_data['content']['main_page_sub_heading']->content ?? ''; ?></p>
                    </div>
                    <div class="col-12 col-sm-1"></div>              
                  
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-5  mt-2" > 
                        <div class="row">
                            <div class="col-12 " style="max-height: 180px;min-height: 180px;" > 
                                <div class="text_div" style="text-transform: uppercase;color:white;font-weight:bold;font-size:18px;" >      
                                    <?php echo  $this->_data['content']['main_page_left_heading']->content ?? ''; ?>
                                    <?php echo  $this->_data['content']['main_page_left_sub_heading']->content ?? ''; ?>  
                                </div>
                            </div>
                            <div class="col-12 " > 
                                <a href="/buy" class="btn btn-success" style="text-transform: uppercase;color:white;font-weight:bold; " >Search Outlines</a>
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 mt-2"></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-5 mt-2" >
                        <div class="row">
                            <div class="col-12 " style="max-height: 180px;min-height: 180px;" > 
                                <div class="text_div" style="text-transform: uppercase;color:white;font-weight:bold;font-size:18px;" > 
                                    <?php echo  $this->_data['content']['main_page_right_sub_heading']->content ?? ''; ?> 
                                </div> 
                            </div>
                            <div class="col-12 " > 
                                <a href="/sell"  class="btn btn-primary " style="text-transform: uppercase;color:white;background-color:#0099CD;border-color:#0099CD;font-weight:bold;" >Get Started</a>
                            </div>
                        </div>   
                    </div>
                </div>
                
            </div>

            <div class="col-12 col-sm-2"></div>
        </div>
    
    </div>

    <!-- book_wrap_end -->


    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-12 col-lg-3  col-12 col-md-12 text-center">
                <div class="card card-body border border-0 p-0 h-100" >
                    <div class="text-center">
                        <img src="/assets/frontend/img/black-36dp/2x/outline_school_black_36dp.png" alt="course & Professor"
                            class="mt-3 rounded-circle border border-primary p-2 text-center child inline-block-child"
                            style="width:60px;">
                    </div>
                    <h4 class="card-title child mt-4" style="text-transform: capitalize;" ><?php echo  $this->_data['content']['circle_icon_1_heading']->content ??  'Made for Your Course & Professor'; ?></h4>
                    <p class="card-text"> <?php echo  $this->_data['content']['circle_icon_1_sub_heading']->content ??  'Tailored to your needs for optimal exam preparation'; ?></p> 


                </div>
            </div>
            <div class="col-sm-12 col-lg-3 col-12 col-md-12  text-center">
                <div class="card h-100 card-body border border-0  p-0 ">
                    <div class="text-center">
                        <img src="/assets/frontend/img/black-24dp/2x/outline_calculate_black_24dp.png" alt="Word count"
                            class="mr-3 mt-3 rounded-circle border border-primary p-2" style="width:60px;">
                    </div>
                    <h4 class="card-title child mt-4" style="text-transform: capitalize;">
                    <?php echo  $this->_data['content']['circle_icon_2_heading']->content ??  'Word Count'; ?></h4>
                    <p class="card-text"> <?php echo  $this->_data['content']['circle_icon_2_sub_heading']->content ??  'Longer is not always better but it doesn&#39;t hurt!'; ?></p>

                </div>
            </div>
            <div class="col-sm-12 col-lg-3 col-12 col-md-12   text-center">
                <div class="card h-100 card-body border border-0 p-0  ">
                    <div class="text-center">
                        <img src="/assets/frontend/img/chat/2x/sharp_chat_bubble_outline_black_24dp.png" alt="Ratings"
                            class="mr-3 mt-3 rounded-circle border border-primary p-2" style="width:60px;">
                    </div>
                    <h4 class="card-title child mt-4" style="text-transform: capitalize;"> <?php echo  $this->_data['content']['circle_icon_3_heading']->content ??  'Ratings & reviews'; ?></h4>
                    <p class="card-text"> <?php echo  $this->_data['content']['circle_icon_3_sub_heading']->content ??  'See prior buyers ratings and reviews'; ?></p> 
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 col-12 col-md-12   text-center">
                <div class="card h-100 card-body border border-0 p-0  ">
                    <div class="text-center">
                        <img src="/assets/frontend/img/black-36dp/2x/outline_school_black_36dp.png" alt="Satisfaction"
                            class="mr-3 mt-3 rounded-circle border border-primary p-2" style="width: 60px">
                    </div>

                    <h4 class="card-title child mt-4" style="text-transform: capitalize;"> <?php echo  $this->_data['content']['circle_icon_4_heading']->content ??  'Satisfaction Guaranteed'; ?></h4>
                    <p> <?php echo  $this->_data['content']['circle_icon_4_sub_heading']->content ??  'Not Satisfied? <br> Let us know within 24 hours and you will be able to download a similar outline for free'; ?></p>
                </div>
            </div>

        </div>
    </div>
    <!-- outlines_lecture_notes_started -->
    <!-- <div class="container-fluid row jumbotron text-center">
        <div class="col-md-12 col-lg-6 col-sm-12 col-12">
            <h1><u>Outlines</u></h1>
            <p class="text-left m-0  p-0">Not mich needs to be said about the mystical law school outline. A great tool to
                have during the semester as you learn the material and it goes without saying an absolute necessity
                during exam preparation.</p>
        </div>
        <div class="col-md-12 col-lg-6 col-sm-12 col-12">
            <h1><u>Lecture Note</u></h1>
            <p class="text-left m-0 p-0">Stop frantically typing during class. With Lecture Notes, you can worry less
                about getting every word our professor babbles and focus on listening to what they're saying. Don't
                expect these documents to be pretty. Our gurus are typing frantically in class as Professor's lecture.
                But these can be great tools to have in class so you can focus on listening and be prepared for the
                dreaded cold call.</p>
        </div>

    </div> -->
    <!-- outlines_lecture_notes_ended -->


    <!-- About us start -->
    <div class="container-fluid row bg-secondary">
        <div class="col-sm-12">
            <div class="card-group mt-4 p-5">
                <div class="row">
                <div class=" order-first col-lg-1">

                </div>
                    <div class="card bg-light col-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="card-body text-left mt-5 mb-5 p-0">
                            <h5 class="card-text mb-2"><?php echo  $this->_data['content']['main_page_imag1_heading']->content ?? ''; ?></h5>
                            <!-- <h2 class="card-text mb-2">Who We Are</h2> -->
                            <div class="card-text text-left"><?php echo  $this->_data['content']['main_page_imag1_description']->content ?? ''; ?></div>
                        </div>
                    </div>

                   
                    <div class="justify-content-center align-self-center order-first  bg-secondary col-12 col-sm-12 col-md-12 col-lg-4">
                       
                       
                        <img src="/assets/frontend/img/meeting-1245776_1920.jpg" width="100%" height="auto">
                        <!-- <img src="/assets/frontend/img/woman-3083377_1920.jpg" width="100%" height="auto"> -->

            </div>
            <div class=" col-lg-1">

            </div>
           
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- About us end -->


    <!-- are_you_an_author_starts -->
    <div class="container-fluid row bg-light">
        <div class="col-sm-12">
            <div class="card-group mt-4 p-5">
                <div class="row">
              
                    <div class=" order-first  bg-light  col-12 col-sm-12 col-md-12 col-lg-4">
                       
                       
                        <img src="/assets/frontend/img/office-1081807_1920.jpg" width="100%" height="auto">

                  </div>


                    <div class="card bg-light  col-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="card-body text-left mt-2 mb-0 p-0">
                            <h5 class="card-text mb-2"><?php echo  $this->_data['content']['main_page_imag2_heading']->content ?? ''; ?></h5>
                            <!-- <h2 class="card-text mb-2">Authors</h2> -->
                            <div class="card-text text-left"><?php echo  $this->_data['content']['main_page_imag2_description']->content ?? ''; ?>
                            </div>
                        </div>
                    </div>
                   

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- are_you_an_author_ends -->


    <!-- thinking_about_buying_starts -->
    <div class=" container-fluid row bg-secondary">
        <div class="col-sm-12 col-12">
            <div class="card-group mt-4 p-5">
                <div class="row">
               
                    <div class="card bg-light col-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="card-body text-left mt-2 mb-2 p-0">
                            <h5 class="card-text mb-2"><?php echo  $this->_data['content']['main_page_imag3_heading']->content ?? ''; ?></h5>                           
                            <div class="card-text text-left"><?php echo  $this->_data['content']['main_page_imag3_description']->content ?? ''; ?></div>
                        </div>
                    </div>


                    <div class="justify-content-center align-self-center order-first  bg-secondary col-12 col-sm-12 col-md-12 col-lg-4">
                       
                       
                                <img src="/assets/frontend/img/woman-3083377_1920.jpg" width="100%" height="auto"> 

                    </div>
                   
                </div>
            </div>
        </div>

      
    </div>

    <!-- thinking_about_buying_ends -->