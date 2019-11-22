<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>ennPAge</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/cerulean/bootstrap.min.css"
      integrity="sha256-bC7V4L6y6xc8L9FYibK5tl3hERQASyd45F09myTwofs=" crossorigin="anonymous" />
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" href="./newpage.css">

<body>


   <div id="course-detail-page" class="course-detail-page-m-cotroller">

      @if(!empty($details))
      <div class="landing-section-wrapper">
         <div class="container the-landing-section">

            <div class="row">
               <div class="col-md-8 col-sm-12">


                  <div class="course-heading-title">
                     {{$details['title']}}
                  </div>
                  <div class="course-heading-sub-title">
                      {{$details['sort_description']}}
                  </div>
             

                  <div class="bestseller-rating-and-enroll">

                     <div id="bestseller-badge">
                        <span class="bestseller-badge-item"> Bestseller</span>
                     </div>


                     <div id="the-rating-section">
                        <div class="the-star-collector">
                           <span class="star-icon">
                              <i class="material-icons">star</i>
                           </span>
                           <span class="star-icon">
                              <i class="material-icons">star</i>
                           </span>
                           <span class="star-icon">
                              <i class="material-icons">star</i>
                           </span>
                           <span class="star-icon">
                              <i class="material-icons">star</i>
                           </span>
                           <span class="star-icon">

                              <i class="material-icons">star</i>
                           </span>
                        </div>
                     </div>

                     <div id="rating-number-enroll-students">
                        <span class="rating-number">
                             {{$details['rating']}}
                        </span>
                        <span class="total-ratings">
                           <span class="rating-numbers"></span> Ratings

                        </span>


                     </div>


                  </div>


               </div>
               <div class="col-md-4 col-sm-12">

                  <div class="image-container">
                     <img class="img-fluid" src="./q141s3xfs.png" alt="">
                  </div>


               </div>



            </div>

         </div>
      </div>


       

       <div class="requirent-of-course container my-5">
         
           {!!$details['description']!!}
       </div>

       @else
       <center><h2>No Details</h2></center>
       @endif



   </div>


</body>

</html>