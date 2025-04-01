<!-- Main Slider Section -->
<section class="main-slider">
    <div class="main-slider__carousel owl-carousel ">
        <div class="item">
            <div class="main-slider__bg"></div>
            <div class="main-slider__shpae-1" style="background-image: url(<?php echo base_url(); ?>assets/images/shapes/main-slider-shape-1.png);"></div>
            <div class="main-slider__shpae-2">
                <img src="<?php echo base_url(); ?>assets/images/shapes/main-slider-shape-2.png" alt="" class="float-bob-y">
            </div>
            <div class="main-slider__img-box">
                <div class="main-slider__img-shape-1">
                    <img src="<?php echo base_url(); ?>assets/images/resources/bgimg.png" alt="">
                </div>
            </div>
            <div class="container">
                <div class="main-slider__content">
                    <h2 class="main-slider__title">Verify Your Certificate</h2>
                    <p class="main-slider__text">
                        Validate your expertise with confidence! Verify your Tally certification <br>
                        now and showcase your accredited skills to potential employers.
                    </p>
                    <div class="main-slider__btn-box">
                        <div class="site-footer__newsletter-right">
                            <div class="site-footer__newsletter-content">
                                <!-- Form to verify certificate number -->
                                <form id="verifyForm" class="site-footer__newsletter-form">
                                    <div class="site-footer__newsletter-input">
                                        <input type="text" id="certificate_number" placeholder="Enter Your Certificate Number" required>
                                    </div>
                                    <button type="submit" class="thm-btn site-footer__newsletter-btn">Verify<span><i class="icon-arrow-right"></i></span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Main Slider Section End -->

<!-- Certificate Details -->
<div id="certificateDetails"></div>

<!-- Certificate Demo Section -->
<section class="section-certificate-demo">
    <h1 class="sample-header">Sample Certificate</h1>
    <img src="<?php echo base_url(); ?>assets/images/resources/image.png" alt="" srcset="">
</section>


<script>
    $(document).ready(function() {
        // Prevent form submission from refreshing the page
        $(document).on('submit', '#verifyForm', function(e) {
            e.preventDefault(); // Prevent default form submission

            var inputField = document.getElementById('certificate_number'); // Get the input field element
            console.log("Input field:", inputField); // Check if input field exists

            var certificate_number = $('.main-slider__carousel .owl-item.active #certificate_number').val().trim();

            console.log("Certificate number:", certificate_number); // Debugging - Check the retrieved value

            if (!certificate_number) {
                alert("Please enter a certificate number.");
                return false;
            }

            $.ajax({
                url: '<?php echo base_url("home/check_certificate"); ?>',
                method: 'POST',
                data: {
                    certificate_number: certificate_number
                },
                dataType: 'json',
                success: function(response) {
                    console.log("AJAX Response:", response);
                    if (response.status === 'success') {
                        var certificate = response.data;
                        var certificateHtml = `
                        <div class="container-fluid" style="text-align:left;margin:auto;color:#005dac;border-style:SOLID;border-color:#98CDDB;BORDER-WIDTH:10PX;max-width: 800px;font-size: 16px;padding-bottom: 3%;">
                            <div class="row" style="margin-top:15px">
                                 <div class="col-sm-6 col-xs-6"> 
                                    <img src="" class="img-responsive float-left" alt="logo">
                                 </div>
                                 <div class="col-sm-6 col-xs-6">
                                    <img src="" style="float: right;height: 52px;padding: 5px;" class="img-responsive float-right" alt="Logo">
                                  </div>
                            </div>
                            <div class="row" style="margin-top:15px">
                                <div class="col-sm-12 col-xs-12" style="text-align:center"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-4"> Certificate Number</div>
                                <div class="col-sm-8 col-xs-8 col-xs-81">: ${certificate.certificate_number}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-4"> Name</div>
                                <div class="col-sm-8 col-xs-8 col-xs-81">: ${certificate.student_name}</div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-4 col-xs-4"> Certification</div>
                                <div class="col-sm-8 col-xs-8 col-xs-81">: ${certificate.course_name}</div>
                            </div>
                             <div class="row">
                                <div class="col-sm-4 col-xs-4"> Course Duration</div>
                                <div class="col-sm-8 col-xs-8 col-xs-81">: ${certificate.course_duration}</div>
                            </div>
                           <div class="row">
                                <div class="col-sm-4 col-xs-4"> Name of Institution</div>
                                <div class="col-sm-8 col-xs-8 col-xs-81">: ${certificate.institute_name}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-4"> Place</div>
                                <div class="col-sm-8 col-xs-8 col-xs-81">: ${certificate.institute_place}</div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-4 col-xs-4"> Certificate Date</div>
                                <div class="col-sm-8 col-xs-8 col-xs-81">: ${certificate.course_completion_date}</div>
                            </div>
                            
                        </div>`;

                        // Insert the generated HTML into the #certificateDetails container
                        $('#certificateDetails').html(certificateHtml);
                        $('html, body').animate({
                            scrollTop: $('#certificateDetails').offset().top
                        }, 1000);
                    } else {
                        // If certificate not found, display error message
                        $('#certificateDetails').html('<div id="errorTbl" style="text-align:center;margin:5px 100px;"> <strong>' + response.message + '</strong></div>');
                    }
                },
                error: function() {
                    $('#certificateDetails').html('<p class="error">There was an error processing your request. Please try again.</p>');
                }
            });
        });
    });
</script>