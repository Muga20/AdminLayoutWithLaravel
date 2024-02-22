   <nav class="sidebar sidebar-offcanvas" id="sidebar">
       <ul class="nav">
           <li class="nav-item">
               <div class="d-flex sidebar-profile">
                   <div class="sidebar-profile-image">
                       <img src="{{ Auth::user()->image }}" alt="image">
                       <span class="sidebar-status-indicator"></span>
                   </div>
                   <div class="sidebar-profile-name">

                           <p class="sidebar-name">
                               WestHill
                           </p>

                       @php
                           $currentTime = \Carbon\Carbon::now();
                           $greeting = '';
                           if ($currentTime->hour >= 5 && $currentTime->hour < 12) {
                               $greeting = 'Good Morning';
                           } elseif ($currentTime->hour >= 12 && $currentTime->hour < 18) {
                               $greeting = 'Good Afternoon';
                           } else {
                               $greeting = 'Good Evening';
                           }
                       @endphp

                       <p class="sidebar-designation">
                           {{ $greeting }}
                       </p>
                   </div>
               </div>

               <p class="sidebar-menu-title">Dash menu</p>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="/dashboard">
                   <i class="typcn typcn-device-desktop menu-icon"></i>
                   <span class="menu-title"> Dashboard </span>
               </a>
           </li>

           <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Swipers" aria-expanded="false"
                  aria-controls="form-elements">
                  <i class="typcn typcn-film menu-icon"></i>
                  <span class="menu-title"> Swipers </span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="Swipers">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"><a class="nav-link" href="/dashboard"> Show </a></li>

                  </ul>
              </div>
          </li>

           <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                   aria-controls="ui-basic">
                   <i class="typcn typcn-briefcase menu-icon"></i>
                   <span class="menu-title">Category</span>
                   <i class="typcn typcn-chevron-right menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item"> <a class="nav-link" href="/createCategory">Create Category</a></li>
                       <li class="nav-item"> <a class="nav-link" href="/showCategory">Show Categories</a></li>

                   </ul>
               </div>
           </li>


           <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#Gallery" aria-expanded="false"
                  aria-controls="ui-basic">
                   <i class="typcn typcn-briefcase menu-icon"></i>
                   <span class="menu-title"> Gallery </span>
                   <i class="typcn typcn-chevron-right menu-arrow"></i>
               </a>
               <div class="collapse" id="Gallery">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item"> <a class="nav-link" href="/createGallery">Create Gallery</a></li>
                       <li class="nav-item"> <a class="nav-link" href="/showGallery">Show Gallery</a></li>

                   </ul>
               </div>
           </li>


          <li class="nav-item">
           <a class="nav-link" data-toggle="collapse" href="#Amenities" aria-expanded="false"
               aria-controls="Amenities">
               <i class="typcn typcn-briefcase menu-icon"></i>
               <span class="menu-title"> Amenities </span>
               <i class="typcn typcn-chevron-right menu-arrow"></i>
           </a>
           <div class="collapse" id="Amenities">
               <ul class="nav flex-column sub-menu">
                   <li class="nav-item"> <a class="nav-link" href="/createAmenities">Create Amenities</a></li>
                   <li class="nav-item"> <a class="nav-link" href="/showAmenities">Show Amenities</a></li>

               </ul>
           </div>
       </li>


            <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#ui-tags" aria-expanded="false"
                   aria-controls="ui-basic">
                   <i class="typcn typcn-briefcase menu-icon"></i>
                   <span class="menu-title">Attachment</span>
                   <i class="typcn typcn-chevron-right menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-tags">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item"> <a class="nav-link" href="/createAttachment">Create Attachment</a></li>
                       <li class="nav-item"> <a class="nav-link" href="/showAttachment">Show Attachment</a></li>

                   </ul>
               </div>
           </li>


           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Property" aria-expanded="false"
                aria-controls="form-elements">
                <i class="typcn typcn-film menu-icon"></i>
                <span class="menu-title"> Property </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Property">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="/createProperty">Create Property </a></li>
                   <li class="nav-item"><a class="nav-link" href="/createPropertyAp">Create Apartment/House </a></li>
                    <li class="nav-item"><a class="nav-link" href="/showProperty">Show Property</a></li>
                   <li class="nav-item"><a class="nav-link" href="/showApartment">Show Apartment</a></li>
                    <li class="nav-item"><a class="nav-link" href="/showPropertyToSlide"> Show Property Sliders </a></li>
                </ul>
            </div>
        </li>


           <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                   aria-controls="form-elements">
                   <i class="typcn typcn-film menu-icon"></i>
                   <span class="menu-title">Events</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="form-elements">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item"><a class="nav-link" href="createEvents">Create Events</a></li>
                       <li class="nav-item"><a class="nav-link" href="showEvents">Show Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="showEventsToSlide">Events on Slide </a></li>

                   </ul>
               </div>
           </li>


           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Blogs" aria-expanded="false"
                aria-controls="form-elements">
                <i class="typcn typcn-film menu-icon"></i>
                <span class="menu-title"> Blogs </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Blogs">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="/createBlogs">Create Blogs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/showBlogs">Show Blogs</a></li>

                </ul>
            </div>
        </li>

            <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#form-elements-profile" aria-expanded="false"
                   aria-controls="form-elements">
                   <i class="typcn typcn-film menu-icon"></i>
                   <span class="menu-title">Profile</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="form-elements-profile">
                   <ul class="nav flex-column sub-menu">

                       <li class="nav-item"><a class="nav-link" href="/profile">Edit Profile </a></li>
                       <li class="nav-item"><a class="nav-link" href="/profile-deactivate">Deactivate Acc  </a></li>
                   </ul>
               </div>
           </li>

       </ul>
   </nav>
